<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $role = $request->input('role');

        if ($role === 'admin') {
            // Admin authentication using email
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $request->session()->regenerate();

                // Check if user has admin role
                if ($user->hasRole('admin') || $user->role === 'admin') {
                    return redirect()->intended(route('admin'));
                } else {
                    Auth::logout();
                    throw ValidationException::withMessages([
                        'email' => 'You do not have admin privileges.',
                    ]);
                }
            }

            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);

        } elseif ($role === 'student') {
            // Student authentication using direct database lookup
            $request->validate([
                'username' => 'required|string',
                'password' => 'required',
            ]);

            $username = $request->input('username');
            $password = $request->input('password');

            // Find student by username
            $student = \App\Models\Student::where('username', $username)->first();

            // Verify password (plain text comparison)
            if ($student && $student->password === $password) {
                // Check if student is active
                if ($student->status === 'active') {
                    // Create session for student
                    $request->session()->put('student_id', $student->id);
                    $request->session()->put('student_username', $student->username);
                    $request->session()->put('student_name', $student->student_name);
                    $request->session()->regenerate();

                    return redirect()->intended(route('student.dashboard'));
                } else {
                    throw ValidationException::withMessages([
                        'username' => 'Your account is inactive. Please contact administrator.',
                    ]);
                }
            }

            throw ValidationException::withMessages([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }

        throw ValidationException::withMessages([
            'role' => 'Invalid role selected.',
        ]);
    }

    public function logout(Request $request)
    {
        // Clear student session data if student is logged in
        if (session('student_id')) {
            $request->session()->forget(['student_id', 'student_username', 'student_name']);
        }

        // Clear admin session data if admin is logged in
        if (Auth::check()) {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
