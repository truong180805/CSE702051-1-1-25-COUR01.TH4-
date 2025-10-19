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
        $reviews = $user->reviews;
        // 3. Trả về view: resources/views/user/profile.blade.php
        return view('user.profile', compact('user', 'reviews'));
    }
    public function edit()
    {
        // Lấy người dùng đang đăng nhập
        $user = Auth::user();

        // Trả về view: resources/views/user/edit.blade.php
        return view('user.edit', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Email phải là duy nhất, nhưng loại trừ email của chính người dùng này
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            // Mật khẩu chỉ bắt buộc nếu người dùng muốn thay đổi (nếu có, phải xác nhận)
            'password' => ['nullable', 'confirmed', 'min:8'], 
        ]);
        
        // 2. Chuẩn bị dữ liệu cập nhật
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // 3. Xử lý Mật khẩu (Chỉ cập nhật nếu có nhập)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 4. Cập nhật User
        $user->update($data);

        // 5. Chuyển hướng trở lại trang Profile
        return redirect()->route('profile')
                         ->with('success', 'Hồ sơ cá nhân của bạn đã được cập nhật thành công!');
    }
}