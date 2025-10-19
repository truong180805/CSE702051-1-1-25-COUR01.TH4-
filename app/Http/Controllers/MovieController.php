<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class MovieController extends Controller
{   
    // Hiển thị danh sách các bộ phim

    public function index(){

    // lấy các bộ phim từ cơ sở dữ liệu
    // sắp xếp theo ngày phát hành mới nhất
    $movies = Movie::orderBy('id', 'desc')->paginate(4, ['*'], 'movies_page');
    
    $reviews = Review::orderBy('created_at', 'desc')->paginate(6, ['*'], 'reviews_page');
    // Truyền danh sách phim vào view
    return view('movies.index', compact('movies', 'reviews'));
    }



    // Hiển thị chi tiết một bộ phim
    public function show(Movie $movie){
        // $movie đã được tự động lấy từ DB nhờ Route Model Binding
        $movie->load([ 
            'reviews' => function ($query) {
                // Sắp xếp Reviews mới nhất trước
                $query->orderBy('created_at', 'desc')
                      ->with([
                        'user', // Tải người viết review
                        'comments' => function ($commentQuery) {
                            // tai cac comment con và user cua chung
                            $commentQuery->orderBy('created_at', 'asc')->with('replies.user');
                        }
                    ]);
            },
            'ratings',
        ]);

        return view('movies.show', compact('movie'));
    }
    public function filterByGenre($genre)
{
    $movies = \App\Models\Movie::where('genre', $genre)
        ->orderBy('id', 'desc')
        ->paginate(8);

    $reviews = \App\Models\Review::orderBy('created_at', 'desc')->paginate(6);

    return view('movies.index', compact('movies', 'reviews', 'genre'));
}
public function search(Request $request)
{
    $keyword = $request->input('keyword');

    // Nếu không nhập gì thì trả về tất cả phim
    if (!$keyword) {
        return redirect('/')->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
    }

    $movies = \App\Models\Movie::where('title', 'like', "%{$keyword}%")
        ->orWhere('description', 'like', "%{$keyword}%")
        ->orderBy('id', 'desc')
        ->paginate(8);

    // Lấy lại review để giữ giao diện như trang chủ
    $reviews = \App\Models\Review::orderBy('created_at', 'desc')->paginate(6);

    return view('movies.index', compact('movies', 'reviews', 'keyword'));
}
}
