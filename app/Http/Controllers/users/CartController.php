<?php
namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $count = $this->count();
        $cartList = $this->getList();
        return view('welcome', compact('count', 'cartList'));
    }

    public function count()
    {
        // điều kiện là trùng id khách hàng
        $count = Cart::where('customer_id', session('customer')->customer_id)
            ->count();
            // trả về số lượng sp trong giở
        return $count;
    }

    public function getList()
    {
        // điều kiện như trên
        $cart = Cart::where('customer_id', session('customer')->customer_id)->get();
        // trả về danh sách sp trong giỏ
        return $cart;
    }
}