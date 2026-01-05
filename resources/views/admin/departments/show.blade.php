@extends('admin.layout')

@section('title', 'Department Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments</a></li>
    <li class="breadcrumb-item active">Department Details</li>
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
            <i class="fas fa-building"></i> Department Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Department
            </a>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Departments
            </a>
        </div>
    </div>

    <!-- Department Information -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>Total Majors</th>
                            <th>Total Faculties</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->department_name }}</td>
                            <td>{{ $department->majors->count() }}</td>
                            <td>{{ $department->faculties->count() }}</td>
                            <td>{{ $department->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $department->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Associated Majors -->
    <div class="card edu-card mb-4">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Associated Majors</h5>
        </div>
        <div class="card-body p-0">
            @if($department->majors->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Major Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($department->majors as $major)
                            <tr>
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->major_name }}</td>
                                <td>{{ $major->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-graduation-cap"></i>
                    <h5>No Majors Found</h5>
                    <p>No majors associated with this department.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Associated Faculties -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Associated Faculties</h5>
        </div>
        <div class="card-body p-0">
            @if($department->faculties->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Faculty Name</th>
                                <th>Position</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($department->faculties as $faculty)
                            <tr>
                                <td>{{ $faculty->id }}</td>
                                <td>{{ $faculty->faculty_name }}</td>
                                <td>{{ $faculty->position }}</td>
                                <td>{{ $faculty->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h5>No Faculties Found</h5>
                    <p>No faculties associated with this department.</p>
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
                    <i class="fas fa-building"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Department
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="departmentName">{{ $department->department_name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.departments.destroy', $department) }}" class="d-none">
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

