@extends('admin.layout')

@section('title', 'Duration Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.durations.index') }}">Program Durations</a></li>
    <li class="breadcrumb-item active">Duration Details</li>
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
            <i class="fas fa-clock"></i> Duration Information
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.durations.edit', $duration) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Duration
            </a>
            <a href="{{ route('admin.durations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Durations
            </a>
        </div>
    </div>

    <!-- Duration Information -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Length</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $duration->id }}</td>
                            <td>{{ $duration->length }} year{{ $duration->length > 1 ? 's' : '' }}</td>
                            <td>{{ $duration->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $duration->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

