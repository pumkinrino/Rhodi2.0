<?php

namespace App\Http\Controllers\both;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Hiển thị thông tin chi tiết của đơn hàng.
     *
     * @param int $orderDetailId
     * @return \Illuminate\View\View
     */
    public function show($orderDetailId)
    {
        // Truy vấn chi tiết đơn hàng với toàn bộ thông tin đã select
        $orderDetails = DB::table('orders')
            ->join('customer', 'orders.customer_id', '=', 'customer.customer_id')
            ->leftJoin('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->leftJoin('product_detail', 'order_detail.product_code', '=', 'product_detail.product_code')
            ->leftJoin('products', 'product_detail.product_id', '=', 'products.product_id')
            ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id') // Kết nối bảng voucher
            ->where('order_detail.order_detail_id', $orderDetailId)
            ->select(
                'orders.order_id',
                'orders.order_date',
                'customer.full_name as customer_name',
                'customer.email as customer_email',
                'order_detail.order_detail_id',
                'order_detail.quantity',
                'order_detail.unit_price',
                'order_detail.subtotal',
                'products.pname as product_name',
                'product_detail.product_code',
                'product_detail.size',
                'product_detail.color',
                'product_detail.cost',
                'product_detail.selling_price',
                'product_detail.status as product_status',
                'orders.total_amount',
                 // Thêm các trường từ bảng voucher
            'voucher.code as voucher_code',
            'voucher.description as voucher_description',
            'voucher.discount_type',
            'voucher.discount_value',
            'voucher.min_order_value',
            'voucher.max_discount',
            'voucher.quantity as voucher_quantity',
            'voucher.start_date as voucher_start_date',
            'voucher.end_date as voucher_end_date',
            'voucher.is_active as voucher_is_active'

            )
            ->get();
    
        // Kiểm tra nếu không có dữ liệu
        if ($orderDetails->isEmpty()) {
            return view('admin.order.detail.show', ['error' => 'Không tìm thấy chi tiết đơn hàng!']);
        }
    
        // Trả về view với thông tin chi tiết đơn hàng
        return view('admin.order.orddetail', ['orderDetails' => $orderDetails]);
    }
    


    
}
