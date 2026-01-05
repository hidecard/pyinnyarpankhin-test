@extends('admin.layout')

@section('title', 'Degrees')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Degrees</li>
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
            <i class="fas fa-graduation-cap"></i> All Degrees
        </h3>
        <a href="{{ route('admin.degrees.create') }}" class="btn-add" title="Add Degree">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Degree Name</th>
                    <th>Level</th>
                    <th>Department</th>
                    <th>Created At</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($degrees as $degree)
                    <tr>
                        <td>{{ $degree->id }}</td>
                        <td>{{ $degree->degree_name }}</td>
                        <td>{{ ucfirst($degree->level) }}</td>
                        <td>{{ $degree->department ? $degree->department->department_name : '-' }}</td>
                        <td>{{ $degree->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.degrees.show', $degree) }}" class="action-btn view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.degrees.edit', $degree) }}" class="action-btn edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $degree->id }})"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-graduation-cap"></i>
                                <h5>No Degrees Found</h5>
                                <p>Add your first degree to start managing courses.</p>
                                <a href="{{ route('admin.degrees.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Degree
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(method_exists($degrees, 'links'))
            <div class="pagination-wrapper">
                {{ $degrees->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-book-open"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Degree
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="degreeName"></p>


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

function showDeleteModal(button, degreeId) {
    const row = button.closest('tr');
    const degreeName = row.cells[1].innerText;

    document.getElementById('degreeName').innerText = degreeName;
    document.getElementById('deleteForm').action = `/admin/degrees/${degreeId}`;

    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection
