<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = DB::table('products')
            ->join('category', 'products.category_id', '=', 'category.category_id')
            ->join('brand', 'products.brand_id', '=', 'brand.brand_id')
            ->select('products.*', 'category.category_name', 'category.category_detail_name', 'brand.brand_name')
            ->get();

        // Lấy tất cả danh mục và thương hiệu
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.product', compact('products', 'categories', 'brands'));
    }

    // // Hiển thị form thêm sản phẩm mới
    // public function create()
    // {
    //     // Lấy danh sách categories và brands để chọn trong form
    //     $categories = Category::all();
    //     $brands = Brand::all();

    //     return view('admin.products.create', compact('categories', 'brands'));
    // }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'pname' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:category,category_id',
            'brand_id' => 'required|integer|exists:brand,brand_id',
            'status' => 'required|in:active,inactive',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
        ]);

        // Step 1: Tạo sản phẩm mà chưa có ảnh
        $product = Product::create([
            'pname' => $request->pname,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
            'main_image' => null,
        ]);

        // Step 2: Nếu có ảnh thì lưu ảnh
        if ($request->hasFile('main_image')) {
            $filename = time() . '_' . $request->file('main_image')->getClientOriginalName();
            $path = $request->file('main_image')->storeAs('images', $filename, 'public');

            // Cập nhật đường dẫn ảnh vào sản phẩm
            $product->update(['main_image' => $path]);
        }

        return redirect()->route('admin.products.product')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        // Validate input data
        $request->validate([
            'pname' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:category,category_id',
            'brand_id' => 'nullable|exists:brand,brand_id',
            'status' => 'nullable|in:active,inactive',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Giữ lại giá trị cũ nếu không có giá trị mới
        $updatedData = [
            'pname' => $request->pname ?? $product->pname,
            'category_id' => $request->category_id ?? $product->category_id,
            'brand_id' => $request->brand_id ?? $product->brand_id,
            'status' => $request->status ?? $product->status,
        ];

        // Nếu có ảnh mới, lưu ảnh
        if ($request->hasFile('main_image')) {
            $filename = time() . '_' . $request->file('main_image')->getClientOriginalName();
            $updatedData['main_image'] = $request->file('main_image')->storeAs('images', $filename, 'public');
        }

        $product->update($updatedData);

        return redirect()->route('admin.products.product')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Xóa sản phẩm
    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();  // Xóa sản phẩm

        return redirect()->route('admin.products.product')->with('success', 'Sản phẩm đã được xóa.');
    }
}
