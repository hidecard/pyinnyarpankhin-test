@extends('admin.layout')

@section('title', 'Add Tuition Fee')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tuitions.index') }}">Tuition Fees</a></li>
    <li class="breadcrumb-item active">Add Tuition Fee</li>
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
            <i class="fas fa-money-bill-wave"></i> Add Tuition Fee
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.tuitions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Fees
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Tuition Fee Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tuitions.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="degree_id" class="form-label">Degree <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select @error('degree_id') is-invalid @enderror"
                                    id="degree_id" name="degree_id" required>
                                <option value="">Select Degree</option>
                                @foreach($degrees as $degree)
                                    <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
                                        {{ $degree->degree_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('degree_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the degree program for this tuition fee</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="fees" class="form-label">Fees ($) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" step="0.01" class="form-control @error('fees') is-invalid @enderror"
                                   id="fees" name="fees" value="{{ old('fees') }}" required min="0"
                                   placeholder="0.00">
                        </div>
                        @error('fees')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the tuition fee amount in dollars</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-plus me-2"></i>Create Tuition Fee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
