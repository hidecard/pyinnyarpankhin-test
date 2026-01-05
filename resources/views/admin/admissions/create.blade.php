@extends('admin.layout')

@section('title', 'Create Admission')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admissions.index') }}">Admissions</a></li>
    <li class="breadcrumb-item active">Create Admission</li>
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
            <i class="fas fa-user-plus"></i> Create Admission
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.admissions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Admissions
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Admission Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.admissions.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="admissions_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('admissions_name') is-invalid @enderror"
                                   id="admissions_name" name="admissions_name" value="{{ old('admissions_name') }}" required
                                   placeholder="Enter full name">
                        </div>
                        @error('admissions_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="Enter email address">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone') }}" required
                                   placeholder="Enter phone number">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <select class="form-select @error('department_id') is-invalid @enderror"
                                    id="department_id" name="department_id" required>
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
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="minimum_gpa" class="form-label">Minimum GPA <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="number" class="form-control @error('minimum_gpa') is-invalid @enderror"
                                   id="minimum_gpa" name="minimum_gpa" value="{{ old('minimum_gpa') }}" required
                                   step="0.01" placeholder="Enter minimum GPA">
                        </div>
                        @error('minimum_gpa')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="transcripts" class="form-label">Transcripts Score <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                            <input type="text" class="form-control @error('transcripts') is-invalid @enderror"
                                   id="transcripts" name="transcripts" value="{{ old('transcripts') }}" required
                                   placeholder="Enter transcripts score">
                        </div>
                        @error('transcripts')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="recommendation" class="form-label">Recommendation Score <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-thumbs-up"></i></span>
                            <input type="number" class="form-control @error('recommendation') is-invalid @enderror"
                                   id="recommendation" name="recommendation" value="{{ old('recommendation') }}" required
                                   placeholder="Enter recommendation score">
                        </div>
                        @error('recommendation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="edu_degree" class="form-label">Educational Degree <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                            <input type="text" class="form-control @error('edu_degree') is-invalid @enderror"
                                   id="edu_degree" name="edu_degree" value="{{ old('edu_degree') }}" required
                                   placeholder="Enter educational degree">
                        </div>
                        @error('edu_degree')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="sop" class="form-label">Statement of Purpose Score <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                            <input type="number" class="form-control @error('sop') is-invalid @enderror"
                                   id="sop" name="sop" value="{{ old('sop') }}" required
                                   placeholder="Enter SOP score">
                        </div>
                        @error('sop')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create Admission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
