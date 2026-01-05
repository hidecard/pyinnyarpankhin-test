<style>

.navbar .nav-link {
    font-weight: 500;
    color: #333 !important;
    padding: 8px 12px;
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}

/* hover */
.navbar .nav-link:hover {
    border-left: 3px solid #FF7300;
    color: #FF7300 !important;
    padding-left: 16px;
}

/* active */
.navbar .nav-link.active {
    border-left: 3px solid #FF7300;
    color: #FF7300 !important;
    font-weight: 600;
}
</style>




<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom"
     style="border-color:#FF7300 !important;">
    <div class="container">

        <!-- Logo & Title -->
        <a class="navbar-brand d-flex align-items-center fw-bold"
           href="{{ route('home') }}"
           style="color:#FF7300;">
            <img src="{{ asset('assets/images/logo.png') }}"
                 alt="Pyinnyar Pankhin University Logo"
                 width="50" height="50"
                 class="me-2">
            <span class="lh-sm">
                Pyinnyar Pankhin <br>
                University
            </span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3 text-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('academics') ? 'active' : '' }}"
                       href="{{ route('academics') }}">Academics</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('certificate') ? 'active' : '' }}"
                       href="{{ route('certificate') }}">Certificate</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('department') ? 'active' : '' }}"
                       href="{{ route('department') }}">Department</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admissions') ? 'active' : '' }}"
                       href="{{ route('admissions') }}">Admissions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('library') ? 'active' : '' }}"
                       href="{{ route('library') }}">Library</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('event') ? 'active' : '' }}"
                       href="{{ route('event') }}">Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">Contact</a>
                </li>

                <!-- Login/Student Info -->
                <li class="nav-item ms-lg-3">
                    @if(session('student_id'))
                        <!-- Student is logged in -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted">Welcome,</span>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle"
                                        type="button"
                                        id="studentDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    {{ session('student_name') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="studentDropdown">
                                    <li><a class="dropdown-item" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('student.books') }}">Library</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="px-3">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <!-- Show login button -->
                        <a class="btn text-white px-4"
                           style="background:#FF7300;"
                           href="{{ route('login') }}">
                            Login
                        </a>
                    @endif
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->
