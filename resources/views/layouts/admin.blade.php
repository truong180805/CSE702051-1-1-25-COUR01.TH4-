<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MOVIERATING Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Inter", sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #495057;
            color: #fff;
        }
        .content-area {
            padding: 20px;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .btn-logout {
        background: none;
        border: none;
        color: #adb5bd;
        text-decoration: none;
        display: block;
        width: 100%;
        text-align: left;
        padding: 10px 20px;
        font: inherit;
        cursor: pointer;
        }
        .btn-logout:hover {
            background: #495057;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar col-2">
            <h4 class="text-center mb-4">🎬 MOVIERATING</h4>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Tổng quan</a>
            <a href="{{ route('admin.movies.index') }}" class="{{ request()->routeIs('admin.movies.*') ? 'active' : '' }}">🎞️ Quản lý phim</a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">👥 Người dùng</a>
            <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">💬 Đánh giá</a>
            <hr class="text-secondary">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" 
                    class="btn-logout" 
                    onclick="return confirm('Đăng xuất khỏi hệ thống?')">🚪 Đăng xuất</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-10">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h4">@yield('title')</span>
                <span class="text-muted">Xin chào, {{ Auth::user()->name ?? 'Admin' }}</span>
            </nav>

            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
