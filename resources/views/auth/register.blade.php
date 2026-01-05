<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6C3428 0%, #FF7300 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .liquid-container {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .liquid-glass {
            position: relative;
            width: 420px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            z-index: 10;
        }

        .liquid-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: -40%;
            width: 100%;
            height: 100%;
            background: rgba(255, 115, 0, 0.05);
            transform: skewX(-15deg);
            pointer-events: none;
        }

        .university-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .university-header h2 {
            color: #FFFF;
            font-weight: 600;
            letter-spacing: 1px;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            outline: none;
            border-radius: 35px;
            font-size: 16px;
            color: #FFFF;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 1px solid #FF7300;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .register-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #FF7300, #E56700);
            border: none;
            outline: none;
            border-radius: 35px;
            color: #FFFF;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 15px 0;
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 115, 0, 0.4);
            background: linear-gradient(90deg, #E56700, #FF7300);
        }

        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-footer a:hover {
            color: #FFFF;
            text-decoration: underline;
        }

        .liquid-bubble {
            position: absolute;
            background: rgba(255, 115, 0, 0.1);
            border-radius: 50%;
            filter: blur(5px);
            animation: float 15s linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-1000px) rotate(720deg); }
        }

        .error-message {
            color: #FF7300;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
            display: none;
            font-weight: 500;
        }

        .success-message {
            color: #4BB543;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
            font-weight: 500;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .terms-check {
            display: flex;
            align-items: center;
            margin: 15px 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .terms-check input {
            margin-right: 10px;
        }

        .terms-check a {
            color: #FFFF;
            text-decoration: none;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="liquid-container" id="liquidContainer">
        <div class="liquid-glass">
            <div class="university-header">
                <h2>STUDENT REGISTRATION</h2>
            </div>

            @if($errors->any())
                <div class="error-message" style="display: block;">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if(session('status'))
                <div class="success-message" style="display: block;">
                    {{ session('status') }}
                </div>
            @endif

            <form id="registerForm" method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required>
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <select id="role" name="role" required style="width: 100%; padding: 15px 20px; background: rgba(255, 255, 255, 0.2); border: none; outline: none; border-radius: 35px; font-size: 16px; color: #FFFF; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); transition: all 0.3s ease;">
                        <option value="" style="background: rgba(108, 52, 40, 0.9); color: #FFFF;">Select Role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }} style="background: rgba(108, 52, 40, 0.9); color: #FFFF;">Student</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }} style="background: rgba(108, 52, 40, 0.9); color: #FFFF;">Teacher</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }} style="background: rgba(108, 52, 40, 0.9); color: #FFFF;">Admin</option>
                    </select>
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                </div>

                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your Password" required>
                </div>

                <div class="terms-check">
                    <input type="checkbox" id="terms" name="terms" required>
                    <span>I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a></span>
                </div>

                <button type="submit" class="register-btn">REGISTER</button>
            </form>

            <div class="form-footer">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');

            // Create floating bubbles
            function createBubbles() {
                const container = document.getElementById('liquidContainer');
                for (let i = 0; i < 15; i++) {
                    const bubble = document.createElement('div');
                    bubble.classList.add('liquid-bubble');

                    bubble.style.width = `${Math.random() * 100 + 50}px`;
                    bubble.style.height = bubble.style.width;
                    bubble.style.left = `${Math.random() * 100}%`;
                    bubble.style.top = `${Math.random() * 100 + 100}%`;
                    bubble.style.animationDelay = `${Math.random() * 5}s`;
                    bubble.style.animationDuration = `${Math.random() * 10 + 10}s`;
                    bubble.style.opacity = Math.random() * 0.2 + 0.1;

                    container.appendChild(bubble);
                }
            }

            // Form validation
            function validateForm() {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value.trim();
                const passwordConfirmation = document.getElementById('password_confirmation').value.trim();
                const terms = document.getElementById('terms').checked;

                // Reset error
                const errorDiv = document.querySelector('.error-message');
                if (errorDiv) errorDiv.style.display = 'none';

                // Validate fields
                if (!name) {
                    showError('Please enter your full name');
                    return false;
                }

                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showError('Please enter a valid email address');
                    return false;
                }

                if (password.length < 8) {
                    showError('Password must be at least 8 characters');
                    return false;
                }

                if (password !== passwordConfirmation) {
                    showError('Passwords do not match');
                    return false;
                }

                if (!terms) {
                    showError('You must agree to the terms and conditions');
                    return false;
                }

                return true;
            }

            function showError(message) {
                const errorDiv = document.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.textContent = message;
                    errorDiv.style.display = 'block';
                    form.style.animation = 'shake 0.5s';
                    setTimeout(() => form.style.animation = '', 500);
                }
            }

            // Form submission handler
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });

            // Initialize
            createBubbles();

            // Handle window resize
            window.addEventListener('resize', function() {
                document.querySelectorAll('.liquid-bubble').forEach(b => b.remove());
                createBubbles();
            });
        });
    </script>
</body>
</html>
