@extends('admin.layout')

@section('title', 'Event Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Event Details</li>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-calendar-alt"></i> Event Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Events
            </a>
        </div>
    </div>

    <!-- Event Information -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>Basic Information
            </h5>
            <span class="badge {{ $event->is_active ? 'badge-active' : 'badge-inactive' }}">
                {{ $event->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="card-body">
            @if($event->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid rounded shadow" style="max-height: 300px;">
                </div>
            @endif

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->event_date->format('M d, Y') }}</td>
                            <td>{{ $event->event_time }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $event->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Event Description -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-align-left me-2"></i>Description</h5>
        </div>
        <div class="card-body">
            <div class="border rounded p-3 bg-light">
                {!! nl2br(e($event->description)) !!}
            </div>
        </div>
    </div>

    <!-- Event Status -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Event Status</h5>
        </div>
        <div class="card-body">
            @php
                $now = now();
                $eventDateTime = $event->event_date->copy()->setTimeFromTimeString($event->event_time);
                $daysUntil = ceil($now->diffInDays($eventDateTime, false));
            @endphp

            @if($eventDateTime->isPast())
                <div class="alert alert-secondary">
                    <i class="fas fa-history me-2"></i>
                    <strong>Event Completed</strong> - This event has already taken place.
                </div>
            @elseif($daysUntil <= 0)
                <div class="alert alert-success">
                    <i class="fas fa-calendar-day me-2"></i>
                    <strong>Today!</strong> - This event is happening today.
                </div>
            @elseif($daysUntil == 1)
                <div class="alert alert-warning">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <strong>Tomorrow</strong> - Event is scheduled for tomorrow.
                </div>
            @elseif($daysUntil <= 7)
                <div class="alert alert-info">
                    <i class="fas fa-calendar-week me-2"></i>
                    <strong>Coming Soon</strong> - Event is in {{ $daysUntil }} days.
                </div>
            @else
                <div class="alert alert-light">
                    <i class="fas fa-calendar-check me-2"></i>
                    <strong>Upcoming</strong> - Event is in {{ $daysUntil }} days.
                </div>
            @endif

            @if(!$event->is_active)
                <div class="alert alert-danger mt-2">
                    <i class="fas fa-eye-slash me-2"></i>
                    <strong>Inactive Event</strong> - This event is currently hidden from public view.
                </div>
            @endif
        </div>
    </div>
</div>

<!-- =============================== -->
<!-- EDU STYLE DELETE MODAL -->
<!-- =============================== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content edu-modal border-0 rounded-4">

            <div class="modal-body text-center p-4">
                <div class="edu-icon mb-3">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Event
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="eventTitle">{{ $event->title }}</p>

                <div class="d-flex gap-2 justify-content-center">
                    <button
                        type="button"
                        class="btn btn-outline-secondary w-50 rounded-pill"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="button"
                        class="btn btn-primary w-50 rounded-pill"
                        onclick="confirmDelete()"
                    >
                        Remove
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteForm" method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-none">
    @csrf
    @method('DELETE')
</form>

<!-- Page Script -->
<script>
let deleteModal;

document.addEventListener('DOMContentLoaded', () => {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
});

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

