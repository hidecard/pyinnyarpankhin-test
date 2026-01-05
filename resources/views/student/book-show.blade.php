@extends('student.layout')

@section('content')
<style>
    /* Orange Theme Variables */
    :root {
        --primary-orange: #ff6b00;
        --dark-orange: #e65100;
        --light-orange: #fff3e0;
    }

    /* Professional Image Handling */
    .main-book-cover {
        max-height: 480px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(255, 107, 0, 0.15);
    }

    .related-book-cover {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .book-placeholder {
        height: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #fdfdfd;
        color: #ffe0b2;
        border-radius: 12px;
        border: 2px dashed var(--light-orange);
    }

    /* Card & UI Elements */
    .dashboard-card {
        border: none;
        border-radius: 15px;
        background: #fff;
    }

    .section-title {
        border-left: 5px solid var(--primary-orange);
        padding-left: 15px;
        font-weight: 800;
    }

    .badge-orange {
        background-color: var(--light-orange);
        color: var(--dark-orange);
        font-weight: 600;
        padding: 8px 12px;
    }

    /* Custom Orange Buttons */
    .btn-orange {
        background: var(--primary-orange);
        color: white;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-orange:hover {
        background: var(--dark-orange);
        color: white;
        transform: translateY(-2px);
    }

    .btn-outline-orange {
        border: 2px solid var(--primary-orange);
        color: var(--primary-orange);
        border-radius: 10px;
        font-weight: 600;
        background: transparent;
        transition: 0.3s;
    }

    .btn-outline-orange:hover {
        background: var(--primary-orange);
        color: white;
    }

    .breadcrumb-item a {
        color: var(--primary-orange);
        text-decoration: none;
        font-weight: 500;
    }

    .pdf {
        display: none;
    }

    iframe {
        width: 100%;
        height: 80vh;
        border: none;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4 ok">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-3 rounded-pill shadow-sm px-4">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('student.books') }}">Library</a></li>
                    <li class="breadcrumb-item active text-muted">{{ Str::limit($book->title, 30) }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-12 boo">
            <div class="card dashboard-card shadow-sm">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            @if($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                     class="main-book-cover"
                                     alt="{{ $book->title }}">
                            @else
                                <div class="book-placeholder">
                                    <i class="fas fa-book fa-5x"></i>
                                    <p class="mt-3 fw-bold">NO COVER IMAGE</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-7">
                            <span class="badge badge-orange mb-2">Ref ID: #{{ $book->id }}</span>
                            <h2 class="text-dark fw-bold mb-2">{{ $book->title }}</h2>
                            <h5 class="text-muted mb-4 fw-normal">
                                <i class="fas fa-pen-nib me-2 text-warning"></i> Author : {{ $book->author }}
                            </h5>

                            <hr class="my-4 opacity-25">

                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <small class="text-uppercase text-muted d-block ls-1">Library Entry</small>
                                    <p class="text-dark fw-bold mb-0">{{ $book->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-uppercase text-muted d-block ls-1">Access Status</small>
                                    <p class="text-success fw-bold mb-0"><i class="fas fa-check-circle me-1"></i> Open Access</p>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                @if($book->file_path)
                                    <a href="{{ asset('storage/' . $book->file_path) }}"
                                       target="_blank" class="btn btn-orange px-4 py-2">
                                        <i class="fas fa-file-pdf me-2"></i>Download PDF
                                    </a>
                                    <button class="btn btn-outline-orange px-4 py-2" onclick="toggleOnlineRead()">
                                        <i class="fas fa-eye me-2"></i>Online Read
                                    </button>

                                @else
                                    <button class="btn btn-secondary px-4 py-2" disabled>
                                        <i class="fas fa-times me-2"></i>No File
                                    </button>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- <div class="col-lg-4">
            <div class="card dashboard-card shadow-sm border-0 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Explorer
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('student.books') }}?search={{ urlencode($book->author) }}"
                           class="btn btn-outline-orange btn-sm text-start py-2">
                            <i class="fas fa-search me-2"></i>More by this author
                        </a>
                        <a href="{{ route('student.books') }}" class="btn btn-outline-secondary btn-sm text-start py-2">
                            <i class="fas fa-th-large me-2"></i>Back to Library
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row mt-5 rec">
        <div class="col-12">
            <h4 class="section-title mb-4">Recommended for You</h4>
            <div class="row">
                @php
                    $relatedBooks = \App\Models\Book::where('id', '!=', $book->id)
                        ->where(function($query) use ($book) {
                            $query->where('author', $book->author)
                                  ->orWhere('title', 'like', '%' . explode(' ', $book->title)[0] . '%');
                        })
                        ->take(4)
                        ->get();
                @endphp

                @forelse($relatedBooks as $relatedBook)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card dashboard-card h-100 shadow-sm transition-hover border-0">
                        @if($relatedBook->cover_image_path)
                            <img src="{{ asset('storage/' . $relatedBook->cover_image_path) }}"
                                 class="related-book-cover" alt="{{ $relatedBook->title }}">
                        @else
                            <div class="bg-light text-center py-5" style="height: 200px; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                <i class="fas fa-book fa-2x text-light-orange" style="color: #ffe0b2;"></i>
                            </div>
                        @endif
                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="card-title fw-bold text-dark text-truncate mb-1">{{ $relatedBook->title }}</h6>
                            <p class="text-muted small mb-3"> Author : {{ $relatedBook->author }}</p>
                            <a href="{{ route('student.books.show', $relatedBook) }}" class="btn btn-sm btn-orange mt-auto">Open Book</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-muted fst-italic">No specific suggestions found for this title.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
  <div class="container pdf">
            <div class="row">
                <div class="col-lg-12">
                    <iframe src="{{ asset('storage/' . $book->file_path) }}" frameborder="0"></iframe>
                </div>
            </div>
 </div>

<script>
function toggleOnlineRead() {
    let pdf = document.querySelector('.pdf');
    let rec = document.querySelector('.rec');
    let boo = document.querySelector('.boo');
    let ok = document.querySelector('.ok');
    if (pdf) {
        if (pdf.style.display === 'none' || pdf.style.display === '') {
            pdf.style.display = 'block';
            rec.style.display = 'none';
            boo.style.display = 'none';
            ok.style.display = 'none';
        } else {
            pdf.style.display = 'none';
            rec.style.display = 'block';
            boo.style.display = 'block';
            ok.style.display = 'block';
        }
    } else {
        console.error('PDF container not found');
    }
}



document.title = @json($book->title) + ' | Library';
</script>
@endsection
