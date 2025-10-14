@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container">

    <!-- Movie header -->
    <div class="row mb-5">
        <div class="col-md-4 text-center">
            <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/350x500?text=No+Image' }}"
                 alt="{{ $movie->title }}"
                 class="img-fluid rounded shadow-sm">
        </div>

        <div class="col-md-8">
            <h2 class="fw-bold">{{ $movie->title }}</h2>
            <p class="text-muted mb-2">
                🎭 <strong>Thể loại:</strong> {{ $movie->genre ?? 'Chưa cập nhật' }}
            </p>
            <p class="text-muted mb-2">
                📅 <strong>Năm phát hành:</strong> {{ $movie->year ?? 'N/A' }}
            </p>
            <p class="text-muted mb-3">
                🎬 <strong>Đạo diễn:</strong> {{ $movie->director ?? 'Chưa rõ' }}
            </p>
            <p class="mb-4">{{ $movie->description ?? 'Không có mô tả cho bộ phim này.' }}</p>

            <h5 class="text-warning mb-3">
                ⭐ Đánh giá trung bình: <strong>{{ number_format($movie->average_rating, 1) ?? 'Chưa có' }}</strong> / 5
            </h5>

            @auth
                <a href="{{ route('reviews.create', $movie->id) }}" class="btn btn-dark">📝 Viết đánh giá</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning">Đăng nhập để đánh giá</a>
            @endauth
        </div>
    </div>

    <hr>

    <!-- Reviews Section -->
    <div class="mt-5">
        <h4 class="fw-bold mb-4">📝 Các đánh giá gần đây</h4>

        @if ($reviews->isEmpty())
            <p class="text-muted">Chưa có đánh giá nào cho bộ phim này.</p>
        @else
            @foreach ($reviews as $review)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $review->user->name }}</strong>
                            <span class="text-warning">⭐ {{ $review->rating }}/5</span>
                        </div>
                        <p class="mt-2 mb-1">{{ $review->comment }}</p>
                        <small class="text-muted">
                            {{ $review->created_at->diffForHumans() }}
                        </small>

                        @auth
                            @if ($review->user_id === Auth::id())
                                <div class="mt-2">
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-outline-secondary btn-sm">Sửa</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
