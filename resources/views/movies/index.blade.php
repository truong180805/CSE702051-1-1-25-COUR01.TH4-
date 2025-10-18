@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="text-center mb-5">
    <h1 class="fw-bold">🎬 MOVIERATING</h1>
    <p class="text-muted fs-5">Khám phá, đánh giá và chia sẻ cảm nhận về những bộ phim bạn yêu thích.</p>
</div>

<!-- Thanh tìm kiếm phim -->
<div class="container mb-4">
    <form action="{{ url('/movies/search') }}" method="GET" class="d-flex justify-content-center">
        <input type="text" name="keyword" class="form-control w-50 me-2" placeholder="🔍 Tìm kiếm phim...">
        <button type="submit" class="btn btn-warning">Tìm kiếm</button>
    </form>
</div>

<!-- Danh sách phim nổi bật -->
<div class="container mt-5">
    <h3 class="mb-4">🔥 Phim nổi bật</h3>
    <div class="row g-4">
        @foreach ($movies as $movie)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset($movie->poster_url) }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($movie->description, 80) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center">
                        <a href="{{ url('/movies/' . $movie->id) }}" class="btn btn-outline-dark btn-sm">Chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
    {{ $movies->links() }}
    </div>
    @if ($movies->isEmpty())
        <p class="text-center text-muted mt-5">Chưa có phim nào được thêm.</p>
    @endif
</div>

<!-- Khu vực đánh giá gần đây -->
<div class="container mt-5">
    <h3 class="mb-4">📝 Đánh giá gần đây</h3>
    <div class="list-group">
        @foreach ($reviews as $review)
            <div class="list-group-item">
                <strong>{{ $review->user->name }}</strong> đánh giá 
                <a href="{{ url('/movies/' . $review->movie->id) }}">{{ $review->movie->title }}</a>:
                <span class="text-warning">★ {{ $review->rating->rating ?? 'N/A' }}/5</span>
                <p class="mb-0 text-muted small">{{ Str::limit($review->content, 120) }}</p>
            </div>
        @endforeach

        @if ($reviews->isEmpty())
            <p class="text-center text-muted">Chưa có đánh giá nào.</p>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
