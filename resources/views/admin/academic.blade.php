@extends('admin.layout')

@section('title', 'Academics Overview')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Academics</li>
@endsection

@php
$degreesCount = $degreesCount ?? \App\Models\Degree::count();
$majorsCount = $majorsCount ?? \App\Models\Major::count();
$departmentsCount = $departmentsCount ?? \App\Models\Department::count();
$facultiesCount = $facultiesCount ?? \App\Models\Faculty::count();
@endphp

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header fade-in">
    <h1 class="dashboard-title">
        <i class="fas fa-graduation-cap"></i> Academics Overview
    </h1>
    <p class="dashboard-subtitle">Manage academic programs, departments, and university structure</p>
</div>

<!-- Academic Statistics Section -->
<div class="data-section fade-in">
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-chart-line"></i> Academic Statistics
        </h3>
        <span class="text-muted small">
            <i class="fas fa-calendar-alt me-1"></i> Last updated: {{ now()->format('M d, Y') }}
        </span>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-icon primary">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-card-content">
                <h3>{{ number_format($degreesCount) }}</h3>
                <p>Degree Programs</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon success">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-card-content">
                <h3>{{ number_format($majorsCount) }}</h3>
                <p>Academic Majors</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon info">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-card-content">
                <h3>{{ number_format($departmentsCount) }}</h3>
                <p>Departments</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon warning">
                <i class="fas fa-university"></i>
            </div>
            <div class="stat-card-content">
                <h3>{{ number_format($facultiesCount) }}</h3>
                <p>Faculties</p>
            </div>
        </div>
    </div>
</div>

<!-- Academic Management Section -->
<div class="data-section fade-in">
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-cogs"></i> Academic Management
        </h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        <!-- Degree Management Card -->
        <div class="card" style="border: 1px solid var(--gray-200); border-radius: var(--border-radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-card-icon primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="font-size: 1.125rem; font-weight: 600; color: var(--gray-800);">Degree Programs</h5>
                        <p class="text-muted mb-0 small">Academic degree management</p>
                    </div>
                </div>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Manage all degree programs offered by the university including Bachelor's, Master's, and Doctoral programs.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.degrees.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Degree
                    </a>
                    <a href="{{ route('admin.degrees.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> View All
                    </a>
                </div>
            </div>
        </div>

        <!-- Program Duration Card -->
        <div class="card" style="border: 1px solid var(--gray-200); border-radius: var(--border-radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-card-icon success">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="font-size: 1.125rem; font-weight: 600; color: var(--gray-800);">Program Duration</h5>
                        <p class="text-muted mb-0 small">Duration configuration</p>
                    </div>
                </div>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Configure duration settings for academic programs and track completion timelines.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.durations.create') }}" class="btn btn-primary">
                        <i class="fas fa-cog"></i> Configure
                    </a>
                    <a href="{{ route('admin.durations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-chart-bar"></i> View All
                    </a>
                </div>
            </div>
        </div>

        <!-- Majors Management Card -->
        <div class="card" style="border: 1px solid var(--gray-200); border-radius: var(--border-radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-card-icon warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="font-size: 1.125rem; font-weight: 600; color: var(--gray-800);">Academic Majors</h5>
                        <p class="text-muted mb-0 small">Specializations management</p>
                    </div>
                </div>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Manage all academic majors and specializations across different degree programs.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Major
                    </a>
                    <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                        <i class="fas fa-search"></i> View All
                    </a>
                </div>
            </div>
        </div>

        <!-- Departments Management Card -->
        <div class="card" style="border: 1px solid var(--gray-200); border-radius: var(--border-radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-card-icon info">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="font-size: 1.125rem; font-weight: 600; color: var(--gray-800);">Departments</h5>
                        <p class="text-muted mb-0 small">Department administration</p>
                    </div>
                </div>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Manage academic departments, their configurations, and organizational structure.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Manage
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-users"></i> View All
                    </a>
                </div>
            </div>
        </div>

        <!-- Faculties Management Card -->
        <div class="card" style="border: 1px solid var(--gray-200); border-radius: var(--border-radius-lg);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-card-icon primary">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-1" style="font-size: 1.125rem; font-weight: 600; color: var(--gray-800);">Faculties</h5>
                        <p class="text-muted mb-0 small">Faculty organization</p>
                    </div>
                </div>
                <p class="text-muted mb-4" style="font-size: 0.875rem;">Manage university faculties and their organizational structure and hierarchy.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.faculties.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Faculty
                    </a>
                    <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sitemap"></i> View All
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

