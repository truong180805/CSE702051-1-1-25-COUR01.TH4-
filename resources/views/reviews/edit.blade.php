@extends('layouts.app')

@section('title', 'Chỉnh sửa đánh giá')

@section('content')
<div class="container" style="max-width: 700px;">
    <h3 class="fw-bold mb-4 text-center">✏️ Chỉnh sửa đánh giá</h3>

    <!-- Thông tin phim -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $review->movie->poster_url ?? 'https://via.placeholder.com/300x450?text=No+Image' }}"
                     alt="{{ $review->movie->title }}"
                     class="img-fluid rounded-start"
                     style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $review->movie->title }}</h5>
                    <p class="card-text text-muted small">
                        🎭 {{ $review->movie->genre ?? 'Chưa cập nhật' }} | 📅 {{ $review->movie->year ?? 'N/A' }}
                    </p>
                    <p class="card-text text-muted">
                        {{ Str::limit($review->movie->description, 100) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form chỉnh sửa -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reviews.update', $review->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="rating" class="form-label">Chọn số sao (1–5)</label>
                    <select name="rating" id="rating" class="form-select" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $review->rating->rating == $i ? 'selected' : '' }}>
                                {{ $i }} ⭐
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung đánh giá</label>
                    <textarea name="content" id="content" rows="5" class="form-control" required>{{ $review->content }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('movies.show', $review->movie->id) }}" class="btn btn-outline-secondary">⬅ Quay lại</a>
                    <button type="submit" class="btn btn-dark">💾 Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
