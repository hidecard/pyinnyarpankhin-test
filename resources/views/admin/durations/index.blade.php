@extends('admin.layout')

@section('title', 'Program Durations')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Program Durations</li>
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
            <i class="fas fa-clock"></i> All Program Durations
        </h3>
        <a href="{{ route('admin.durations.create') }}" class="btn-add" title="Add Duration">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Length (Years)</th>
                    <th>Created At</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($durations as $duration)
                    <tr>
                        <td>{{ $duration->id }}</td>
                        <td>{{ $duration->length }} year{{ $duration->length > 1 ? 's' : '' }}</td>
                        <td>{{ $duration->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.durations.show', $duration) }}" class="action-btn view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.durations.edit', $duration) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $duration->id }}, '{{ $duration->length }} year{{ $duration->length > 1 ? 's' : '' }}')"
                                    title="Delete"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fas fa-clock"></i>
                                <h5>No Program Durations Found</h5>
                                <p>Get started by adding your first program duration to the system.</p>
                                <a href="{{ route('admin.durations.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Duration
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($durations, 'links'))
            <div class="pagination-wrapper">
                {{ $durations->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-clock"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Duration
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="durationLength"></p>

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

function showDeleteModal(button, durationId, durationLength) {
    document.getElementById('durationLength').innerText = durationLength;
    document.getElementById('deleteForm').action = `/admin/durations/${durationId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

