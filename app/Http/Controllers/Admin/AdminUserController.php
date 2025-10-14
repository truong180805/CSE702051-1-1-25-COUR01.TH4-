<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //hien thi ds nguoi dung
    public function index()
    {
        // Lấy tất cả người dùng trừ tài khoản Admin hiện tại (tùy chọn)
        $users = User::where('id', '!=', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->get();
                     
        // Trả về view: resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact('users'));
    }

    //hien thi form sua/phan quyen nguoi dung
    public function edit(User $user)
    {
        // Không cho phép Admin tự sửa/xóa tài khoản của chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Bạn không thể sửa tài khoản Admin của chính mình.');
        }

        // Trả về view: resources/views/admin/users/edit.blade.php
        return view('admin.users.edit', compact('user'));
    }

    //xu ly cap nhat thong tin va phan quyen nguoi dung
    public function update(Request $request, User $user)
    {
        // Không cho phép Admin tự sửa/xóa tài khoản của chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể sửa tài khoản Admin hiện tại.');
        }

        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        // 2. Cập nhật vai trò (role)
        $user->update([
            'role' => $request->role,
        ]);

        // 3. Chuyển hướng
        return redirect()->route('admin.users.index')
                         ->with('success', 'Vai trò của người dùng "' . $user->name . '" đã được cập nhật thành công.');
    }
    
    //xu ly xoa nguoi dung
    public function destroy(User $user)
    {
        // Không cho phép Admin tự sửa/xóa tài khoản của chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa tài khoản Admin hiện tại.');
        }
        
        $userName = $user->name;

        // 1. Xóa người dùng
        // Việc này sẽ tự động xóa tất cả Reviews, Ratings, Comments liên quan
        // nhờ onDelete('cascade') trong các file Migration.
        $user->delete();

        // 2. Chuyển hướng
        return redirect()->route('admin.users.index')
                         ->with('success', 'Người dùng "' . $userName . '" và tất cả dữ liệu liên quan đã bị xóa.');
    }
}
