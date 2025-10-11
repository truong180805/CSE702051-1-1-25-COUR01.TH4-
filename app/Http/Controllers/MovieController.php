<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{   
    // Hiển thị danh sách các bộ phim

    public function index(){

    // lấy các bộ phim từ cơ sở dữ liệu
    // sắp xếp theo ngày phát hành mới nhất
    $movies = Movie::orderBy('release_date', 'desc')->get();

    // Truyền danh sách phim vào view
    return view('movies.index', compact('movies'));
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
                            $commentQuer->orderBy('created_at', 'asc')->with('replies.user');
                        }
                    ]);
            },
            'ratings',
        ]);
        return view('movies.show', compact('movie'));
    }

}
