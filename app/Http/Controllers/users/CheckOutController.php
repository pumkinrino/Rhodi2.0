<?php

namespace App\Http\Controllers\users;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\users\Cart;
use App\Models\Voucher;
use App\Models\ShippingAddress;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;

class CheckOutController extends Controller
{
    public function index()
    {
        // Lấy đối tượng khách hàng đã đăng nhập
        $customer = Auth::guard('customer')->user();

        // Nếu khách hàng chưa đăng nhập, chuyển hướng và thông báo lỗi
        if (!$customer) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Lấy giỏ hàng của khách hàng dựa vào customer_id
        $cart = Cart::where('customer_id', $customer->customer_id)->get();
        if ($cart->count() < 1) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Lấy các phương thức thanh toán
        $paymentMethods = PaymentMethod::all();

        // Lấy địa chỉ giao hàng trực tiếp từ khách hàng (bảng customer)
        // Nếu trường 'address' trống, thông báo họ cập nhật trước khi checkout
        if (empty($customer->address)) {
            return redirect()->back()->with('error', 'You must update your shipping address in your profile.');
        }

        // Tạo đối tượng addresses từ thông tin của khách hàng (chỉ có 1 địa chỉ duy nhất)
        $addresses = collect([
            (object) [
                'address_id' => $customer->customer_id, // Dùng customer_id làm ID tạm thời
                'full_name' => $customer->full_name,
                'address_line' => $customer->address,      // Trường 'address' chứa địa chỉ của khách hàng
                'postal_code' => ''                         // Nếu có thông tin chi tiết khác, cập nhật ở đây
            ]
        ]);

        // Truyền cả giỏ hàng, thông tin khách hàng, danh sách phương thức thanh toán và địa chỉ sang view
        return view('users.checkout', compact('cart', 'customer', 'paymentMethods', 'addresses'));
    }




    public function applyDiscount(Request $request)
    {
        $voucherCode = $request->input('voucher_code');
        $userId = Auth::guard('customer')->id();
        $cartItems = Cart::where('customer_id', $userId)->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->productDetail->selling_price;
        });

        $discount = 0;
        $voucherApplied = false;
        $voucherDetails = null;

        if ($voucherCode) {
            $voucher = Voucher::where('code', $voucherCode)
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($voucher) {
                if ($voucher->min_order_value && $total < $voucher->min_order_value) {
                    return redirect()->back()->with('error', 'voucher not working');
                }

                if ($voucher->discount_type === 'fixed') {
                    $discount = $voucher->discount_value;
                } elseif ($voucher->discount_type === 'percentage') {
                    $discount = ($total * $voucher->discount_value) / 100;
                    if ($voucher->max_discount !== null && $discount > $voucher->max_discount) {
                        $discount = $voucher->max_discount;
                    }
                }

                $voucherApplied = true;
                $voucherDetails = $voucher;
            }
        }

        $finalTotal = $total - $discount;

        return response()->json([
            'customer_id' => auth()->guard('customer')->id(), // Lấy ID khách hàng đã đăng nhập
            'full_name' => $request->input('fullName'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),  // Lưu email vào DB nếu model của bạn có cột email
            'address_line' => $request->input('address_line'),
        ]);
    }

    // Đổi tên phương thức này thành checkout() hoặc processCheckout() cho đúng route của bạn
    public function processCheckout(Request $request)
    {
        // Lấy thông tin khách hàng đã đăng nhập từ guard "customer"
        $user = Auth::guard('customer')->user();

        // Lấy các mặt hàng trong giỏ theo customer_id
        $cartItems = Cart::where('customer_id', $user->customer_id)->get();

        // Tính tổng đơn hàng
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->productDetail->selling_price;
        });

        // Luôn dùng địa chỉ lưu trong bảng customer
        if (empty($user->address)) {
            // Nếu khách hàng chưa cập nhật địa chỉ thì chuyển hướng về trang profile hoặc trả về thông báo lỗi
            return redirect()->back()->with('error', 'You have not saved your shipping address. Please update your profile.');
        }
        $shippingAddress = $user->address; // Ví dụ: "365 Trần Khát Chân, Hà Nội" hoặc chuỗi đầy đủ địa chỉ khác

        // Xử lý voucher (nếu có)
        $voucherId = null;
        if ($request->filled('voucher_code')) {
            $voucher = Voucher::where('code', $request->input('voucher_code'))
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();
            if ($voucher) {
                $voucherId = $voucher->voucher_id;
            }
        }

        // Lấy phương thức thanh toán từ form (ví dụ tên input là "payment_method")
        $paymentMethodId = $request->input('payment_method');

        // Thực hiện transaction: Tạo đơn hàng, đơn chi tiết và xóa giỏ hàng
        DB::transaction(function () use ($user, $shippingAddress, $cartItems, $totalAmount, $voucherId, $paymentMethodId) {
            // Tạo đơn hàng, lưu địa chỉ giao hàng lấy từ bảng customer
            $order = Order::create([
                'customer_id' => $user->customer_id,
                'shipping_address' => $shippingAddress,  // Đảm bảo bảng orders có cột shipping_address để lưu chuỗi địa chỉ
                'voucher_id' => $voucherId,
                'total_amount' => $totalAmount,
                'payment_method_id' => $paymentMethodId,
            ]);

            // Tạo chi tiết đơn hàng cho từng mặt hàng trong giỏ
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_code' => $item->productDetail->product_code,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->productDetail->selling_price,
                    'subtotal' => $item->quantity * $item->productDetail->selling_price,
                ]);
            }

            // Xóa các mặt hàng đã đặt khỏi giỏ hàng
            Cart::where('customer_id', $user->customer_id)->delete();
        });

        return redirect()->route('welcome')->with('success', 'Thank you for your order!');
    }



}
