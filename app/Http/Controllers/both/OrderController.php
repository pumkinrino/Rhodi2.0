<?php

namespace App\Http\Controllers\both;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class OrderController extends Controller
{

    // public function index(Request $request)
    // {
    //     // Lấy các tham số tìm kiếm từ request
    //     $orderId = $request->input('order_id');
    //     $fullName = $request->input('full_name');
    //     $perPage = $request->input('per_page', 10); // Mặc định là 10 nếu không có chọn
    
    //     // Truy vấn cho trạng thái 'pending'
    //     $pendingQuery = DB::table('orders')
    //         ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
    //         ->where('orders.status', 'pending');
    
    //     if ($orderId) {
    //         $pendingQuery->where('orders.order_id', 'like', '%' . $orderId . '%');
    //     }
    
    //     if ($fullName) {
    //         $pendingQuery->where('customer.full_name', 'like', '%' . $fullName . '%');
    //     }
    
    //     $pendingOrders = $pendingQuery->select('orders.*', 'customer.full_name')
    //         ->paginate($perPage);
    
    //     // Truy vấn cho trạng thái 'confirmed'
    //     $confirmedQuery = DB::table('orders')
    //         ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
    //         ->where('orders.status', 'confirmed');
    
    //     if ($orderId) {
    //         $confirmedQuery->where('orders.order_id', 'like', '%' . $orderId . '%');
    //     }
    
    //     if ($fullName) {
    //         $confirmedQuery->where('customer.full_name', 'like', '%' . $fullName . '%');
    //     }
    
    //     $confirmedOrders = $confirmedQuery->select('orders.*', 'customer.full_name')
    //         ->paginate($perPage);
    
    //     // Truy vấn cho trạng thái 'delivered' và 'deliver'
    //     $deliverQuery = DB::table('orders')
    //         ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
    //         ->whereIn('orders.status', ['deliver', 'delivered']);
    
    //     if ($orderId) {
    //         $deliverQuery->where('orders.order_id', 'like', '%' . $orderId . '%');
    //     }
    
    //     if ($fullName) {
    //         $deliverQuery->where('customer.full_name', 'like', '%' . $fullName . '%');
    //     }
    
    //     $deliverOrders = $deliverQuery->select('orders.*', 'customer.full_name')
    //         ->paginate($perPage);
    
    //     // Truy vấn cho trạng thái 'completed'
    //     $completedQuery = DB::table('orders')
    //         ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
    //         ->where('orders.status', 'completed');
    
    //     if ($orderId) {
    //         $completedQuery->where('orders.order_id', 'like', '%' . $orderId . '%');
    //     }
    
    //     if ($fullName) {
    //         $completedQuery->where('customer.full_name', 'like', '%' . $fullName . '%');
    //     }
    
    //     $completedOrders = $completedQuery->select('orders.*', 'customer.full_name')
    //         ->paginate($perPage);
    
    //     // Truy vấn cho trạng thái 'cancelled'
    //     $cancelledQuery = DB::table('orders')
    //         ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
    //         ->where('orders.status', 'cancelled');
    
    //     if ($orderId) {
    //         $cancelledQuery->where('orders.order_id', 'like', '%' . $orderId . '%');
    //     }
    
    //     if ($fullName) {
    //         $cancelledQuery->where('customer.full_name', 'like', '%' . $fullName . '%');
    //     }
    
    //     $cancelledOrders = $cancelledQuery->select('orders.*', 'customer.full_name')
    //         ->paginate($perPage);
    
    //     return view('admin.order.ord', compact(
    //         'pendingOrders', 'confirmedOrders', 'deliverOrders', 'completedOrders', 'cancelledOrders'
    //     ));
    // }
    


    public function index(Request $request)
    {
        // Lấy các tham số tìm kiếm từ request
        $orderId  = $request->input('order_id');
        $fullName = $request->input('full_name');
        $perPage  = $request->input('per_page', 1000000000); 
    
        // Hàm chung để thêm điều kiện tìm kiếm và select
        $applyCommon = function ($query) use ($orderId, $fullName) {
            if ($orderId) {
                $query->where('orders.order_id', 'like', "%{$orderId}%");
            }
            if ($fullName) {
                $query->where('customer.full_name', 'like', "%{$fullName}%");
            }
            return $query->select([
                'orders.*',
                'customer.full_name',
                'voucher.code as voucher_code',
                'order_detail.*' // Thêm tất cả các cột từ bảng order_detail
            ]);
        };
    
        // Pending
        $pendingQuery = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id') // join với bảng order_detail
            ->where('orders.status', 'pending');
        $pendingOrders = $applyCommon($pendingQuery)->paginate($perPage);
    
        // Confirmed
        $confirmedQuery = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->where('orders.status', 'confirmed');
        $confirmedOrders = $applyCommon($confirmedQuery)->paginate($perPage);
    
        // Deliver / Delivered
        $deliverQuery = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->whereIn('orders.status', ['deliver','delivered']);
        $deliverOrders = $applyCommon($deliverQuery)->paginate($perPage);
    
        // Completed
        $completedQuery = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->where('orders.status', 'completed');
        $completedOrders = $applyCommon($completedQuery)->paginate($perPage);
    
        // Cancelled
        $cancelledQuery = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->where('orders.status', 'cancelled');
        $cancelledOrders = $applyCommon($cancelledQuery)->paginate($perPage);
    
        return view('admin.order.ord', compact(
            'pendingOrders',
            'confirmedOrders',
            'deliverOrders',
            'completedOrders',
            'cancelledOrders'
        ));
    }
    

// update trạng thái đơn hàng + trạng thái thanh toán
public function updateStatus(Request $request, $orderId)
{
    $allowedStatus = ['pending', 'confirmed', 'deliver', 'delivered', 'completed', 'cancelled'];
    $allowedPaymentStatus = ['unpaid', 'paid', 'refunded'];

    $data = $request->validate([
        'status' => ['nullable', Rule::in($allowedStatus)],
        'payment_status' => ['nullable', Rule::in($allowedPaymentStatus)],
    ]);

    $updateFields = [];

    if (isset($data['status'])) {
        $updateFields['status'] = $data['status'];
    }

    if (isset($data['payment_status'])) {
        $updateFields['payment_status'] = $data['payment_status'];
    }

    if (!empty($updateFields)) {
        DB::table('orders')
            ->where('order_id', $orderId)
            ->update($updateFields);
    }

    return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
}


    

}
