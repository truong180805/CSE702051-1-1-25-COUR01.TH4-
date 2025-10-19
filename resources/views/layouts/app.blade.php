<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVIERATING - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    main {
        flex: 1; /* phần nội dung chiếm toàn bộ không gian trống còn lại */
    }

    .navbar {
        background-color: #1a1a1a;
    }

    .navbar-brand {
        color: #ffc107 !important;
        font-weight: bold;
        font-size: 1.3rem;
    }

    .nav-link {
        color: #fff !important;
        transition: 0.3s;
    }

    .nav-link:hover {
        color: #ffc107 !important;
    }

    footer {
        background: #1a1a1a;
        color: #ccc;
        padding: 15px 0;
        text-align: center;
        margin-top: auto; /* đẩy footer xuống đáy */
    }
</style>
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🎬 MOVIERATING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="genreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Thể Loại phim
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="genreDropdown">
                            @php
                                $genres = [
                                    'Hành động',
                                    'Phiêu lưu',
                                    'Hài hước',
                                    'Tình cảm',
                                    'Kinh dị',
                                    'Khoa học viễn tưởng',
                                    'Tâm lý',
                                    'Hình sự',
                                    'Hoạt hình',
                                    'Chiến tranh',
                                    'Âm nhạc',
                                    'Gia đình',
                                    'Viễn Tây',
                                    'Thần thoại',
                                    'Tài liệu'
                                ];
                            @endphp

                            @foreach ($genres as $genre)
                                <li>
                                    <a class="dropdown-item" href="{{ route('movies.byGenre', $genre) }}">
                                        {{ $genre }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Trang cá nhân</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© {{ date('Y') }} MOVIERATING — Web Review & Đánh Giá Phim</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
