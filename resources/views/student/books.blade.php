@extends('student.layout')

@section('content')
<style>
    /* Orange Theme Variables */
    :root {
        --primary-orange: #ff6b00;
        --dark-orange: #e65100;
        --light-orange: #fff3e0;
    }

    /* Page Header Title */
    .section-title {
        border-left: 5px solid var(--primary-orange);
        padding-left: 15px;
        font-weight: 800;
        color: #1a202c;
    }

    /* Search Section Styling */
    .orange-search-box {
        background-color: white;
        border-radius: 15px;
        border: 1px solid var(--light-orange);
    }

    /* Professional Book Image Handling */
    .book-cover {
        width: 100%;
        height: 320px; /* Adjusted height for 4-column grid */
        object-fit: cover;
        object-position: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .book-placeholder {
        height: 320px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #fdfdfd;
        color: #ffe0b2;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* Card Styling */
    .book-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        background: #fff;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(255, 107, 0, 0.15) !important;
    }

    /* Custom Orange Buttons */
    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        border: none;
    }

    .btn-orange:hover {
        background: var(--dark-orange);
        color: white;
    }

    .btn-outline-orange {
        border: 2px solid var(--primary-orange);
        color: var(--primary-orange);
        border-radius: 8px;
        font-weight: 600;
        background: transparent;
    }

    .btn-outline-orange:hover {
        background: var(--primary-orange);
        color: white;
    }

    /* Pagination Override */
    .pagination .page-item.active .page-link {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
    }

    .pagination .page-link {
        color: var(--primary-orange);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="section-title mb-1">Library Collection</h2>
                    <p class="text-muted mb-0">Browse through our academic resources</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="orange-search-box p-4 shadow-sm">
                <form action="{{ route('student.books') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <label for="search" class="form-label fw-bold text-dark">Quick Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" id="search" class="form-control form-control-lg border-start-0"
                                   placeholder="Search by title, author,..."
                                   value="{{ $search ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-orange btn-lg w-100">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($search)
        <div class="col-12 mb-3">
            <div class="alert bg-white border-start border-4 border-warning shadow-sm">
                <i class="fas fa-info-circle text-warning me-2"></i>
                @if($books->total() > 0)
                    Showing {{ $books->total() }} results for "<strong>{{ $search }}</strong>"
                @else
                    No matches found for "<strong>{{ $search }}</strong>"
                @endif
            </div>
        </div>
        @endif

        <div class="col-12">
            @if($books->count() > 0)
                <div class="row">
                    @foreach($books as $book)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card book-card h-100 shadow-sm">
                            @if($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                     class="book-cover card-img-top"
                                     alt="{{ $book->title }}">
                            @else
                                <div class="book-placeholder card-img-top">
                                    <i class="fas fa-book fa-3x mb-2"></i>
                                    <small class="fw-bold">NO COVER</small>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold text-dark text-truncate mb-1" title="{{ $book->title }}">
                                    {{ $book->title }}
                                </h6>
                                <p class="card-text text-muted small mb-3">
                                    <i class="fas fa-pen-nib me-1"></i> Author : {{ $book->author }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('student.books.show', $book) }}" class="btn btn-outline-orange btn-sm">
                                            View Details
                                        </a>
                                        @if($book->file_path)
                                            <a href="{{ asset('storage/' . $book->file_path) }}"
                                               target="_blank" class="btn btn-orange btn-sm">
                                                <i class="fas fa-download me-1"></i>PDF
                                            </a>
                                        @else
                                            <button class="btn btn-light btn-sm text-muted" disabled>
                                                <i class="fas fa-times me-1"></i>No PDF
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search-minus fa-4x text-light-orange mb-4" style="color: var(--light-orange);"></i>
                    @if($search)
                        <h4 class="text-dark mb-3">We couldn't find any matches</h4>
                        <p class="text-muted mb-4">Try checking your spelling or use different keywords.</p>
                        <a href="{{ route('student.books') }}" class="btn btn-orange px-4">
                            Reset Search
                        </a>
                    @else
                        <h4 class="text-dark mb-3">Library Currently Empty</h4>
                        <p class="text-muted">The collection is being updated. Please check back later.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.closest('form').submit();
                }
            }, 1000); // 1s debounce is safer for mobile users
        });
    }
});
</script>
@endpush
@endsection
