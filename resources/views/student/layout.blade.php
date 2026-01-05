<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - Pyinnyar Pankhin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        :root {
            --primary: #FF7300;
            --primary-hover: #e66900;
            --secondary: #f8f9fa;
            --dark: #343a40;
            --light: #ffffff;
        }

        body {
            background-color: #f5f5f5;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .student-navbar {
            background: linear-gradient(310deg, #FF7300, #ff9500);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .student-navbar .navbar-brand {
            color: white !important;
            font-weight: 700;
        }

        .student-navbar .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .student-navbar .nav-link:hover {
            color: white !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .welcome-card {
            background: linear-gradient(135deg, #FF7300, #ff9500);
            color: white;
            border-radius: 20px;
            border: none;
        }

        .stat-card {
            text-align: center;
            padding: 2rem 1rem;
            background: white;
            border-radius: 15px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .book-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .book-cover {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .book-placeholder {
            height: 200px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 3rem;
        }

        .search-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        .btn-primary {
            background: linear-gradient(310deg, #FF7300, #ff9500);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(310deg, #e66900, #e66900);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 115, 0, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #FF7300;
            color: #FF7300;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #FF7300;
            border-color: #FF7300;
            transform: translateY(-2px);
        }

        .footer {
            background: #343a40;
            color: white;
            margin-top: 3rem;
            padding: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg student-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('student.dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>
                Student Portal
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.books*') ? 'active' : '' }}" href="{{ route('student.books') }}">
                            <i class="fas fa-book me-1"></i> Library
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ $studentName }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    {{-- <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Pyinnyar Pankhin University</h5>
                    <p class="mb-0">Empowering students through knowledge and innovation.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; {{ date('Y') }} Pyinnyar Pankhin University. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
