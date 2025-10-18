<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class AdminMovieController extends Controller
{
    //hien thi danh sach phim
     public function index()
    {
        $movies = Movie::orderBy('created_at', 'desc')->get();
        // Trả về view: resources/views/admin/movies/index.blade.php
        return view('admin.movies.index', compact('movies'));
    }

    //hien thi form tao phim moi
    public function create()
    {
        // Trả về view: resources/views/admin/movies/create.blade.php
        return view('admin.movies.index');
    }

    //xu ly tao phim moi
    public function store(Request $request)
    {
        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:movies,title'],
            'description' => ['required', 'string'],
            'genre' => ['required', 'string', 'max:100'],
            'release_date' => ['required', 'date'],
            'poster_url' => ['nullable', 'url', 'max:255'],
            'trailer_url' => ['nullable', 'url', 'max:255'],
        ]);
        // 2. Tạo Movie mới
        Movie::create($request->all());

        // 3. Chuyển hướng đến trang danh sách phim Admin
        return redirect()->route('admin.movies.index')
                         ->with('success', 'Phim mới đã được thêm thành công!');
    }

    //hien thi form sua phim
    public function edit(Movie $movie)
    {
        // Trả về view: resources/views/admin/movies/edit.blade.php
        return view('admin.movies.edit', compact('movie'));
    }

    //xu ly cap nhat thong tin
     public function update(Request $request, Movie $movie)
    {
        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $request->validate([
            // 'unique:movies,title' phải loại trừ chính movie đang được sửa
            'title' => ['required', 'string', 'max:255', 'unique:movies,title,' . $movie->id], 
            'description' => ['required', 'string'],
            'genre' => ['required', 'string', 'max:100'],
            'release_date' => ['required', 'date'],
            'poster_url' => ['nullable', 'url', 'max:255'],
            'trailer_url' => ['nullable', 'url', 'max:255'],
        ]);

        // 2. Cập nhật Movie
        $movie->update($request->all());

        // 3. Chuyển hướng đến trang danh sách phim Admin
        return redirect()->route('admin.movies.index')
                         ->with('success', 'Phim "' . $movie->title . '" đã được cập nhật thành công!');
    }

    //xoa phim
    public function destroy(Movie $movie)
    {
        $movieTitle = $movie->title;
        
        // 1. Xóa phim
        // Việc này sẽ tự động xóa tất cả Reviews, Ratings, và Comments (qua Review)
        // liên quan đến phim này nhờ onDelete('cascade')
        $movie->delete();

        // 2. Chuyển hướng đến trang danh sách phim Admin
        return redirect()->route('admin.movies.index')
                         ->with('success', 'Phim "' . $movieTitle . '" và tất cả dữ liệu liên quan đã được xóa thành công!');
    }
}
