<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\Category;
use App\Models\users\Product;
use Illuminate\Console\View\Components\Component;


class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục kèm theo các sản phẩm có trạng thái active
        $categories = Category::with([
            'products' => function ($query) {
                $query->where('status', 'active')->has('productDetail'); // chỉ lấy sản phẩm đang active
            }
        ])->get();
        return view('welcome', compact('categories'));


    }


    // hiển thị theo từng cate
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
