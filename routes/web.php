<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Route để hiển thị danh sách phim
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Route để hiển thị chi tiết một bộ phim
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');