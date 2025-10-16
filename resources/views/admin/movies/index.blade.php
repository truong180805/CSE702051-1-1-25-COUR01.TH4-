@extends('layouts.admin')

@section('title', 'Quản lý danh sách phim')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>🎞️ Danh sách phim</h1>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">+ Thêm phim mới</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Tên phim</th>
                <th>Thể loại</th>
                <th>Năm</th>
                <th>Điểm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td><img src="{{ asset('storage/' . $movie->poster) }}" alt="poster" width="50"></td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre->name ?? 'N/A' }}</td>
                <td>{{ $movie->year }}</td>
                <td>{{ $movie->rating }}</td>
                <td>
                    <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa phim này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
