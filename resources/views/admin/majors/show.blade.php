@extends('admin.layout')

@section('title', 'Major Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.majors.index') }}">Majors</a></li>
    <li class="breadcrumb-item active">Major Details</li>
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
            <i class="fas fa-graduation-cap"></i> Major Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.majors.edit', $major) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Major
            </a>
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Majors
            </a>
        </div>
    </div>

    <!-- Major Information -->
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
                            <th>Major Name</th>
                            <th>Department</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $major->id }}</td>
                            <td>{{ $major->major_name }}</td>
                            <td>{{ $major->department->department_name ?? 'N/A' }}</td>
                            <td>{{ $major->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $major->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Associated Degrees -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>Associated Degrees</h5>
        </div>
        <div class="card-body p-0">
            @if($major->degrees->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Degree Name</th>
                                <th>Duration</th>
                                <th>Level</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($major->degrees as $degree)
                            <tr>
                                <td>{{ $degree->id }}</td>
                                <td>{{ $degree->degree_name }}</td>
                                <td>{{ $degree->duration->length ?? 'N/A' }} year(s)</td>
                                <td>{{ $degree->level ?? 'N/A' }}</td>
                                <td>{{ $degree->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-certificate"></i>
                    <h5>No Degrees Found</h5>
                    <p>No degrees associated with this major.</p>
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
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Major
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="majorName">{{ $major->major_name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.majors.destroy', $major) }}" class="d-none">
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

