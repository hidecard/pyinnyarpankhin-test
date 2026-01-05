@extends('admin.layout')

@section('title', 'Edit Role')

@section('content')
<div class="dashboard-header">
    <h1 class="dashboard-title">Edit Role: {{ $role->name }}</h1>
    <p class="dashboard-subtitle">Update role information and permissions</p>
</div>

<div class="form-section">
    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="form-card">
                <div class="form-group">
                    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
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
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_users" id="manage_users"
                                   {{ in_array('manage_users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="manage_users">
                                <i class="fas fa-users"></i> Manage Users
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_roles" id="manage_roles"
                                   {{ in_array('manage_roles', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="manage_roles">
                                <i class="fas fa-user-shield"></i> Manage Roles
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_content" id="manage_content"
                                   {{ in_array('manage_content', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="manage_content">
                                <i class="fas fa-file-alt"></i> Manage Content
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="view_reports" id="view_reports"
                                   {{ in_array('view_reports', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="view_reports">
                                <i class="fas fa-chart-bar"></i> View Reports
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_settings" id="manage_settings"
                                   {{ in_array('manage_settings', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="manage_settings">
                                <i class="fas fa-cog"></i> Manage Settings
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="view_students" id="view_students"
                                   {{ in_array('view_students', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
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
                <i class="fas fa-save"></i> Update Role
            </button>
        </div>
    </form>
</div>
@endsection
