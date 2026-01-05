@extends('admin.layout')

@section('title', 'Edit Subject')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">Subjects</a></li>
    <li class="breadcrumb-item active">Edit Subject</li>
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
            <i class="fas fa-book-open"></i> Edit Subject
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Subjects
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Subject Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Subject Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $subject->name) }}" required
                                   placeholder="Enter subject name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the subject</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="active" {{ old('status', $subject->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $subject->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the subject status</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="remark" class="form-label">Remark</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('remark') is-invalid @enderror"
                                      id="remark" name="remark" rows="3"
                                      placeholder="Add a remark (optional)">{{ old('remark', $subject->remark) }}</textarea>
                        </div>
                        @error('remark')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Add any additional notes about this subject (optional)</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
