@extends('admin.layout')

@section('title', 'Edit Event')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Edit Event</li>
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
            <i class="fas fa-calendar"></i> Edit Event
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.events.show', $event) }}" class="btn btn-info">
                <i class="fas fa-eye me-1"></i> View Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Events
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Event Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $event->title) }}" required
                                   placeholder="Enter event title">
                        </div>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter a descriptive title for the event</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required
                                      placeholder="Describe the event">{{ old('description', $event->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Provide details about the event</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_date" class="form-label">Event Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                   id="event_date" name="event_date"
                                   value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                        </div>
                        @error('event_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the date of the event</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_time" class="form-label">Event Time <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="time" class="form-control @error('event_time') is-invalid @enderror"
                                   id="event_time" name="event_time"
                                   value="{{ old('event_time', $event->event_time) }}" required>
                        </div>
                        @error('event_time')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the time of the event</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location', $event->location) }}" required
                                   placeholder="Enter event location">
                        </div>
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter where the event will be held</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="image" class="form-label">Event Image</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                        </div>
                        <div class="form-text">
                            Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                            @if($event->image)
                                <br><small class="text-muted">Leave empty to keep current image</small>
                            @endif
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if($event->image)
                            <div class="mt-2">
                                <small class="text-muted">Current image:</small><br>
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Current event image"
                                     class="img-thumbnail mt-1" style="max-width: 200px; max-height: 150px;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Active Event</strong>
                            </label>
                        </div>
                        <small class="text-muted">Uncheck to hide this event from public view</small>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

