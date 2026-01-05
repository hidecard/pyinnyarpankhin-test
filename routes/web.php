<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\IntakeDetailController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\BookController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academics');
Route::get('/admissions', [AdmissionController::class, 'publicIndex'])->name('admissions');
Route::get('/department', [DepartmentController::class, 'publicIndex'])->name('department');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/library', function () {
    return view('library');
})->name('library');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/event', [EventController::class, 'publicIndex'])->name('event');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/certificate', [CertificateController::class, 'publicIndex'])->name('certificate');

// Student Dashboard Routes (accessible to logged-in students)
Route::middleware('student.auth')->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/books', [StudentDashboardController::class, 'books'])->name('student.books');
    Route::get('/student/books/{book}', [StudentDashboardController::class, 'showBook'])->name('student.books.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // Settings Routes
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::put('/admin/settings/{group}', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings/reset/{group?}', [SettingsController::class, 'reset'])->name('admin.settings.reset');
    Route::get('/api/settings/{key}', [SettingsController::class, 'get'])->name('api.settings.get');
    Route::post('/api/settings/{key}', [SettingsController::class, 'set'])->name('api.settings.set');
    Route::get('/admin/academic', [AdminController::class, 'academic'])->name('admin.academic');
    Route::get('/admin/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');

    // User Management Routes
    Route::resource('admin/users', UserManagementController::class, ['as' => 'admin']);

    // Role Management Routes
    Route::resource('admin/roles', RoleManagementController::class, ['as' => 'admin']);
    Route::post('admin/roles/assign', [RoleManagementController::class, 'assignRole'])->name('admin.roles.assign');
    Route::post('admin/roles/remove', [RoleManagementController::class, 'removeRole'])->name('admin.roles.remove');

    // Academic Management Routes
    Route::resource('admin/durations', DurationController::class, ['as' => 'admin']);
    Route::resource('admin/degrees', DegreeController::class, ['as' => 'admin']);
    Route::resource('admin/departments', DepartmentController::class, ['as' => 'admin']);
    Route::resource('admin/majors', MajorController::class, ['as' => 'admin']);
    Route::resource('admin/faculties', FacultyController::class, ['as' => 'admin']);
    Route::resource('admin/events', EventController::class, ['as' => 'admin']);
    Route::patch('admin/events/{event}/toggle', [EventController::class, 'toggle'])->name('admin.events.toggle');
    Route::resource('admin/admissions', AdmissionController::class, ['as' => 'admin']);
    Route::resource('admin/intake-details', IntakeDetailController::class, ['as' => 'admin']);
    Route::resource('admin/intakes', IntakeController::class, ['as' => 'admin']);
    Route::resource('admin/tuitions', TuitionController::class, ['as' => 'admin']);
    Route::resource('admin/certificates', CertificateController::class, ['as' => 'admin']);
    Route::resource('admin/subjects', SubjectController::class, ['as' => 'admin']);
    Route::resource('admin/sub-subjects', SubSubjectController::class, ['as' => 'admin']);
    Route::resource('admin/students', StudentController::class, ['as' => 'admin']);
    Route::post('admin/students/generate-password', [StudentController::class, 'generatePassword'])->name('admin.students.generate-password');

    // Books Management Routes
    Route::resource('admin/books', BookController::class, ['as' => 'admin']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Catch-all route to redirect undefined routes to home page
Route::fallback(function () {
    return redirect()->route('home');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
