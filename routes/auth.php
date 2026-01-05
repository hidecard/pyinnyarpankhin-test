<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Guest routes (for non-logged-in users)
Route::middleware('guest')->group(function () {
    // General login page (for both admin and student)
    Route::get('login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('login', [LoginController::class, 'login'])
        ->name('login.post');
});

// Logout route (accessible to both logged-in users and students)
Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

// Authenticated routes (for logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');

    Route::post('/admin/logout', [LoginController::class, 'logout'])
        ->name('admin.logout');

    // User Management Routes
    Route::resource('admin/users', UserManagementController::class, [
        'as' => 'admin'
    ]);
});
