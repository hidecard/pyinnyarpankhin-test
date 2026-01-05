@extends('admin.layout')

@section('title', 'Edit Major')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.majors.index') }}">Majors</a></li>
    <li class="breadcrumb-item active">Edit Major</li>
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
            <i class="fas fa-book"></i> Edit Major
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Majors
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Major Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.majors.update', $major) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="major_name" class="form-label">Major Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="text" class="form-control @error('major_name') is-invalid @enderror"
                                   id="major_name" name="major_name" value="{{ old('major_name', $major->major_name) }}" required
                                   placeholder="Enter major name">
                        </div>
                        @error('major_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the full name of the major</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="degree_id" class="form-label">Degree <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                            <select class="form-select @error('degree_id') is-invalid @enderror"
                                    id="degree_id" name="degree_id" required>
                                <option value="">Select a degree</option>
                                @foreach($degrees as $degree)
                                    <option value="{{ $degree->id }}" {{ old('degree_id', $major->degrees->first()?->id) == $degree->id ? 'selected' : '' }}>
                                        {{ $degree->degree_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('degree_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the degree this major belongs to</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Major
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
