<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminUserController;

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

Route::prefix('admin')->middleware(['auth','admin'])->group(function (){
    //trang chu quan ly phim
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
    Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
    Route::post('/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
    Route::put('/movies/{movie}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{movie}', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');

    //quan ly nguoi dung
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    //quan ly review
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroyReview'])->name('admin.reviews.destroy');
    Route::delete('/comments/{comment}', [AdminReviewController::class, 'destroyComment'])->name('admin.comments.destroy');

});