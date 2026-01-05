@extends('admin.layout')

@section('title', 'Create Role')

@section('content')
<div class="dashboard-header">
    <h1 class="dashboard-title">Create New Role</h1>
    <p class="dashboard-subtitle">Add a new role to the system</p>
</div>

<div class="form-section">
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-card">
                <div class="form-group">
                    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-card">
                <div class="form-group">
                    <label class="form-label">Permissions</label>
                    <div class="checkbox-grid">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_users" id="manage_users">
                            <label class="form-check-label" for="manage_users">
                                <i class="fas fa-users"></i> Manage Users
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_roles" id="manage_roles">
                            <label class="form-check-label" for="manage_roles">
                                <i class="fas fa-user-shield"></i> Manage Roles
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_content" id="manage_content">
                            <label class="form-check-label" for="manage_content">
                                <i class="fas fa-file-alt"></i> Manage Content
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="view_reports" id="view_reports">
                            <label class="form-check-label" for="view_reports">
                                <i class="fas fa-chart-bar"></i> View Reports
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_settings" id="manage_settings">
                            <label class="form-check-label" for="manage_settings">
                                <i class="fas fa-cog"></i> Manage Settings
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="view_students" id="view_students">
                            <label class="form-check-label" for="view_students">
                                <i class="fas fa-user-graduate"></i> View Students
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Role
            </button>
        </div>
    </form>
</div>
@endsection
