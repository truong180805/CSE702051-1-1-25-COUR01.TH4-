<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        //Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            //Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect('/login');
        }

        //Kiểm tra vai trò (role) của người dùng
        if (Auth::user()->role !== 'admin') {
            //Nếu không phải admin, trả về lỗi 403 (Forbidden)
            abort(403, 'Truy cập bị từ chối. Bạn không có quyền quản trị.');
        }

        //Nếu là Admin, cho phép request đi tiếp
        return $next($request);
    }
}