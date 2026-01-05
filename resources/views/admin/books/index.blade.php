@extends('admin.layout')

@section('title', 'Library Management')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="data-section">
    <div class="section-header">
        <h3 class="section-title">All Books</h3>
        <a href="{{ route('admin.books.create') }}" class="btn-icon add" title="Add Book">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>File</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>
                            @if($book->cover_image_path)
                                <img style="width: 50px; height: auto;" src="{{ asset('storage/' . $book->cover_image_path) }}"
                                     alt="Cover" class="img-thumbnail">
                            @else
                                <div class="bg-secondary text-white text-center d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 50px; border-radius: 4px;">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ Str::limit($book->title, 25) }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @if($book->file_path)
                                <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="action-btn edit" title="View File">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            @else
                                <span class="text-muted"><i class="fas fa-times"></i></span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.books.show', $book) }}" class="action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.books.edit', $book) }}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    onclick="showDeleteModal(this, {{ $book->id }}, '{{ Str::limit($book->title, 20) }}')"
                                    title="Delete"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No books found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if(method_exists($books, 'links'))
            <div class="pagination-wrapper">
                {{ $books->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-book"></i>
                </div>

                <h5 class="fw-semibold mb-2 text-primary">
                    Remove Book
                </h5>

                <p class="text-muted mb-1">
                    You are about to remove
                </p>

                <p class="fw-semibold text-dark mb-3" id="bookTitle"></p>

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

function showDeleteModal(button, bookId, bookTitle) {
    document.getElementById('bookTitle').innerText = bookTitle;
    document.getElementById('deleteForm').action = `/admin/books/${bookId}`;
    deleteModal.show();
}

function confirmDelete() {
    document.getElementById('deleteForm').submit();
}
</script>

@endsection

