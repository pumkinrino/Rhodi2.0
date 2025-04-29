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
        // Lấy giỏ hàng của khách hàng dựa vào customer_id
        $cart = Cart::where('customer_id', $customer->customer_id)->get();
        $paymentMethods = PaymentMethod::get();
        // Nếu khách hàng chưa đăng nhập, chuyển hướng và thông báo lỗi
        if (!$customer) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        if(($cart -> count()) < 1){
            return redirect()->back()->with('error', 'Please login first.');
        }
        // Lấy các địa chỉ giao hàng đã lưu trong bảng 'shipping_address'
        $addresses = ShippingAddress::where('customer_id', $customer->customer_id)->get();

        // Nếu không có địa chỉ nào được lưu sẵn, bạn có thể tạo một danh sách chứa địa chỉ mặc định từ thông tin trong bảng 'customer'
        if ($addresses->isEmpty()) {
            // Tạo một đối tượng giả (object) với các thông tin mặc định từ bảng customer
            $addresses = collect([
                (object) [
                    'address_id' => $customer->customer_id, // Dùng customer_id làm ID tạm thời
                    'full_name' => $customer->full_name,
                    'address_line' => $customer->address, // Giả sử trường 'address' chứa địa chỉ mặc định
                    'postal_code' => '', // Nếu không có thông tin mã bưu điện, để rỗng hoặc điều chỉnh cho phù hợp
                ]
            ]);
        }

        // Truyền cả giỏ hàng, thông tin khách hàng và danh sách địa chỉ sang view
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
        // Lấy thông tin khách hàng đã đăng nhập
        $user = Auth::guard('customer')->user();

        // Lấy các mặt hàng trong giỏ theo customer_id
        $cartItems = Cart::where('customer_id', $user->customer_id)->get();

        // Tính tổng đơn hàng
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->productDetail->selling_price;
        });

        // Xử lý địa chỉ giao hàng:
        // Nếu người dùng chọn địa chỉ đã lưu qua dropdown ("saved_address_id")
        if ($request->filled('saved_address_id')) {
            $shippingAddressId = $request->input('saved_address_id');
        }
        // Nếu người dùng tick checkbox "use_other_address" và nhập địa chỉ mới
        elseif ($request->has('use_other_address')) {
            $newAddress = ShippingAddress::create([
                'customer_id' => $user->customer_id,
                'full_name' => $request->input('other_full_name'),
                'phone' => $request->input('other_phone'),
                'address_line' => $request->input('other_address_line'),
                'city' => '',
                $request->input('other_city'),
                'district' => '',
                $request->input('other_district'),
                'postal_code' => '',
            ]);
            $shippingAddressId = $newAddress->address_id;
        } else {
            return redirect()->back()->with('error', 'Please select an existing shipping address or provide a new one.');
        }

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

        // Lấy payment method id từ giá trị được truyền từ view
        $paymentMethodId = $request->input('payment_method_id');

        // Transaction: Tạo đơn hàng, các chi tiết đơn và xóa giỏ hàng
        DB::transaction(function () use ($user, $shippingAddressId, $cartItems, $totalAmount, $voucherId, $paymentMethodId) {
            // Tạo đơn hàng với payment_method_id được chọn từ form
            $order = Order::create([
                'customer_id' => $user->customer_id,
                'shipping_address_id' => $shippingAddressId,
                'voucher_id' => $voucherId,
                'total_amount' => $totalAmount,
                'payment_method_id' => $paymentMethodId,
            ]);

            // Tạo chi tiết đơn hàng trải qua từng mặt hàng trong giỏ
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
