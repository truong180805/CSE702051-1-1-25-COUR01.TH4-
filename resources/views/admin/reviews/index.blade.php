@extends('layouts.admin')

@section('title', 'Quản lý đánh giá')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">💬 Quản lý / Kiểm duyệt Reviews</h1>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Phim</th>
                <th>Nội dung</th>
                <th>Điểm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->movie->title }}</td>
                <td>{{ Str::limit($review->content, 50) }}</td>
                <td>{{ $review->rating->rating }}/5</td>
                <td>
                    
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa đánh giá này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
