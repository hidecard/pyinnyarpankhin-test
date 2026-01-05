@extends('admin.layout')

@section('title', 'Intake Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.intakes.index') }}">Intakes</a></li>
    <li class="breadcrumb-item active">Intake Details</li>
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
            <i class="fas fa-calendar-alt"></i> Intake Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.intakes.edit', $intake) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Intake
            </a>
            <a href="{{ route('admin.intakes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Intakes
            </a>
        </div>
    </div>

    <!-- Intake Information -->
    <div class="card mb-4 edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><strong>ID:</strong> {{ $intake->id }}</div>
                <div class="col-md-4"><strong>Name:</strong> {{ $intake->name }}</div>
                <div class="col-md-4"><strong>Created At:</strong> {{ $intake->created_at->format('M d, Y H:i') }}</div>
            </div>
        </div>
    </div>

    <!-- Intake Details Table -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Intake Details</h5>
            <a href="{{ route('admin.intake-details.create') }}?intake_id={{ $intake->id }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add Detail
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created At</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($intake->intakeDetails as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->event_name }}</td>
                                <td>{{ $detail->start_date ? $detail->start_date->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $detail->end_date ? $detail->end_date->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $detail->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.intake-details.edit', $detail) }}" class="action-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button
                                            type="button"
                                            class="action-btn delete"
                                            onclick="showDeleteModal(this, {{ $detail->id }}, '{{ $detail->event_name }}')"
                                            title="Delete"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar"></i>
                                        <h5>No Details Found</h5>
                                        <p>No intake details found for this intake.</p>
                                        <a href="{{ route('admin.intake-details.create') }}?intake_id={{ $intake->id }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Add Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- =============================== -->
<!-- EDU STYLE DELETE MODAL (for Intake Details) -->
<!-- =============================== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content edu-modal border-0 rounded-4">

            <div class="modal-body text-center p-4">
                <div class="edu-icon mb-3">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Intake Detail
                </h5>

                <p class="text-muted mb-1">You are about to remove</p>
                <p class="fw-semibold text-dark mb-3" id="detailEvent"></p>

                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary w-50 rounded-pill" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary w-50 rounded-pill" onclick="confirmDelete()">
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

<script>
let deleteModal;

document.addEventListener('DOMContentLoaded', () => {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
});

function showDeleteModal(button, detailId, eventName) {
    document.getElementById('detailEvent').innerText = eventName;
    document.getElementById('deleteForm').action = `/admin/intake-details/${detailId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

