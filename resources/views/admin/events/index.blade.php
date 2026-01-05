@extends('admin.layout')

@section('title', 'Event Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Events</li>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="data-section">
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-calendar-alt"></i> All Events
        </h3>
        <a href="{{ route('admin.events.create') }}" class="btn-add" title="Add Event">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ Str::limit($event->title, 30) }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                        <td>{{ Str::limit($event->location, 20) }}</td>
                        <td>
                            @if($event->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.events.show', $event) }}" class="action-btn view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.events.toggle', $event) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn {{ $event->is_active ? 'warning' : 'success' }}" title="{{ $event->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i class="fas {{ $event->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $event->id }}, '{{ Str::limit($event->title, 20) }}')"
                                    title="Delete"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-calendar-alt"></i>
                                <h5>No Events Found</h5>
                                <p>Get started by adding your first event.</p>
                                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Event
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($events, 'links'))
            <div class="pagination-wrapper">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        @endif
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

                <p class="fw-semibold text-dark mb-3" id="eventTitle"></p>

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
<form id="deleteForm" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<!-- Page Script -->
<script>
let deleteModal;

document.addEventListener('DOMContentLoaded', () => {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
});

function showDeleteModal(button, eventId, eventTitle) {
    document.getElementById('eventTitle').innerText = eventTitle;
    document.getElementById('deleteForm').action = `/admin/events/${eventId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

