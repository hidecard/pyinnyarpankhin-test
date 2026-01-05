<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - Pyinnyar Pankhin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin-style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Sidebar start -->
    <div class="sidebar" id="sidebar">
        <!-- Sidebar Logo -->
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="logo-text">
                <h3>Pyinnyar Pankhin</h3>
                <small>Admin Dashboard</small>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin') }}" class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="has-submenu {{ request()->is('admin/academic*') || request()->is('admin/degrees*') || request()->is('admin/durations*') || request()->is('admin/majors*') || request()->is('admin/departments*') || request()->is('admin/faculties*') || request()->is('admin/intakes*') || request()->is('admin/intake-details*') || request()->is('admin/tuitions*') || request()->is('admin/subjects*') || request()->is('admin/sub-subjects*') ? 'active' : '' }}">
                <a href="#" class="submenu-toggle">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Academics</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.academic') }}" class="{{ request()->routeIs('admin.academic') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.degrees.index') }}" class="{{ request()->routeIs('admin.degrees.*') ? 'active' : '' }}">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Degree Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.durations.index') }}" class="{{ request()->routeIs('admin.durations.*') ? 'active' : '' }}">
                            <i class="fas fa-clock"></i>
                            <span>Program Duration</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.majors.index') }}" class="{{ request()->routeIs('admin.majors.*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            <span>Academic Majors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.departments.index') }}" class="{{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                            <i class="fas fa-building"></i>
                            <span>Departments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.faculties.index') }}" class="{{ request()->routeIs('admin.faculties.*') ? 'active' : '' }}">
                            <i class="fas fa-university"></i>
                            <span>Faculties</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.intakes.index') }}" class="{{ request()->routeIs('admin.intakes.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Intakes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.intake-details.index') }}" class="{{ request()->routeIs('admin.intake-details.*') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>Intake Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tuitions.index') }}" class="{{ request()->routeIs('admin.tuitions.*') ? 'active' : '' }}">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Tuition Fees</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subjects.index') }}" class="{{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                            <i class="fas fa-book-open"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sub-subjects.index') }}" class="{{ request()->routeIs('admin.sub-subjects.*') ? 'active' : '' }}">
                            <i class="fas fa-book-reader"></i>
                            <span>Sub-Subjects</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.admissions.index') }}" class="{{ request()->routeIs('admin.admissions.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Admissions</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.calendar') }}" class="{{ request()->routeIs('admin.calendar') ? 'active' : '' }}">
                    <i class="fas fa-calendar"></i>
                    <span>Calendar</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.students.index') }}" class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Student Info</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Events</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>User Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Role Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- sidebar end -->

    <!-- Top Navigation Bar -->
    <nav class="top-navbar">
        <div class="navbar-content">
            <!-- Sidebar Toggle Button -->
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin') }}" title="Home">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            <!-- Top Navbar Right -->
            <div class="navbar-right">
                <!-- Search Bar -->
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search..." id="globalSearch" title="Search">
                    <i class="fas fa-search search-icon"></i>
                </div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn d-flex btn-link user-profile-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="user-name">{{ Auth::user()->name ?? 'Admin User' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu user-menu" aria-labelledby="userDropdown">
                        <li class="dropdown-header">
                            <div class="user-info">
                                <div class="user-avatar-lg">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <h6 class="mb-0">{{ Auth::user()->name ?? 'Admin User' }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content start-->
    <main class="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        // Initialize sidebar submenu toggle
        document.querySelectorAll('.submenu-toggle').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = this.parentElement;
                parentLi.classList.toggle('active');
            });
        });

        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const topNavbar = document.querySelector('.top-navbar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Check if we're on mobile
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                // Mobile behavior: show/hide sidebar with overlay
                sidebar.classList.toggle('show');
                sidebarOverlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
            } else {
                // Desktop behavior: collapse/expand sidebar
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                topNavbar.classList.toggle('expanded');
            }
        });

        // Close sidebar when clicking overlay on mobile
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('show');
            sidebarOverlay.style.display = 'none';
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const topNavbar = document.querySelector('.top-navbar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth > 768) {
                // Reset mobile styles on desktop
                sidebar.classList.remove('show');
                sidebarOverlay.style.display = 'none';
            }
        });

        // Global search functionality
        document.getElementById('globalSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            console.log('Searching for:', searchTerm);
        });

        // Add active class to current page menu item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    // Also expand parent submenu if applicable
                    const parentLi = link.closest('.has-submenu');
                    if (parentLi) {
                        parentLi.classList.add('active');
                    }
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

