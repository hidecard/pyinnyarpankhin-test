@extends('admin.layout')

@section('title', 'Role Management')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="data-section">
    <div class="section-header">
        <h3 class="section-title">All Roles</h3>
        <a href="{{ route('admin.roles.create') }}" class="btn-icon add" title="Add Role">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Users Count</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>
                            <span class="badge badge-{{ $role->name }}">
                                {{ ucfirst($role->name) }}
                            </span>
                        </td>
                        <td>{{ $role->description ?? 'N/A' }}</td>
                        <td>{{ $role->users->count() }}</td>
                        <td>{{ $role->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.roles.show', $role) }}" class="action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.roles.edit', $role) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(!in_array($role->name, ['admin', 'teacher', 'student']))
                                    <button
                                        type="button"
                                        class="action-btn delete"
                                        onclick="showDeleteModal(this, {{ $role->id }}, '{{ $role->name }}')"
                                        title="Delete"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No roles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($roles->hasPages())
            <div class="pagination-wrapper">
                {{ $roles->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-user-shield"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Role
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="roleName"></p>

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

function showDeleteModal(button, roleId, roleName) {
    document.getElementById('roleName').innerText = roleName;
    document.getElementById('deleteForm').action = `/admin/roles/${roleId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

