@extends('student.layout')

@section('content')
<style>
    /* Orange Theme Palette */
    :root {
        --primary-orange: #ff6b00;
        --dark-orange: #e65100;
        --light-orange: #fff3e0;
        --orange-gradient: linear-gradient(135deg, #ff9100 0%, #ff6b00 100%);
    }

    /* Hero Header - Orange Gradient */
    .hero-section {
        background: var(--orange-gradient);
        border-radius: 20px;
        padding: 3rem 2rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(255, 107, 0, 0.2);
    }

    /* Decorative circles for modern feel */
    .hero-section::before {
        content: '';
        position: absolute;
        top: -30px;
        left: -30px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    /* Search Bar within Hero */
    .search-wrapper {
        background: white;
        padding: 8px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .search-wrapper input {
        border: none;
        box-shadow: none !important;
        padding-left: 15px;
    }

    .btn-search {
        border-radius: 50px;
        padding: 10px 30px;
        background: var(--dark-orange);
        border: none;
        color: white;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-search:hover {
        background: #000;
        color: #fff;
    }

    /* Orange Stat Boxes */
    .stat-box {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid var(--light-orange);
        transition: transform 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        border-color: var(--primary-orange);
    }

    .icon-circle {
        background: var(--light-orange);
        color: var(--primary-orange);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    /* Book Cards */
    .book-card {
        border: none;
        border-radius: 15px;
        transition: 0.3s;
    }

    .book-card:hover {
        box-shadow: 0 15px 35px rgba(255, 107, 0, 0.15) !important;
    }

    .book-cover-img {
        height: 280px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border-radius: 8px;
        font-weight: 600;
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
    }

    .btn-outline-orange:hover {
        background: var(--primary-orange);
        color: white;
    }

    .section-title {
        border-left: 5px solid var(--primary-orange);
        padding-left: 15px;
        font-weight: 800;
    }
</style>

<div class="container-fluid">

    <div class="hero-section text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-md-12 mb-4 mb-md-0">
                <h1 class="display-5 fw-bold mb-3">Welcome, {{  $studentName }}!</h1>
                <p class="lead mb-0 opacity-90">Explore the latest resources in our library.</p>
            </div>

        </div>
        <div class="container">
              <div class="row mt-3 ms-5">
            <div class="col-lg-5 ms-5">
                  <div class="form-check">
                <input class="form-check-input" type="radio" name="search_type" id="author" value="author">
                <label class="form-check-label" for="author">
                    Author
                </label>
            </div>
            </div>
            <div class="col-lg-5">
                  <div class="form-check">
                <input class="form-check-input" type="radio" name="search_type" id="title" value="title" checked>
                <label class="form-check-label" for="title">
                   Book Title
                </label>
            </div>
            </div>
        </div>
        </div>
        <div class="row mt-4">
             <div class="col-md-12">
                <form action="{{ route('student.dashboard') }}" method="GET">
                    <div  class="search-wrapper">
                        <i class="fas fa-search text-muted ms-3"></i>
                        <input type="text" name="search" class="form-control"
                               placeholder="Title, author,.." value="{{ request('search') }}">
                        <button type="submit" class="btn-search">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title text-dark mb-0">Recently Added</h3>
        <a href="{{ route('student.books') }}" class="fw-bold text-decoration-none" style="color: var(--primary-orange);">
            View Library <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row">
        @forelse($recentBooks as $book)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card book-card h-100 shadow-sm border-0">
                <div class="position-relative">
                    @if($book->cover_image_path)
                        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="book-cover-img card-img-top" alt="{{ $book->title }}">
                    @else
                        <div class="book-placeholder" style="height: 280px; background: #fdfdfd; display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-book fa-4x text-light-orange" style="color: #ffe0b2;"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $book->title }}">{{ $book->title }}</h6>
                    <p class="text-muted small mb-4"><i class="fas fa-user-edit me-1"></i> Author :  {{ $book->author }}</p>

                    <div class="mt-auto d-grid gap-2">
                        <a href="{{ route('student.books.show', $book) }}" class="btn btn-outline-orange btn-sm">
                            View Details
                        </a>
                        @if($book->file_path)
                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn btn-orange btn-sm">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No books found in the recent collection.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
