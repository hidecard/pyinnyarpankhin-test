@extends('admin.layout')

@section('title', 'Edit Book')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.books.index') }}">Books</a></li>
    <li class="breadcrumb-item active">Edit Book</li>
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
            <i class="fas fa-book"></i> Edit Book
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Books
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Book Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- LEFT SIDE : Book Info -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $book->title) }}" required
                                           placeholder="Enter book title">
                                </div>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Full title of the book</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                           id="author" name="author" value="{{ old('author', $book->author) }}" required
                                           placeholder="Enter author name">
                                </div>
                                @error('author')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Author of the book</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE : Files -->
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Cover Image Preview -->
                                <div class="text-center mb-3">
                                    <label class="form-label">Cover Image</label>
                                    <div class="mb-2">
                                        <img id="coverPreview"
                                             src="{{ $book->cover_image_path ? asset('storage/' . $book->cover_image_path) : 'https://via.placeholder.com/150x200' }}"
                                             class="img-thumbnail"
                                             style="width:150px;height:200px;object-fit:cover;cursor:pointer;"
                                             onclick="document.getElementById('coverImage').click()">
                                    </div>
                                    <input type="file" id="coverImage" class="form-control d-none"
                                           name="cover_image" accept="image/*"
                                           onchange="previewCoverImage(event)">
                                    <small class="text-muted d-block">Click image to upload new</small>
                                    @error('cover_image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <!-- PDF File -->
                                <div class="form-group">
                                    <label class="form-label">PDF File</label>
                                    @if($book->file_path)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-file-pdf"></i> View Current PDF
                                            </a>
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" accept=".pdf">
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <small class="text-muted">{{ $book->file_path ? 'Upload a new PDF to replace current' : 'Upload PDF file' }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewCoverImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('coverPreview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ $book->cover_image_path ? asset('storage/' . $book->cover_image_path) : 'https://via.placeholder.com/150x200' }}";
    }
}
</script>

