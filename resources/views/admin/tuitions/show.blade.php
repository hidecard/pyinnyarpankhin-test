@extends('admin.layout')

@section('title', 'Tuition Fee Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.tuitions.index') }}">Tuition Fees</a></li>
    <li class="breadcrumb-item active">Tuition Fee Details</li>
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
            <i class="fas fa-money-bill-wave"></i> Tuition Fee Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.tuitions.edit', $tuition) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Tuition
            </a>
            <a href="{{ route('admin.tuitions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Tuitions
            </a>
        </div>
    </div>

    <!-- Tuition Information -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tuition Fee Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Degree</th>
                            <th>Fees</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $tuition->id }}</td>
                            <td>{{ $tuition->degree->degree_name }}</td>
                            <td>${{ number_format($tuition->fees, 2) }}</td>
                            <td>{{ $tuition->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $tuition->updated_at->format('M d, Y H:i') }}</td>
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
                    <i class="fas fa-money-bill-wave"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Tuition Fee
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="tuitionDegree">{{ $tuition->degree->degree_name }} - ${{ number_format($tuition->fees, 2) }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.tuitions.destroy', $tuition) }}" class="d-none">
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

