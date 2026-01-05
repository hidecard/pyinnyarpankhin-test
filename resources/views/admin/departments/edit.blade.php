@extends('admin.layout')

@section('title', 'Edit Department')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments</a></li>
    <li class="breadcrumb-item active">Edit Department</li>
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
            <i class="fas fa-building"></i> Edit Department
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Departments
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Department Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                            <input type="text" class="form-control @error('department_name') is-invalid @enderror"
                                   id="department_name" name="department_name" value="{{ old('department_name', $department->department_name) }}" required
                                   placeholder="Enter department name">
                        </div>
                        @error('department_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the department</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4"
                                      placeholder="Provide a brief description">{{ old('description', $department->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Provide a brief description of the department (optional)</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
