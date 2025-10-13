<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Route để hiển thị danh sách phim
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Route để hiển thị chi tiết một bộ phim
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::middleware('guest')->group(function () {
    // --- Đăng Ký (Registration) ---
    // Hiển thị form đăng ký
    Route::get('/register', [RegisterController::class, 'create'])->name('register'); 
    // Xử lý dữ liệu đăng ký
    Route::post('/register', [RegisterController::class, 'store']); 

    // --- Đăng Nhập (Login) ---
    // Hiển thị form đăng nhập
    Route::get('/login', [LoginController::class, 'create'])->name('login'); 
    // Xử lý dữ liệu đăng nhập
    Route::post('/login', [LoginController::class, 'store']);
});

// Group Route cho Người dùng đã đăng nhập
Route::middleware('auth')->group(function () {
    // --- Đăng Xuất (Logout) ---
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout'); 
    
    // viet, xoa , sua review va rating
    // xu ly tao review va rating moi 
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store'); 

    //xu ly sua review va rating
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    //xu ly xoa review va rating
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});