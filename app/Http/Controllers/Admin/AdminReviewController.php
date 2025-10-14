<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Movie;


class AdminReviewController extends Controller
{
    //hien thi reviews
    public function index()
    {
        // Lấy tất cả Reviews, kèm theo thông tin User và Movie liên quan
        $reviews = Review::with(['user', 'movie'])
                         ->orderBy('created_at', 'desc')
                         ->get();
                         
        // Trả về view: resources/views/admin/reviews/index.blade.php
        return view('admin.reviews.index', compact('reviews'));
    }

    //xu ly xoa review
    public function destroyReview(Review $review)
    {
        // 1. Lưu đối tượng Movie để cập nhật điểm trung bình
        $movie = $review->movie; 

        // 2. Xóa Rating liên quan
        // (Rating có ràng buộc duy nhất user_id và movie_id, nên chỉ cần tìm theo 2 khóa này)
        Rating::where('user_id', $review->user_id)
              ->where('movie_id', $review->movie_id)
              ->delete();
        
        // 3. Xóa Review
        // Việc này sẽ tự động xóa tất cả Comments liên quan (onDelete('cascade') trong bảng comments)
        $review->delete();
        
        // 4. Cập nhật Điểm trung bình của Phim (Tái sử dụng hàm từ ReviewController)
        // Chúng ta cần đảm bảo hàm này có thể được gọi. 
        // Vì đây là Controller riêng, chúng ta sẽ viết lại logic này hoặc tạo một Trait. 
        // Ở đây, tôi sẽ viết lại logic để giữ tính độc lập cho Controller này:
        $this->updateMovieAverageRating($movie);

        // 5. Chuyển hướng
        return redirect()->route('admin.reviews.index')
                         ->with('success', 'Review vi phạm đã được xóa thành công.');
    }

    //xoa comment
    public function destroyComment(Comment $comment)
    {
        // 1. Xóa Comment
        // Việc này sẽ tự động xóa các Comment con (replies) nếu có
        $comment->delete();

        // 2. Chuyển hướng
        return redirect()->route('admin.reviews.index')
                         ->with('success', 'Bình luận vi phạm đã được xóa thành công.');
    }

    //ham tinh toan va cap nhat diem tb
    protected function updateMovieAverageRating(Movie $movie)
    {
        // Lấy điểm trung bình của tất cả Ratings cho phim này
        $averageRating = $movie->ratings()->avg('rating');
        
        // Cập nhật cột avg_rating (chú ý: nếu không có Rating nào, avg là null, ta đặt là 0.00)
        $movie->update([
            'avg_rating' => number_format($averageRating ?? 0.00, 2, '.', ''),
        ]);
    }
}
