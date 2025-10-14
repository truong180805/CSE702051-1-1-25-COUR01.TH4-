<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ReviewController extends Controller
{
    //tao revie va rating moi
    public function create(Movie $movie)
    {
        return view('reviews.create', compact('movie'));
    }

    public function store(Request $request)
    {
        //kiem tra du lieu dau vao
        $request->validate([
            'movie_id' => ['required', 'exists:movies,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10'],
        //dam bao nguoi dung chua review/rating phim nay
        Rule::unique('reviews')->where(function ($query) use ($request) {
                return $query->where('user_id', Auth::id())
                             ->where('movie_id', $request->movie_id);
        }),
        ], [
            'content.min' => 'Nội dung review phải có ít nhất 10 ký tự.',
            'unique' => 'Bạn đã review và chấm điểm cho bộ phim này rồi.',
        ]);

        //lay movie
        $movie = Movie::findOrFail($request->movie_id);
        
        //tao review
        $review = Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'content' => $request->content,
        ]);

        //tao rating
        Rating::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'rating' => $request->rating,
        ]);

        //cap nhap diem trung binh cua phim
        $this->updateMovieAverageRating($movie);

        //chuyen huong lai trang chi tiet
        return redirect()->route('movies.show', $movie)
                         ->with('success', 'Review và Rating của bạn đã được gửi thành công!');
    }

    //sua review va rating
    public function update(Request $request, Review $review)
    {
        //dam bao dung nguoi review
        if (Auth::id() !== $review->user_id) {
            // Sử dụng abort(403) để từ chối truy cập (Forbidden)
            abort(403, 'Bạn không có quyền sửa đánh giá này.');
        }

        //kiem tra dau vao
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10'],
        ], [
            'content.min' => 'Nội dung review phải có ít nhất 10 ký tự.',
        ]);
        
        //cap nhat review
        $review->update([
            'content' => $request->content,
        ]);

        //cap nhat rating
        // Lấy Rating liên quan đến Review này. Do có ràng buộc unique (user_id, movie_id)
        // nên Rating của người dùng này là duy nhất.
        $rating = Rating::where('user_id', Auth::id())
                        ->where('movie_id', $review->movie_id)
                        ->firstOrFail();

        $rating->update([
            'rating' => $request->rating,
        ]);
        
        //cap nhat diem rating tb 
        $this->updateMovieAverageRating($review->movie);

        //Chuyển hướng trở lại trang chi tiết phim
        return redirect()->route('movies.show', $review->movie)
                         ->with('success', 'Review và Rating của bạn đã được cập nhật thành công!');
    }

    //xoa review va rating
    public function destroy(Review $review)
    {
        //dam vao dung nguoi review
        if (Auth::id() !== $review->user_id) {
            abort(403, 'Bạn không có quyền xóa đánh giá này.');
        }
        
        //lay doi tuong
        $movie = $review->movie; 

        //xoa rating lien quan
        Rating::where('user_id', Auth::id())
              ->where('movie_id', $review->movie_id)
              ->delete();
        
        //xoa review
        // Các Comments liên quan đến Review này sẽ tự động xóa nhờ onDelete('cascade')
        // trong Migration của bảng comments
        $review->delete();

        //cap nhat diem tb phim
        $this->updateMovieAverageRating($movie);

        //chuyen huong lai
        return redirect()->route('movies.show', $movie)
                         ->with('success', 'Review và Rating của bạn đã được xóa thành công!');
    }
    

    //ham tinh toan va cap nhap diem trung binh cua phim
    protected function updateMovieAverageRating(Movie $movie)
    {
        //lay diem tb cua tat ca rating cho phim
        $averageRating = $movie->ratings()->avg('rating');
        //cap nhap cot avg_rating
        $movie->update([
            'avg_rating' => number_format($averageRating, 2, '.', ''),
        ]);
}

}