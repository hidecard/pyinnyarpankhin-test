@extends('admin.layout')

@section('title', 'Admission Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admissions.index') }}">Admissions</a></li>
    <li class="breadcrumb-item active">Admission Details</li>
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
            <i class="fas fa-user-graduate"></i> Admission Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.admissions.edit', $admission) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Admission
            </a>
            <a href="{{ route('admin.admissions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Admissions
            </a>
        </div>
    </div>

    <!-- Applicant Information -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Applicant Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Minimum GPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $admission->id }}</td>
                            <td>{{ $admission->admissions_name }}</td>
                            <td>{{ $admission->email }}</td>
                            <td>{{ $admission->phone }}</td>
                            <td>{{ $admission->department->department_name ?? 'N/A' }}</td>
                            <td>{{ $admission->minimum_gpa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Application Details -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Application Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Transcripts</th>
                            <th>Recommendation</th>
                            <th>Educational Degree</th>
                            <th>Statement of Purpose</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $admission->transcripts }}</td>
                            <td>{{ $admission->recommendation }}</td>
                            <td>{{ $admission->edu_degree }}</td>
                            <td>{{ $admission->sop }}</td>
                            <td>{{ $admission->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $admission->updated_at->format('M d, Y H:i') }}</td>
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
                    <i class="fas fa-user-graduate"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Admission
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="admissionName">{{ $admission->admissions_name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.admissions.destroy', $admission) }}" class="d-none">
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

