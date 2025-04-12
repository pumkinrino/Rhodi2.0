<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\Category;
use App\Models\users\Product;


class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục kèm theo các sản phẩm có trạng thái active
        $categories = Category::with([
            'products' => function ($query) {
                $query->where('status', 'active'); // chỉ lấy sản phẩm đang active
            }
        ])->get();

        return view('welcome', compact('categories'));
    }
    public function showDetail($id)
    {
        // Lấy thông tin sản phẩm theo $id
        $product = Product::findOrFail($id);
        return view('users.product-details', compact('product'));
    }
    public function showWithCate($id)
    {
        // Lấy các sản phẩm có category_id bằng $id và có trạng thái active
        $products = Product::where('category_id', $id)
                           ->where('status', 'active')
                           ->get();
    
        // Nếu muốn hiển thị thêm thông tin category có thể làm
        $category = Category::findOrFail($id);
    
        // Trả về view danh sách sản phẩm theo category
        return view('users.category-products', compact('products', 'category'));
    }
    

}
