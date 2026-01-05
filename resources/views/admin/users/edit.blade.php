@extends('admin.layout')

@section('title', 'Edit User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        Please fix the errors below.
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-user-edit"></i> Edit User
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Users
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>User Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   placeholder="Enter full name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the user's full name</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   placeholder="Enter email address">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Enter the user's email address</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">New Password <span class="text-muted">(leave blank to keep current)</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Enter new password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Leave blank to keep the current password</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Confirm new password">
                        </div>
                        <small class="text-muted">Re-enter the new password</small>
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option value="">Select Role</option>
                                @foreach(\App\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}" {{ old('role', $user->roles->first()->name ?? '') === $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Select the user's role</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

