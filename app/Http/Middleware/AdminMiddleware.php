<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login.form')
                ->withErrors(['error' => 'Vui lòng đăng nhập để truy cập trang này.']);
        }
        return $next($request);
    }
}
