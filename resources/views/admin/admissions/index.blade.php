@extends('admin.layout')

@section('title', 'Admissions')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Admissions</li>
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
            <i class="fas fa-clipboard-check"></i> All Admissions
        </h3>
        <a href="{{ route('admin.admissions.create') }}" class="btn-add" title="Add Admission">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admissions as $admission)
                    <tr>
                        <td>{{ $admission->id }}</td>
                        <td>{{ $admission->admissions_name }}</td>
                        <td>{{ $admission->email }}</td>
                        <td>{{ $admission->phone }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.admissions.show', $admission) }}" class="action-btn view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.admissions.edit', $admission) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $admission->id }}, '{{ $admission->admissions_name }}')"
                                    title="Delete"
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
                                <i class="fas fa-clipboard-check"></i>
                                <h5>No Admissions Found</h5>
                                <p>Get started by adding your first admission.</p>
                                <a href="{{ route('admin.admissions.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Admission
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($admissions, 'links'))
            <div class="pagination-wrapper">
                {{ $admissions->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-clipboard-check"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Admission
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="admissionName"></p>

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

function showDeleteModal(button, admissionId, admissionName) {
    document.getElementById('admissionName').innerText = admissionName;
    document.getElementById('deleteForm').action = `/admin/admissions/${admissionId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

