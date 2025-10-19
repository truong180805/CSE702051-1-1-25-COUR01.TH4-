@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="container" style="max-width: 900px;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">👤 Hồ sơ người dùng</h3>
        @if (Auth::id() === $user->id)
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline-dark btn-sm">✏️ Chỉnh sửa hồ sơ</a>
        @endif
    </div>

    {{-- Thông tin người dùng --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body d-flex align-items-center">
            <div class="me-4">
                <img src="{{ $user->avatar_url ?? 'https://via.placeholder.com/120x120?text=User' }}"
                     alt="Avatar"
                     class="rounded-circle border shadow-sm"
                     style="width: 120px; height: 120px; object-fit: cover;">
            </div>
            <div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-1">📧 {{ $user->email }}</p>
                <p class="text-muted">🕓 Tham gia từ: {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Các đánh giá đã viết --}}
    <div>
        <h4 class="fw-bold mb-3">🎬 Các đánh giá đã viết</h4>

        @if ($reviews->isEmpty())
            <p class="text-muted">Người dùng này chưa viết đánh giá nào.</p>
        @else
            <div class="row g-3">
                @foreach ($reviews as $review)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('movies.show', $review->movie->id) }}" class="text-dark text-decoration-none">
                                        {{ $review->movie->title }}
                                    </a>
                                </h5>

                                {{-- Hiển thị sao + X/5 --}}
                                <p class="mb-1 text-muted">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating->rating)
                                            ⭐
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                    {{ $review->rating->rating }}/5
                                    <small class="ms-2">{{ $review->created_at->diffForHumans() }}</small>
                                </p>

                                <p class="card-text">{{ $review->content }}</p>

                                @if (Auth::id() === $user->id)
                                    <div class="text-end mt-2">
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
