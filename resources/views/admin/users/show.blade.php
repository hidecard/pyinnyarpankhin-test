@extends('admin.layout')

@section('title', 'User Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">User Details</li>
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
            <i class="fas fa-user"></i> User Details
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Users
            </a>
        </div>
    </div>

    <!-- User Information -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Email Verified</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-user">User</span>
                                @endif
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge badge-active">Verified</span>
                                @else
                                    <span class="badge badge-pending">Not Verified</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
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
@if($user->id !== auth()->id())
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content edu-modal border-0 rounded-4">

            <div class="modal-body text-center p-4">
                <div class="edu-icon mb-3">
                    <i class="fas fa-user"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove User
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="userName">{{ $user->name }}</p>

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
<form id="deleteForm" method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
let deleteModal;

document.addEventListener('DOMContentLoaded', () => {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
});

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>
@endif

@endsection

