@extends('admin.layout')

@section('title', 'Edit Sub-Subject')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.sub-subjects.index') }}">Sub-Subjects</a></li>
    <li class="breadcrumb-item active">Edit Sub-Subject</li>
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
            <i class="fas fa-book"></i> Edit Sub-Subject
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.sub-subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Sub-Subjects
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Sub-Subject Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sub-subjects.update', $subSubject) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="sub_id" class="form-label">Subject <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                            <select class="form-select @error('sub_id') is-invalid @enderror"
                                    id="sub_id" name="sub_id" required>
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('sub_id', $subSubject->sub_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('sub_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the parent subject</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Sub-Subject Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $subSubject->name) }}" required
                                   placeholder="Enter sub-subject name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the sub-subject</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="active" {{ old('status', $subSubject->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $subSubject->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the status</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="remark" class="form-label">Remark</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('remark') is-invalid @enderror"
                                      id="remark" name="remark" rows="3"
                                      placeholder="Add a remark (optional)">{{ old('remark', $subSubject->remark) }}</textarea>
                        </div>
                        @error('remark')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Add any additional notes about this sub-subject (optional)</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Sub-Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
