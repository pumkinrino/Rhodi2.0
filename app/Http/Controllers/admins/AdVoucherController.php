<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdVoucherController extends Controller
{
    /**
     * Hiển thị danh sách voucher và form thêm voucher.
     */

//     public function index(Request $request)
// {
//     // Lấy giá trị số voucher mỗi trang từ request, mặc định là 10
//     $perPage = $request->input('per_page', 10); // Mặc định là 10 nếu không có giá trị

//     // Lấy giá trị tìm kiếm voucher từ request
//     $search = $request->input('search', '');

//     // Lấy danh sách voucher, có điều kiện tìm kiếm theo mã voucher, và phân trang
//     $vouchers = DB::table('voucher')
//                   ->when($search, function($query, $search) {
//                       return $query->where('code', 'like', '%' . $search . '%');
//                   })
//                   ->orderBy('created_at', 'desc')
//                   ->paginate($perPage);

//     return view('admin.products.voucher', compact('vouchers'));
// }




public function index(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $search = $request->input('search', '');

    // --- Kiểm tra và tự động disable các voucher hết hạn ---
    $today = now(); // Lấy thời gian hiện tại

    $expiredVouchers = DB::table('voucher')
        ->where('end_date', '<', $today)
        ->where('is_active', true) // Chỉ disable những cái còn active
        ->get();

    if ($expiredVouchers->count() > 0) {
        // Cập nhật tất cả voucher hết hạn thành inactive
        DB::table('voucher')
            ->whereIn('voucher_id', $expiredVouchers->pluck('voucher_id'))
            ->update([
                'is_active' => false,
                'updated_at' => now(),
            ]);

        // Gửi thông báo
        session()->flash('warning', $expiredVouchers->count() . ' voucher đã hết hạn và bị tự động vô hiệu hóa.');
    }

    // --- Load danh sách voucher sau khi update ---
    $vouchers = DB::table('voucher')
                  ->when($search, function($query, $search) {
                      return $query->where('code', 'like', '%' . $search . '%');
                  })
                  ->orderBy('created_at', 'desc')
                  ->paginate($perPage);

    return view('admin.products.voucher', compact('vouchers'));
}
    /**
     * Lưu voucher mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'code'          => 'required|string|max:50|unique:voucher,code',
            'description'   => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value'=> 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount'  => 'nullable|numeric|min:0',
            'quantity'      => 'required|integer|min:1',
            'start_date'    => 'required|date|after_or_equal:today',
            'end_date'      => 'required|date|after:start_date',
            'is_active'     => 'required|boolean',
        ]);

        // Thêm voucher mới vào cơ sở dữ liệu
        DB::table('voucher')->insert([
            'code'           => $request->input('code'),
            'description'    => $request->input('description'),
            'discount_type'  => $request->input('discount_type'),
            'discount_value' => $request->input('discount_value'),
            'min_order_value'=> $request->input('min_order_value'),
            'max_discount'   => $request->input('max_discount'),
            'quantity'       => $request->input('quantity'),
            'start_date'     => $request->input('start_date'),
            'end_date'       => $request->input('end_date'),
            'is_active'      => $request->input('is_active'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Quay lại trang danh sách với thông báo thành công
        return redirect()->route('admin.products.voucher.index')->with('success', 'Voucher đã được thêm thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa voucher.
     */
    public function edit($id)
    {
        // Lấy thông tin voucher cần chỉnh sửa
        $voucher = DB::table('voucher')->where('voucher_id', $id)->first();

        if (!$voucher) {
            return redirect()->route('admin.products.voucher.index')->with('error', 'Voucher không tồn tại.');
        }

        return view('admin.products.voucher_edit', compact('voucher'));
    }

    /**
     * Cập nhật voucher vào cơ sở dữ liệu.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'code'          => 'required|string|max:50|unique:voucher,code,' . $id . ',voucher_id',
            'description'   => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value'=> 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount'  => 'nullable|numeric|min:0',
            'quantity'      => 'required|integer|min:1',
            'start_date'    => 'required|date|after_or_equal:today',
            'end_date'      => 'required|date|after:start_date',
            'is_active'     => 'required|boolean',
        ]);

        // Cập nhật voucher trong cơ sở dữ liệu
        $updated = DB::table('voucher')
            ->where('voucher_id', $id)
            ->update([
                'code'           => $request->input('code'),
                'description'    => $request->input('description'),
                'discount_type'  => $request->input('discount_type'),
                'discount_value' => $request->input('discount_value'),
                'min_order_value'=> $request->input('min_order_value'),
                'max_discount'   => $request->input('max_discount'),
                'quantity'       => $request->input('quantity'),
                'start_date'     => $request->input('start_date'),
                'end_date'       => $request->input('end_date'),
                'is_active'      => $request->input('is_active'),
                'updated_at'     => now(),
            ]);

        if ($updated) {
            return redirect()->route('admin.products.voucher.index')->with('success', 'Voucher đã được cập nhật thành công!');
        }

        return redirect()->route('admin.products.voucher.index')->with('error', 'Cập nhật thất bại.');
    }

    /**
     * Xóa voucher.
     */
    public function destroy($id)
    {
        // Xóa voucher khỏi cơ sở dữ liệu
        $deleted = DB::table('voucher')->where('voucher_id', $id)->delete();

        if ($deleted) {
            return redirect()->route('admin.products.voucher.index')->with('success', 'Voucher đã được xóa thành công!');
        }

        return redirect()->route('admin.products.voucher.index')->with('error', 'Không thể xóa voucher.');
    }
}
