@extends('admin.layout')

@section('title', 'Tuition Management')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="data-section">
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-money-bill-wave"></i> All Tuition Records
        </h3>
        <a href="{{ route('admin.tuitions.create') }}" class="btn-add" title="Add Tuition">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Degree</th>
                    <th>Fee</th>
                    <th>Created At</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tuitions as $tuition)
                    <tr>
                        <td>{{ $tuition->id }}</td>
                        <td>{{ $tuition->degree->degree_name }}</td>
                        <td>${{ number_format($tuition->fees, 2) }}</td>
                        <td>{{ $tuition->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.tuitions.show', $tuition) }}" class="action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.tuitions.edit', $tuition) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $tuition->id }}, '{{ $tuition->degree->degree_name }}')"
                                    title="Delete"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tuition records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($tuitions->hasPages())
            <div class="pagination-wrapper">
                {{ $tuitions->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-money-bill-wave"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Tuition
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="tuitionDegree"></p>

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

function showDeleteModal(button, tuitionId, degreeName) {
    document.getElementById('tuitionDegree').innerText = degreeName;
    document.getElementById('deleteForm').action = `/admin/tuitions/${tuitionId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

