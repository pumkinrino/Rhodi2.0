<?php
namespace App\Http\Controllers\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\users\Cart;
use App\Models\users\ProductDetail;
class CartController extends Controller
{
    public function index(){
        return view('users.cart');
    }
    public function getCart()
    {
        $customer = session('customer');
        if (!$customer) {
            return collect([]);
        }
        return Cart::with('productDetail.product')
            ->where('customer_id', $customer->customer_id)
            ->get();
    }

    public function addToCart(Request $request)
    {

        // check user hợp lệ
        $userId = Auth::guard('customer')->id();
        if (!$userId) {
            return redirect()->back()->with('error', 'You need to login to continue!');
        }

        // tìm code bằng prid sie và màu
        $productDetail = ProductDetail::where([
            ['product_id', $request->product_id],
            ['size', $request->size],
            ['color', $request->color]
        ])->first();


        if (!$productDetail) {
            return redirect()->back()->with('error', 'choose type of product!');
        }

        // dùng cái vừa tìm
        $productCode = $productDetail->product_code;

        // check tồn tại
        $existingCartItem = Cart::where([
            ['customer_id', $userId],
            ['product_code', $productCode],
        ])->first();

        if ($existingCartItem) {
            // tồn tại thì thêm 1 thg nưa vào
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            // không tồn tại thì tạo mới
            Cart::create([
                'customer_id' => $userId,
                'product_code' => $productCode,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'added_at' => now()
            ]);
        }
        return redirect()->back()->with('success', 'product had been added to your cart!');
    }





    public function remove(Request $request)
    {
        $cartItem = Cart::where('cart_id', $request->cart_id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'product deleted from cart!');
        }
        return redirect()->back()->with('error', 'product not found!');
    }



}