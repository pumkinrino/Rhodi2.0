<?php
namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\Category; // đảm bảo import đúng Model
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        // Lấy danh mục theo id kèm theo các sản phẩm active trong danh mục đó.
        $category = Category::with([
            'products' => function($query) {
                $query->where('status', 'active'); // chỉ lấy các sản phẩm đang active
            }
        ])->findOrFail($id);

        // Nếu bạn cũng cần hiển thị danh sách tất cả danh mục (ví dụ cho sidebar)
        $categories = Category::all();

        // Trả dữ liệu cho view riêng 'category-products'
        return view('users.category-products', compact('category','categories'));
    }
}
