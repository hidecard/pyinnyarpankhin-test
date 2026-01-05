@extends('admin.layout')

@section('title', 'Add Degree')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.degrees.index') }}">Degrees</a></li>
    <li class="breadcrumb-item active">Add Degree</li>
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
            <i class="fas fa-graduation-cap"></i> Add Degree
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.degrees.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Degrees
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Degree Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.degrees.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="degree_name" class="form-label">Degree Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                            <input type="text" class="form-control @error('degree_name') is-invalid @enderror"
                                   id="degree_name" name="degree_name" value="{{ old('degree_name') }}" required
                                   placeholder="Enter degree name">
                        </div>
                        @error('degree_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the degree (e.g., Bachelor of Science in Computer Science)</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="level" class="form-label">Level <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                            <select class="form-select @error('level') is-invalid @enderror"
                                    id="level" name="level" required>
                                <option value="">Select Level</option>
                                <option value="postgraduate" {{ old('level') == 'postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                                <option value="undergraduate" {{ old('level') == 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                <option value="masters" {{ old('level') == 'masters' ? 'selected' : '' }}>Masters</option>
                                <option value="doctoral" {{ old('level') == 'doctoral' ? 'selected' : '' }}>Doctoral</option>
                            </select>
                        </div>
                        @error('level')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the academic level for this degree program</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="duration_id" class="form-label">Duration <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <select class="form-select @error('duration_id') is-invalid @enderror"
                                    id="duration_id" name="duration_id" required>
                                <option value="">Select Duration</option>
                                @foreach($durations as $duration)
                                    <option value="{{ $duration->id }}" {{ old('duration_id') == $duration->id ? 'selected' : '' }}>
                                        {{ $duration->length }} years
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('duration_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the duration for this degree program</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="department_id" class="form-label">Department</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <select class="form-select @error('department_id') is-invalid @enderror"
                                    id="department_id" name="department_id">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('department_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the department for this degree (optional)</small>
                        @enderror
                    </div>



                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-plus me-2"></i>Create Degree
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
