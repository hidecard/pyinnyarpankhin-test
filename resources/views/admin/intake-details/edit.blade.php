@extends('admin.layout')

@section('title', 'Edit Intake Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.intake-details.index') }}">Intake Details</a></li>
    <li class="breadcrumb-item active">Edit Intake Detail</li>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        Please fix the errors below.
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-calendar-alt"></i> Edit Intake Detail
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.intake-details.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Intake Details
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Intake Detail Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.intake-details.update', $detail) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="intake_id" class="form-label">Intake <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select @error('intake_id') is-invalid @enderror"
                                    id="intake_id" name="intake_id" required>
                                <option value="">Select Intake</option>
                                @foreach(\App\Models\Intake::all() as $intake)
                                    <option value="{{ $intake->id }}" {{ old('intake_id', $detail->intake_id) == $intake->id ? 'selected' : '' }}>
                                        {{ $intake->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('intake_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the intake period</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-flag"></i></span>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                                   id="event_name" name="event_name" value="{{ old('event_name', $detail->event_name) }}" required
                                   placeholder="Enter event name">
                        </div>
                        @error('event_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the name of the event</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                   id="start_date" name="start_date"
                                   value="{{ old('start_date', $detail->start_date ? $detail->start_date->format('Y-m-d') : '') }}">
                        </div>
                        @error('start_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the start date</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date"
                                   value="{{ old('end_date', $detail->end_date ? $detail->end_date->format('Y-m-d') : '') }}">
                        </div>
                        @error('end_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the end date</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Intake Detail
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

