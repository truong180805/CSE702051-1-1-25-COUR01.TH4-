@extends('layouts.admin')

@section('title', 'Thêm phim mới')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">➕ Thêm phim mới</h1>

    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên phim</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <select name="genre_id" class="form-select" required>
                <option value="">-- Chọn thể loại --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Năm phát hành</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Poster</label>
            <input type="file" name="poster" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Lưu phim</button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
