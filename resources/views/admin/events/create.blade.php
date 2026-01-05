@extends('admin.layout')

@section('title', 'Create Event')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Create Event</li>
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
            <i class="fas fa-calendar-plus"></i> Create Event
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Events
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Event Details</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required
                                   placeholder="Enter event title">
                        </div>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required
                                      placeholder="Enter event description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_date" class="form-label">Event Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                   id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                        </div>
                        @error('event_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_time" class="form-label">Event Time <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="time" class="form-control @error('event_time') is-invalid @enderror"
                                   id="event_time" name="event_time" value="{{ old('event_time') }}" required>
                        </div>
                        @error('event_time')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location') }}" required
                                   placeholder="Enter event location">
                        </div>
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="image" class="form-label">Event Image</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                        </div>
                        <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <i class="fas fa-eye text-success me-1"></i> Active Event
                            </label>
                        </div>
                        <small class="text-muted">Uncheck to hide this event from public view</small>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('event_date').setAttribute('min', today);
});
</script>
@endpush
@endsection
