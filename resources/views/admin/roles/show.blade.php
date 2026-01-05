@extends('admin.layout')

@section('title', 'Role Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Role Details</li>
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
            <i class="fas fa-user-shield"></i> Role Details: {{ $role->name }}
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Role
            </a>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Roles
            </a>
        </div>
    </div>

    <!-- Role Information Card -->
    <div class="card mb-4 edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><strong>ID:</strong> {{ $role->id }}</div>
                <div class="col-md-4"><strong>Name:</strong> {{ $role->name }}</div>
                <div class="col-md-4"><strong>Description:</strong> {{ $role->description ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>Created At:</strong> {{ $role->created_at->format('M d, Y H:i') }}</div>
                <div class="col-md-4"><strong>Updated At:</strong> {{ $role->updated_at->format('M d, Y H:i') }}</div>
            </div>
        </div>
    </div>

    <!-- Permissions Card -->
    <div class="card mb-4 edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Permissions</h5>
        </div>
        <div class="card-body">
            @if($role->permissions && count($role->permissions) > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role->permissions as $permission)
                                <tr>
                                    <td>{{ ucwords(str_replace('_', ' ', $permission)) }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-shield-alt text-muted"></i>
                    <h5>No Permissions Assigned</h5>
                    <p>This role has no permissions assigned to it.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Users with this Role Card -->
    <div class="card mb-4 edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Users with this Role ({{ $role->users->count() }})
            </h5>
        </div>
        <div class="card-body">
            @if($role->users->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role->users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.show', $user) }}" class="action-btn view" title="View User">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-users text-muted"></i>
                    <h5>No Users Assigned</h5>
                    <p>No users are assigned to this role.</p>
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
                    <i class="fas fa-user-shield"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Role
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="roleName">{{ $role->name }}</p>

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

