@extends('admin.layout')

@section('title', 'Sub-Subjects')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Sub-Subjects</li>
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
            <i class="fas fa-book-open"></i> All Sub-Subjects
        </h3>
        <a href="{{ route('admin.sub-subjects.create') }}" class="btn-add" title="Add New Sub-Subject">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subSubjects as $subSubject)
                    <tr>
                        <td>{{ $subSubject->id }}</td>
                        <td>{{ $subSubject->subject->name }}</td>
                        <td>{{ $subSubject->name }}</td>
                        <td>
                            @if($subSubject->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($subSubject->status) }}</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($subSubject->remark, 30) }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.sub-subjects.show', $subSubject) }}" class="action-btn view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.sub-subjects.edit', $subSubject) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $subSubject->id }}, '{{ $subSubject->name }}')"
                                    title="Delete"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-book-open"></i>
                                <h5>No Sub-Subjects Found</h5>
                                <p>Get started by adding your first sub-subject to the system.</p>
                                <a href="{{ route('admin.sub-subjects.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Sub-Subject
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($subSubjects, 'links'))
            <div class="pagination-wrapper">
                {{ $subSubjects->links('pagination::bootstrap-5') }}
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
                    Remove Sub-Subject
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="subSubjectName"></p>

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

function showDeleteModal(button, subSubjectId, subSubjectName) {
    document.getElementById('subSubjectName').innerText = subSubjectName;
    document.getElementById('deleteForm').action = `/admin/sub-subjects/${subSubjectId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

