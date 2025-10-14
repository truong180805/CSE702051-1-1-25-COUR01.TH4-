@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm border-0" style="width: 400px; border-radius: 12px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold">🔐 Đăng nhập</h3>

            <!-- Thông báo lỗi -->
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Form đăng nhập -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-decoration-none small">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn btn-dark w-100">Đăng nhập</button>
            </form>

            <p class="text-center mt-4 mb-0">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-warning text-decoration-none">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</div>
@endsection
