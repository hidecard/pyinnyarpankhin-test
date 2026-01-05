@extends('admin.layout')

@section('title', 'Add Faculty')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.faculties.index') }}">Faculties</a></li>
    <li class="breadcrumb-item active">Add Faculty</li>
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
            <i class="fas fa-user-plus"></i> Add Faculty
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Faculties
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Faculty Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.faculties.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="faculty_name" class="form-label">Faculty Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('faculty_name') is-invalid @enderror"
                                   id="faculty_name" name="faculty_name" value="{{ old('faculty_name') }}" required
                                   placeholder="Enter full name">
                        </div>
                        @error('faculty_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the faculty member</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                   id="position" name="position" value="{{ old('position') }}" required
                                   placeholder="Enter position/title">
                        </div>
                        @error('position')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the position/title of the faculty member</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <select class="form-select @error('department_id') is-invalid @enderror"
                                    id="department_id" name="department_id" required>
                                <option value="">Select a department</option>
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
                            <small class="text-muted">Select the department this faculty member belongs to</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-plus me-2"></i>Create Faculty
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
