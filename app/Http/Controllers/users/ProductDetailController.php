<?php
namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use App\Models\users\ProductDetail;
use App\Models\users\Product;
use App\Models\Images;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        // Lấy tất cả các `product_detail` có `product_id` tương ứng
        $productDetail = ProductDetail::with('images')->where('product_id', $id)->get();
        $product = Product::with('productDetail')->findOrFail($id); // Lấy thông tin sản phẩm
        $min = ProductDetail::orderBy('selling_price', 'asc')->where('product_id', $id)->first();
        $max = ProductDetail::orderBy('selling_price', 'desc')->where('product_id', $id)->first();
        if ($productDetail->isEmpty()) {
            return redirect()->back();
        }

        return view('users.product_detail', compact('productDetail','min','max'));
    }

}
