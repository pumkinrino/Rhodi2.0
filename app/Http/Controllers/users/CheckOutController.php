<?php
namespace App\Http\Controllers\users;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\users\Cart;

use App\Http\Controllers\Controller;

class CheckOutController extends Controller
{
    public function index()
    {
        // điều kiện như trên
        $cart = Cart::where('customer_id', Auth::guard('customer')->id());
        // trả về danh sách sp trong giỏ
        return view('users.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        // Xử lý logic đặt hàng
    }
}
