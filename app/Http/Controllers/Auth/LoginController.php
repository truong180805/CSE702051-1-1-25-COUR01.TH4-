<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    //hien thi form dang nhap
    public function create() 
    {
        return view('auth.login');
    }

    //xu ly dang nhap
    public function store(Request $request): RedirectResponse
    {
        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Thử đăng nhập
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            
            // --- LOGIC KIỂM TRA ROLE VÀ CHUYỂN HƯỚNG MỚI ---
            
            $user = Auth::user(); // Lấy đối tượng User hiện tại
            
            if ($user->role === 'admin') {
                // Nếu là Admin, chuyển hướng đến trang Admin Dashboard
                // (Chúng ta sẽ coi 'admin.movies.index' là trang mặc định)
                return redirect()->intended(route('admin.movies.index'));
            }
            
            // Nếu là người dùng thường ('user'), chuyển hướng đến trang chủ công cộng
            return redirect()->intended(route('movies.index'));
            
            // --------------------------------------------------
        }

        // 3. Đăng nhập thất bại, quay lại form với thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không hợp lệ.',
        ])->onlyInput('email');
    }

    //dang xuat 
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        // Xóa session và tái tạo CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Chuyển hướng đến trang chủ
        return redirect()->route('movies.index');
    }
}

