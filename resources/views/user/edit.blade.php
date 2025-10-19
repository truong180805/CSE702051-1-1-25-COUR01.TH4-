@extends('layouts.app')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">✏️ Chỉnh sửa thông tin cá nhân</h5>
                    <a href="{{ route('user.profile') }}" class="btn btn-light btn-sm">← Quay lại hồ sơ</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Avatar -->
                        <div class="text-center mb-4">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                                 class="rounded-circle border shadow-sm" width="120" height="120" alt="Avatar hiện tại">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện mới</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                            <small class="text-muted">Định dạng cho phép: JPG, PNG, JPEG. Kích thước tối đa 2MB.</small>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Tên người dùng</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label class="form-label">Giới thiệu bản thân</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Viết đôi dòng về bạn...">{{ old('bio', Auth::user()->bio) }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">💾 Lưu thay đổi</button>
                            <a href="{{ route('user.profile') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
