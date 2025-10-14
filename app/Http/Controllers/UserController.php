<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Hiển thị Profile cá nhân và các Review đã viết của người dùng.
     */
    public function show()
    {
        // 1. Lấy người dùng đang đăng nhập
        $user = Auth::user();

        // 2. Tải các mối quan hệ cần thiết (Reviews và Phim liên quan)
        // Eager Loading: Tải tất cả Reviews mà người dùng này đã viết,
        // đồng thời tải thông tin Movie cho mỗi Review đó.
        $user->load([
            'reviews' => function ($query) {
                $query->with('movie')->orderBy('created_at', 'desc');
            },
            'ratings'
        ]);

        // 3. Trả về view: resources/views/user/profile.blade.php
        return view('user.profile', compact('user'));
    }
}