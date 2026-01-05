@extends('admin.layout')

@section('title', 'Intake Detail Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.intake-details.index') }}">Intake Details</a></li>
    <li class="breadcrumb-item active">Intake Detail Details</li>
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
            <i class="fas fa-calendar-alt"></i> Intake Detail Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.intake-details.edit', $intakeDetail) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Detail
            </a>
            <a href="{{ route('admin.intake-details.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Details
            </a>
        </div>
    </div>

    <!-- Intake Detail Information -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Intake Detail Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $intakeDetail->id }}</td>
                            <td>{{ $intakeDetail->event_name }}</td>
                            <td>{{ $intakeDetail->start_date ? $intakeDetail->start_date->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $intakeDetail->end_date ? $intakeDetail->end_date->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $intakeDetail->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $intakeDetail->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    Remove Intake Detail
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="intakeDetailEvent">{{ $intakeDetail->event_name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.intake-details.destroy', $intakeDetail) }}" class="d-none">
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

