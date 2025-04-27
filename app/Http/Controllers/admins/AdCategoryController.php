<?php

namespace App\Http\Controllers\admins;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Category;
class AdCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //tạo đối tượng model
        // $obj = new Category();
        //gọi hàm index() trong model
        $categories = Category::query()->get();
        //hiển thị view và truyền dữ liệu từ model

        return view(
            'admin.categories.index',
            ['categories' => $categories]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //trả về form tạo mới
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'category_name' => 'required|string|max:100',
            'category_detail_name' => 'required|string|max:255',
        ]);

        // Chuyển đổi category_name thành chữ hoa
        $request->merge([
            'category_name' => mb_strtoupper($request->category_name, 'UTF-8'),
        ]);

        // Lưu danh mục mới vào cơ sở dữ liệu
        Category::create($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category_id)
    {
        //
        $category = Category::findOrFail($category_id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category_id)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'category_name' => 'required|string|max:100',
            'category_detail_name' => 'required|string|max:255',
        ]);

        // Chuyển đổi category_name thành chữ hoa
        $request->merge([
            'category_name' => mb_strtoupper($request->category_name, 'UTF-8'),
        ]);

        // Lấy dữ liệu từ form
        $category = Category::findOrFail($category_id);

        // Cập nhật danh mục
        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_id)
    {
        //tìm sản phẩm theo id 
        $category = Category::findOrFail($category_id);
        //xóa sản phẩm
        $category->delete();
        //trả về trang danh sách sản phẩm
        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa thành công');
    }
}
