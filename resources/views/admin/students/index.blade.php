@extends('admin.layout')

@section('title', 'Students')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Students</li>
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
            <i class="fas fa-user-graduate"></i> All Students
        </h3>
        <a href="{{ route('admin.students.create') }}" class="btn-add" title="Add Student">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Father Name</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" style="width: 36px; height: 36px; object-fit: cover; border-radius: 50%;">
                            @else
                                <div style="width: 36px; height: 36px; background-color: var(--gray-100); display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-user" style="color: var(--gray-400);"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->email_address }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>
                            @if($student->status == 'active')
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td class="d-none d-md-table-cell">{{ $student->father_name }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.students.show', $student->id) }}" class="action-btn view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.students.edit', $student->id) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this student?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-user-graduate"></i>
                                <h5>No Students Found</h5>
                                <p>Get started by adding your first student.</p>
                                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Student
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($students, 'links'))
            <div class="pagination-wrapper">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection

