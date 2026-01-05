@extends('admin.layout')

@section('title', 'Add Intake Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.intake-details.index') }}">Intake Details</a></li>
    <li class="breadcrumb-item active">Add Intake Detail</li>
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
            <i class="fas fa-calendar-alt"></i> Add Intake Detail
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.intake-details.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Details
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Intake Detail Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.intake-details.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="intake_id" class="form-label">Intake <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select @error('intake_id') is-invalid @enderror"
                                    id="intake_id" name="intake_id" required>
                                <option value="">Select Intake</option>
                                @foreach($intakes as $intake)
                                    <option value="{{ $intake->id }}" {{ old('intake_id') == $intake->id ? 'selected' : '' }}>
                                        {{ $intake->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('intake_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                                   id="event_name" name="event_name" value="{{ old('event_name') }}" required
                                   placeholder="Enter event name">
                        </div>
                        @error('event_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-play"></i></span>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                   id="start_date" name="start_date" value="{{ old('start_date') }}">
                        </div>
                        @error('start_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">When this intake detail starts</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-stop"></i></span>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date" value="{{ old('end_date') }}">
                        </div>
                        @error('end_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">When this intake detail ends</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create Detail
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
