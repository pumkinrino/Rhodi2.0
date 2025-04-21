<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('AdminAuth');
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')
            ->with('error', 'Vui lòng đăng nhập để truy cập trang này.');
        
        }
        elseif(Session::has('admin_id')) {
            return redirect()->route('admin.dashboard')
            ->with('success', 'Bạn đã đăng nhập thành công');
        }
        return $next($request);
    }
}
