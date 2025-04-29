<?php

namespace App\Http\Controllers\admins;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RevenueController extends Controller
{

    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);

        // Tổng doanh thu theo năm (từ orders.total_amount)
        $totalRevenueYear = DB::table('orders')
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->whereYear('order_date', $year)
            ->sum('total_amount');

        // Tổng giá vốn theo năm (SUM(cost * quantity))
        $totalCostYear = DB::table('orders')
            ->join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->join('product_detail', 'order_detail.product_code', '=', 'product_detail.product_code')
            ->where('orders.status', 'completed')
            ->where('orders.payment_status', 'paid')
            ->whereYear('orders.order_date', $year)
            ->sum(DB::raw('product_detail.cost * order_detail.quantity'));

        // Tính lợi nhuận
        $profitYear = $totalRevenueYear - $totalCostYear;

        // Doanh thu, giá vốn theo từng tháng
        $monthlyOrders = DB::table('orders')
            ->selectRaw('MONTH(order_date) as month, SUM(total_amount) as revenue')
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->whereYear('order_date', $year)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->pluck('revenue', 'month')
            ->toArray();

        $monthlyCosts = DB::table('orders')
            ->join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
            ->join('product_detail', 'order_detail.product_code', '=', 'product_detail.product_code')
            ->selectRaw('MONTH(orders.order_date) as month, SUM(product_detail.cost * order_detail.quantity) as cost')
            ->where('orders.status', 'completed')
            ->where('orders.payment_status', 'paid')
            ->whereYear('orders.order_date', $year)
            ->groupBy(DB::raw('MONTH(orders.order_date)'))
            ->pluck('cost', 'month')
            ->toArray();

        // Chuẩn bị mảng 12 tháng
        $months = range(1, 12);
        $revenues = [];
        $costs = [];
        $profits = [];

        foreach ($months as $month) {
            $revenue = $monthlyOrders[$month] ?? 0;
            $cost = $monthlyCosts[$month] ?? 0;
            $revenues[] = (float) $revenue;
            $costs[] = (float) $cost;
            $profits[] = $revenue - $cost;
        }

        return view('admin.dashboard1', compact(
            'year',
            'totalRevenueYear',
            'totalCostYear',
            'profitYear',
            'months',
            'revenues',
            'costs',
            'profits'
        ));
    }
}
