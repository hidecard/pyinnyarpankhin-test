
@extends('admin.layout')

@section('title', 'Create User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">Create User</li>
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
            <i class="fas fa-user-plus"></i> Create User
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Users
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>User Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required
                                   placeholder="Enter full name">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="Enter email address">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required
                                   placeholder="Enter password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Password must be at least 8 characters</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" required
                                   placeholder="Confirm password">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option value="">Select Role</option>
                                @foreach(\App\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Assign a role to this user</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
