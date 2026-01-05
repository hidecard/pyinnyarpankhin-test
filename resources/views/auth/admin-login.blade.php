<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pyinnyar Pankhin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --primary: #FF7300;
            --primary-hover: #e66900;
            --admin-dark: #2d3436;
            --text-main: #344767;
            --bg-body: #f0f2f5;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 20px 27px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(310deg, #FF7300, #ff9500);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .login-header img {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .login-header h2 { color: #fff; font-weight: 700; letter-spacing: -1px; }
        .login-header p { color: rgba(255,255,255,0.8); font-size: 0.9rem; }

        .nav-pills {
            background: #f8f9fa;
            padding: 5px;
            border-radius: 0.75rem;
            margin: 1.5rem 2rem 0;
        }

        .nav-pills .nav-link {
            border-radius: 0.5rem;
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #fff;
            color: var(--primary);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .login-body { padding: 2rem; }

        /* Custom Alert Styling */
        .alert-modern {
            border: none;
            border-left: 4px solid #ea0606;
            background-color: #fff5f5;
            color: #ea0606;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            margin-left: 0.25rem;
        }

        .input-group {
            border: 1px solid #d2d6da;
            border-radius: 0.5rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(255, 115, 0, 0.2);
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            color: #adb5bd;
            padding-left: 1rem;
        }

        .form-control {
            border: none;
            padding: 0.75rem 0.75rem 0.75rem 0;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .form-control:focus { box-shadow: none; outline: none; }

        .password-toggle {
            cursor: pointer;
            padding-right: 1rem;
            color: #adb5bd;
            transition: 0.2s;
        }
        .password-toggle:hover { color: var(--primary); }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }

        .btn-student { background: linear-gradient(310deg, #FF7300, #ff9500); }
        .btn-admin { background: linear-gradient(310deg, #2d3436, #485460); }

        .btn-login:hover { transform: translateY(-1px); filter: brightness(1.1); }

        .login-footer {
            text-align: center;
            padding-bottom: 2rem;
        }

        .login-footer a {
            color: #8392ab;
            font-size: 0.85rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .login-footer a:hover { color: var(--primary); }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
        <h2 class="mb-1">UOPP Portal</h2>
        <p class="mb-0">Enter your credentials to access</p>
    </div>

    <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-student-tab" data-bs-toggle="pill" data-bs-target="#pills-student" type="button" role="tab">Student</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-admin-tab" data-bs-toggle="pill" data-bs-target="#pills-admin" type="button" role="tab">Admin</button>
        </li>
    </ul>

    <div class="login-body">

        @if ($errors->any())
            <div class="alert alert-modern alert-dismissible fade show mb-4 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.6rem;"></button>
            </div>
        @endif

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-student" role="tabpanel">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="student">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="e.g. stu_9910" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" class="form-control pass-input" placeholder="••••••••" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login btn-student">Sign In as Student</button>
                </form>
            </div>

            <div class="tab-pane fade" id="pills-admin" role="tabpanel">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="admin">

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="admin@uopp.edu" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" class="form-control pass-input" placeholder="••••••••" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login btn-admin">Sign In as Admin</button>
                </form>
            </div>
        </div>
    </div>

    <div class="login-footer">
        <a href="/"><i class="fas fa-arrow-left me-1"></i> Return to Homepage</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(btn) {
        const input = btn.parentElement.querySelector('.pass-input');
        const icon = btn.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Persist tab logic
    document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', (e) => localStorage.setItem('lastTab', e.target.id));
    });

    window.onload = () => {
        const lastTab = localStorage.getItem('lastTab');
        if (lastTab) {
            const trigger = document.getElementById(lastTab);
            if(trigger) bootstrap.Tab.getOrCreateInstance(trigger).show();
        }
    }
</script>
</body>
</html>
