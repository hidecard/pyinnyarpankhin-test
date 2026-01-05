@extends('admin.layout')

@section('title', 'Degree Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.degrees.index') }}">Degrees</a></li>
    <li class="breadcrumb-item active">Degree Details</li>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-graduation-cap"></i> Degree Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.degrees.edit', $degree) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Degree
            </a>
            <a href="{{ route('admin.degrees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Degrees
            </a>
        </div>
    </div>

    <!-- Degree Information Card -->
    <div class="card mb-4 edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><strong>ID:</strong> {{ $degree->id }}</div>
                <div class="col-md-4"><strong>Degree Name:</strong> {{ $degree->degree_name }}</div>
                <div class="col-md-4"><strong>Level:</strong> {{ ucfirst($degree->level) }}</div>
                <div class="col-md-4"><strong>Duration:</strong> {{ $degree->duration->length }} year{{ $degree->duration->length > 1 ? 's' : '' }}</div>
                <div class="col-md-4"><strong>Department:</strong> {{ $degree->department ? $degree->department->department_name : '-' }}</div>
                <div class="col-md-4"><strong>Created At:</strong> {{ $degree->created_at->format('M d, Y H:i') }}</div>
                <div class="col-md-4"><strong>Updated At:</strong> {{ $degree->updated_at->format('M d, Y H:i') }}</div>
            </div>
        </div>
    </div>
</div>

@endsection

