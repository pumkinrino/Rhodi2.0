<?php

namespace App\Http\Controllers\both;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends Controller
{
    //



    public function index(Request $request)
{
    // Lấy số lượng phương thức thanh toán mỗi trang từ yêu cầu (hoặc mặc định là 10)
    $perPage = $request->input('per_page', 10);

    // Lấy tất cả phương thức thanh toán với phân trang
    $paymentMethods = DB::table('payment_method')->paginate($perPage);

    // Trả về view cùng với dữ liệu
    return view('admin.PaymentMethod', ['paymentMethods' => $paymentMethods]);
}

    // Thêm mới phương thức thanh toán
    public function store(Request $request)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        DB::table('payment_method')->insert([
            'method_name' => $validated['method_name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Phương thức thanh toán được thêm thành công!');
    }

    // Sửa phương thức thanh toán
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        DB::table('payment_method')
            ->where('payment_method_id', $id)
            ->update([
                'method_name' => $validated['method_name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Phương thức thanh toán được cập nhật thành công!');
    }

    // Xóa phương thức thanh toán
    public function destroy($id)
    {
        DB::table('payment_method')
            ->where('payment_method_id', $id)
            ->delete();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Phương thức thanh toán được xóa thành công!');
    }
}
