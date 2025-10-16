@extends('layouts.admin')

@section('title', 'Trang tổng quan Admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📊 Thống kê hệ thống</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng số phim</h5>
                    <p class="display-6 fw-bold">{{ $movieCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="display-6 fw-bold">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Đánh giá</h5>
                    <p class="display-6 fw-bold">{{ $reviewCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Thể loại</h5>
                    <p class="display-6 fw-bold">{{ $genreCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
