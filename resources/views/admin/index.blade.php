@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@php
// Ensure all variables are defined with default values
$stats = $stats ?? [
    'students' => \App\Models\Student::count(),
    'faculty' => \App\Models\Faculty::count(),
    'subjects' => \App\Models\Subject::count(),
    'departments' => \App\Models\Department::count(),
];
$recentSubjects = $recentSubjects ?? \App\Models\Subject::latest()->take(5)->get();
$recentAdmissions = $recentAdmissions ?? \App\Models\Admission::latest()->take(3)->get();
$recentEvents = $recentEvents ?? \App\Models\Event::where('is_active', true)->latest()->take(2)->get();
$recentStudents = $recentStudents ?? \App\Models\Student::latest()->take(3)->get();
@endphp

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header fade-in">
    <h1 class="dashboard-title">
        <i class="fas fa-tachometer-alt"></i> Dashboard Overview
    </h1>
    <p class="dashboard-subtitle">Welcome back! Here's what's happening with your university management system today.</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid fade-in">
    <div class="stat-card">
        <div class="stat-card-icon primary">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="stat-card-content">
            <h3>{{ number_format($stats['students']) }}</h3>
            <p>Total Students</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon success">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="stat-card-content">
            <h3>{{ number_format($stats['faculty']) }}</h3>
            <p>Active Faculty</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon warning">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="stat-card-content">
            <h3>{{ number_format($stats['subjects']) }}</h3>
            <p>Subjects Offered</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon info">
            <i class="fas fa-building"></i>
        </div>
        <div class="stat-card-content">
            <h3>{{ number_format($stats['departments']) }}</h3>
            <p>Departments</p>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="charts-section fade-in">
    <div class="chart-container">
        <div class="chart-header">
            <h3>Enrollment Trends</h3>
            <select class="chart-select">
                <option>Last 6 Months</option>
                <option>This Year</option>
                <option>Last Year</option>
            </select>
        </div>
        <canvas id="enrollmentChart"></canvas>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <h3>Department Distribution</h3>
        </div>
        <canvas id="departmentChart"></canvas>
    </div>
</div>

<!-- Recent Activity and Course Management -->
<div class="dashboard-content-grid fade-in">
    <div class="data-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-book"></i> Recent Subjects
            </h3>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> View All
            </a>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject Name</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSubjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            @if($subject->status == 'active')
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-secondary">{{ $subject->status }}</span>
                            @endif
                        </td>
                        <td>{{ $subject->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No subjects found. Add your first subject to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="activity-section">
        <div class="activity-header">
            <h3 class="activity-title">
                <i class="fas fa-history"></i> Recent Activity
            </h3>
        </div>
        <ul class="activity-list">
            @forelse($recentAdmissions as $admission)
            <li class="activity-item">
                <div class="activity-icon primary">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="activity-content">
                    <p>New admission: {{ $admission->student_name ?? 'Unknown Student' }}</p>
                    <small class="activity-time">{{ $admission->created_at->diffForHumans() }}</small>
                </div>
            </li>
            @empty
            @endforelse

            @forelse($recentEvents as $event)
            <li class="activity-item">
                <div class="activity-icon warning">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="activity-content">
                    <p>Event: {{ $event->title }}</p>
                    <small class="activity-time">{{ $event->created_at->diffForHumans() }}</small>
                </div>
            </li>
            @empty
            @endforelse

            @forelse($recentStudents as $student)
            <li class="activity-item">
                <div class="activity-icon info">
                    <i class="fas fa-user"></i>
                </div>
                <div class="activity-content">
                    <p>Student registered: {{ $student->student_name ?? $student->name ?? 'Unknown' }}</p>
                    <small class="activity-time">{{ $student->created_at->diffForHumans() }}</small>
                </div>
            </li>
            @empty
            @endforelse

            @if($recentAdmissions->isEmpty() && $recentEvents->isEmpty() && $recentStudents->isEmpty())
            <li class="activity-item">
                <div class="activity-icon primary">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="activity-content">
                    <p>No recent activity</p>
                    <small class="activity-time">Get started by adding data</small>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enrollment Chart
        const enrollmentCtx = document.getElementById('enrollmentChart');
        if (enrollmentCtx) {
            new Chart(enrollmentCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Students',
                        data: [120, 190, 170, 220, 180, 250],
                        borderColor: '#FF7300',
                        backgroundColor: 'rgba(255, 115, 0, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // Department Chart
        const departmentCtx = document.getElementById('departmentChart');
        if (departmentCtx) {
            new Chart(departmentCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Computer Science', 'Mathematics', 'Physics', 'English', 'Biology', 'Chemistry'],
                    datasets: [{
                        data: [350, 280, 200, 180, 150, 120],
                        backgroundColor: ['#FF7300', '#10b981', '#f59e0b', '#3b82f6', '#8b5cf6', '#ec4899'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'right' } }
                }
            });
        }
    });
</script>
@endsection

