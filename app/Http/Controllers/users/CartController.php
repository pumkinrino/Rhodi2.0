<?php
namespace App\Http\Controllers\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\users\Cart;
use App\Models\users\ProductDetail;
class CartController extends Controller
{

    public function getList()
    {
        // điều kiện như trên
        $cart = Cart::where('customer_id', session('customer')->customer_id)->get();
        // trả về danh sách sp trong giỏ
        return $cart;
    }

    public function addToCart(Request $request)
    {
        // Kiểm tra đăng nhập
        $userId = Auth::guard('customer')->id();
        if (!$userId) {
            return redirect()->back()->with('error', 'You need to login to continue!');
        }

        // Tìm `product_code` dựa vào `product_id`, `size`, `color`
        $productDetail = ProductDetail::where([
            ['product_id', $request->product_id],
            ['size', $request->size],
            ['color', $request->color]
        ])->first();


        if (!$productDetail) {
            return redirect()->back()->with('error', 'Product not fount!');
        }

        // Sử dụng `product_code` tìm thấy
        $productCode = $productDetail->product_code;

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $existingCartItem = Cart::where([
            ['customer_id', $userId],
            ['product_code', $productCode],
        ])->first();

        if ($existingCartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            Cart::create([
                'customer_id' => $userId,
                'product_code' => $productCode,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'added_at' => now()
            ]);
        }
        return redirect()->back()->with('success','product had been added to your cart!');
    }



    // Trong CartController.php
    public function getCart()
    {
        $customer = session('customer');
        if (!$customer) {
            return collect([]); // hoặc trả về một collection rỗng
        }
        return Cart::with('productDetail.product')
            ->where('customer_id', $customer->customer_id)
            ->get();
    }

    public function remove(Request $request)
    {
        $cartItem = Cart::where('cart_id', $request->cart_id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success','product deleted from cart!');
        }
        return redirect()->back()->with('error','product not found!');
    }



}