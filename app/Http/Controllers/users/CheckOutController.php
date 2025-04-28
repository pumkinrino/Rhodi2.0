<?php
namespace App\Http\Controllers\users;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\users\Cart;

use App\Http\Controllers\Controller;

class CheckOutController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('customer')->id();
        // điều kiện như trên
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thêm vào giỏ hàng!');

        } else {
            $cart = Cart::where('customer_id', $userId)->get();
            logger($cart);
            return view('users.checkout', compact('cart'));
        }
    }

    public function applydiscount(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $cart = Cart::where('customer_id', $userId)->get();
        $total = sum($cart->quantity * $cart->productDetail->selling_price);

    }
}
