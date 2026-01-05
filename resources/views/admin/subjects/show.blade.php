@extends('admin.layout')

@section('title', 'Subject Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">Subjects</a></li>
    <li class="breadcrumb-item active">Subject Details</li>
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
            <i class="fas fa-book"></i> Subject Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Subject
            </a>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Subjects
            </a>
        </div>
    </div>

    <!-- Subject Information -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Subject Information</h5>
            <span class="badge badge-{{ $subject->status == 'active' ? 'success' : 'secondary' }}">
                {{ ucfirst($subject->status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Remark</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->remark }}</td>
                            <td>{{ $subject->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $subject->updated_at->format('M d, Y H:i') }}</td>
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
                    <i class="fas fa-book"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Subject
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="subjectName">{{ $subject->name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" class="d-none">
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

