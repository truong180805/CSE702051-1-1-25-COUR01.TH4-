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
        //kiem tra du lieu vao
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //dang nhap
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('movies.index'));
        }

        //that bai
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

