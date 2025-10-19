@extends('layouts.app')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">✏️ Chỉnh sửa thông tin cá nhân</h5>
                    <a href="{{ route('profile') }}" class="btn btn-light btn-sm">← Quay lại hồ sơ</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')



                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Tên người dùng</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                        </div>


                        <!-- Submit -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">💾 Lưu thay đổi</button>
                            <a href="{{ route('profile') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
