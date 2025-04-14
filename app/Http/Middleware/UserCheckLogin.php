<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Ví dụ: nếu người dùng đã đăng nhập, chuyển hướng họ khỏi trang đăng nhập
        if ($request->user()) {
            return redirect()->route('wellcome');
        }

        // Có thể thêm những logic khác như kiểm tra IP hoặc trạng thái tài khoản ở đây

        return $next($request);
    }
}
