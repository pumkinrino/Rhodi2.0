<?php


namespace App\Http\Controllers\admins;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdBrandController extends Controller
{
    /**
     * Hiển thị danh sách brands và form thêm (nằm chung index view).
     */
    public function index()
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = request('search');
        $perPage = request('perPage', 15); // Số lượng bản ghi trên mỗi trang, mặc định là 15
    
        // Truy vấn tất cả thương hiệu và lọc theo từ khóa tìm kiếm nếu có
        $brands = DB::table('brand')
            ->where('brand_name', 'like', '%' . $search . '%') // Lọc theo tên thương hiệu
            ->orderBy('brand_id', 'desc') // Sắp xếp theo brand_id giảm dần
            ->paginate($perPage); // Phân trang theo số lượng bản ghi trên mỗi trang
    
        // Trả về view với dữ liệu thương hiệu
        return view('admin.products.brand', compact('brands', 'search', 'perPage'));
    }

    /**
     * Lưu brand mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::table('brand')->insert([
            'brand_name' => $request->brand_name,
            'description'=> $request->description,
        ]);

        return redirect()
            ->route('admin.products.brand.index')
            ->with('success', 'Thêm thương hiệu thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa brand (có thể dùng modal riêng).
     */
    public function edit($id)
    {
        $brand = DB::table('brand')->where('brand_id', $id)->first();

        if (! $brand) {
            return redirect()
                ->route('admin.products.brand.index')
                ->with('error', 'Không tìm thấy thương hiệu.');
        }

        return view('admin.products.brand_edit', compact('brand'));
    }

    /**
     * Cập nhật brand.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $updated = DB::table('brand')
            ->where('brand_id', $id)
            ->update([
                'brand_name' => $request->brand_name,
                'description'=> $request->description,
            ]);

        if ($updated) {
            return redirect()
                ->route('admin.products.brand.index')
                ->with('success', 'Cập nhật thương hiệu thành công!');
        }

        return redirect()
            ->route('admin.products.brand.index')
            ->with('error', 'Cập nhật thất bại.');
    }

    /**
     * Xóa brand.
     */
    public function destroy($id)
    {
        $deleted = DB::table('brand')->where('brand_id', $id)->delete();

        if ($deleted) {
            return redirect()
                ->route('admin.products.brand.index')
                ->with('success', 'Xóa thương hiệu thành công!');
        }

        return redirect()
            ->route('admin.products.brand.index')
            ->with('error', 'Xóa thất bại hoặc không tìm thấy thương hiệu.');
    }
}
