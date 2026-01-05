
@extends('admin.layout')

@section('title', 'Add New Book')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.books.index') }}">Books</a></li>
    <li class="breadcrumb-item active">Add New Book</li>
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
            <i class="fas fa-book"></i> Add New Book
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Book Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- LEFT SIDE : Book Info -->
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}" required
                                           placeholder="Enter book title">
                                </div>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-pen-nib"></i></span>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                           name="author" value="{{ old('author') }}" required
                                           placeholder="Enter author name">
                                </div>
                                @error('author')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">The person who wrote this book</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE : Files -->
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-image me-2"></i>Cover & File</h6>
                            </div>
                            <div class="card-body text-center">
                                <!-- Cover Image Preview -->
                                <div class="form-group text-center mb-3">
                                    <label class="form-label">Cover Image</label>

                                    <div class="mb-2">
                                        <img id="coverPreview"
                                             src="https://via.placeholder.com/150x200"
                                             class="img-thumbnail"
                                             style="width:150px;height:200px;object-fit:cover;cursor:pointer;"
                                             onclick="document.getElementById('coverImage').click()">
                                    </div>

                                    <input type="file" id="coverImage" class="form-control d-none"
                                           name="cover_image" accept="image/*"
                                           onchange="previewCoverImage(event)">
                                    <small class="text-muted d-block">Click image to upload</small>
                                    @error('cover_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <!-- PDF File -->
                                <div class="form-group">
                                    <label>PDF File</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" accept=".pdf">
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <small class="text-muted">Upload PDF file</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create Book
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
        preview.src = "https://via.placeholder.com/150x200";
    }
}

// Custom file input label update
$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

