@extends('admin.layout')

@section('title', 'Edit Duration')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.durations.index') }}">Durations</a></li>
    <li class="breadcrumb-item active">Edit Duration</li>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        Please fix the errors below.
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-clock"></i> Edit Duration
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.durations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Durations
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Duration Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.durations.update', $duration) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="length" class="form-label">Duration Length (Years) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                            <input type="number" class="form-control @error('length') is-invalid @enderror"
                                   id="length" name="length" value="{{ old('length', $duration->length) }}" min="1" max="10" required
                                   placeholder="Enter duration in years">
                        </div>
                        @error('length')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the duration in years (1-10)</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Duration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

