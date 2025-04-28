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
        $user = Auth::guard('customer')->id();
        // điều kiện như trên
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thêm vào giỏ hàng!');

        } else {
            $cart = Cart::where('customer_id', Auth::guard('customer')->id())->get();
            // trả về danh sách sp trong giỏ
            return view('users.checkout', compact('cart'));
        }
    }

    public function processCheckout(Request $request)
    {
        // Xử lý logic đặt hàng
    }
}
