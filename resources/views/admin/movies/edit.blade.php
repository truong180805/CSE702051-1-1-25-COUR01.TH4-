@extends('layouts.admin')

@section('title', 'Sửa thông tin phim')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">✏️ Chỉnh sửa phim</h1>

    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên phim</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <select name="genre" class="form-select" required>
            @foreach($genres as $genre)
                <option value="{{ $genre }}" {{ $movie->genre === $genre ? 'selected' : '' }}>
                    {{ $genre }}
                </option>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Năm phát hành</label>
            <input type="number" name="year" value="{{ old('year', $movie->year) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đạo diễn</label>
            <input type="text" name="director" value="{{ old('director', $movie->director) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Poster hiện tại</label><br>
            <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="poster" width="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Cập nhật Poster</label>
            <input type="file" name="poster" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
