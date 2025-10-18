<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class MovieController extends Controller
{   
    // Hiển thị danh sách các bộ phim

    public function index()
    {
        // Lấy 4 phim mới nhất, có phân trang
        $movies = Movie::orderBy('id', 'desc')->paginate(4);

        // ✅ Lấy 6 review mới nhất, không phân trang để không bị mất khi chuyển trang phim
        $reviews = Review::with(['user', 'movie'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

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

}
