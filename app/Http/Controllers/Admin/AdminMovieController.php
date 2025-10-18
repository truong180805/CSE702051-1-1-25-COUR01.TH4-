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
        $movies = Movie::orderBy('id', 'desc')->paginate(6);
        // Trả về view: resources/views/admin/movies/index.blade.php
        return view('admin.movies.index', compact('movies'));
    }

    //hien thi form tao phim moi
    public function create()
{
    $genres = [
        'Hành động',
        'Phiêu lưu',
        'Hài hước',
        'Tình cảm',
        'Kinh dị',
        'Khoa học viễn tưởng',
        'Tâm lý',
        'Hình sự',
        'Hoạt hình',
        'Chiến tranh',
        'Âm nhạc',
        'Gia đình',
        'Viễn Tây',
        'Thần thoại',
        'Tài liệu'
    ];

    return view('admin.movies.create', compact('genres'));
}

    //xu ly tao phim moi
    public function store(Request $request)
    {
        // 1. Kiểm tra tính hợp lệ của dữ liệu đầu vào
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:movies,title'],
            'description' => ['required', 'string'],
            'genre' => ['required', 'string', 'max:100'],
            'director' => 'nullable|string',
            'year' => ['required', 'integer'],
            'poster' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
        // 2. Tạo Movie mới
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/posters'), $fileName);
            $posterPath = 'images/posters/' . $fileName;
        }
        Movie::create([
        'title' => $request->title,
        'description' => $request->description,
        'director' => $request->director,
        'genre' => $request->genre,
        'year' => $request->year,
        'poster_url' => $posterPath, // lưu đường dẫn vào DB
        'trailer_url' => $request->trailer_url,
        ]);

        // 3. Chuyển hướng đến trang danh sách phim Admin
        return redirect()->route('admin.movies.index')
                         ->with('success', 'Phim mới đã được thêm thành công!');
    }

    //hien thi form sua phim
    public function edit(Movie $movie)
    {
        // Nếu thể loại là danh sách cố định:
        $genres = [
            'Hành động',
            'Phiêu lưu',
            'Hài hước',
            'Tình cảm',
            'Kinh dị',
            'Khoa học viễn tưởng',
            'Tâm lý',
            'Hình sự',
            'Hoạt hình',
            'Chiến tranh',
            'Âm nhạc',
            'Gia đình',
            'Viễn Tây',
            'Thần thoại',
            'Tài liệu'
        ];

        return view('admin.movies.edit', compact('movie', 'genres'));
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
            'year' => ['required', 'integer'],
            'poster' => ['nullable', 'image', 'max:2048'],
            
        ]);

        // 2. Cập nhật Movie
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->genre = $request->genre;
        $movie->year = $request->year;
        $movie->director = $request->director;

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/posters'), $fileName);
            $movie->poster_url = 'images/posters/' . $fileName;
        }

        $movie->save();
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
