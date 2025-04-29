<?php

namespace App\Http\Controllers\admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdCusController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng (có tìm kiếm).
     */
    public function index(Request $request)
    {
        $query = DB::table('customer');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $cus = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard2', compact('cus'));
    }
}
