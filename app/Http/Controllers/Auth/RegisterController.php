<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //hien thi form dang ky
    public function create()
    {
        return view('auth.register');
    }

    //xu ly yeu cau dang ky nguoi dung moi
    public function store(Request $request)
    {
        //kiem tra hop le cua du lieu
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //tao nguoi dung moi
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // dang nhap luon
        Auth::login($user);

        //chuyen huong den trang chu khi dang ky thanh cong
        return redirect()->route('movies.index');
    }
}
