@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Book Details</h3>
            <div>
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    Back to List
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- LEFT SIDE : Book Info -->
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Book Title:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $book->title }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Author:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $book->author }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Created:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $book->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Updated:</label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">{{ $book->updated_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE : Files -->
                <div class="col-md-4">
                    <!-- Cover Image -->
                    <div class="form-group text-center">
                        <label class="font-weight-bold">Cover Image</label>
                        <div class="mb-3">
                            @if($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                     alt="Cover" class="img-thumbnail"
                                     style="width:200px;height:250px;object-fit:cover;">
                            @else
                                <div class="bg-secondary text-white text-center d-flex align-items-center justify-content-center"
                                     style="width:200px;height:250px;">
                                    <span>No Cover Image</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- PDF File -->
                    <div class="form-group text-center">
                        <label class="font-weight-bold">PDF File</label>
                        @if($book->file_path)
                            <div class="mb-3">
                                <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank"
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-file-pdf fa-2x mb-2 d-block"></i>
                                    View PDF
                                </a>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> Click to open PDF in new tab
                            </small>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> No PDF file uploaded
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">
                        <i class="fas fa-hashtag"></i> Book ID: {{ $book->id }}
                    </small>
                </div>
                <div>
                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                          style="display: inline;"
                          onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete Book
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

