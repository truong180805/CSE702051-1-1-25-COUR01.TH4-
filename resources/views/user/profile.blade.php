@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">👤 Hồ sơ người dùng</h3>
        @if (Auth::id() === $user->id)
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline-dark btn-sm">✏️ Chỉnh sửa hồ sơ</a>
        @endif
    </div>

    <!-- Thông tin người dùng -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body d-flex align-items-center">
            <div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-1">📧 {{ $user->email }}</p>
                <p class="text-muted">🕓 Tham gia từ: {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Danh sách review của người dùng -->
    <div>
        <h4 class="fw-bold mb-3">🎬 Các đánh giá đã viết</h4>

        @if ($reviews->isEmpty())
            <p class="text-muted">Người dùng này chưa viết đánh giá nào.</p>
        @else
            @foreach ($reviews as $review)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">
                                    <a href="{{ route('movies.show', $review->movie->id) }}" class="text-dark text-decoration-none">
                                        {{ $review->movie->title }}
                                    </a>
                                </h5>
                                <p class="text-muted mb-1">
                                    ⭐ {{ $review->rating->rating }}/5 |
                                    <small>{{ $review->created_at->diffForHumans() }}</small>
                                </p>
                                <p class="mb-0">{{ $review->content }}</p>
                            </div>

                            @if (Auth::id() === $user->id)
                                <div class="text-end">
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
