@extends('layouts.main')

@section('container')
<div class="container py-5">
    <h1 class="mb-4 text-center">Riwayat Ulasan Saya</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($reviews->count() > 0)
        <div class="row">
            @foreach($reviews as $review)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <a href="/posts/{{ $review->post->slug }}">
                                @if($review->post->image)
                                    <img src="{{ asset('storage/' . $review->post->image) }}" 
                                        alt="{{ $review->post->title }}" 
                                        class="card-img-top" 
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://source.unsplash.com/500x400?museum" 
                                        alt="{{ $review->post->title }}" 
                                        class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                @endif
                            </a>
                            <div class="position-absolute top-0 end-0 p-2">
                                <div class="bg-dark text-white px-2 py-1 rounded-pill small">
                                    {{ $review->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/posts/{{ $review->post->slug }}" class="text-decoration-none text-dark">
                                    {{ $review->post->title }}
                                </a>
                            </h5>
                            
                            <div class="d-flex align-items-center mb-2 text-muted small">
                                <i class="bi bi-geo-alt me-1"></i>
                                <span>{{ $review->post->kabupaten }}, {{ $review->post->provinsi }}</span>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="rating-stars me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-secondary"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="fw-bold">{{ $review->rating }}/5</span>
                            </div>
                            
                            @if($review->comment)
                                <div class="review-comment mb-3">
                                    <p class="card-text text-muted">
                                        @if(strlen($review->comment) > 100)
                                            {{ substr($review->comment, 0, 100) . '...' }}
                                        @else
                                            {{ $review->comment }}
                                        @endif
                                    </p>
                                </div>
                            @else
                                <p class="text-muted fst-italic small mb-3">Tidak ada komentar</p>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/posts/{{ $review->post->slug }}#review-section" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Edit Ulasan
                                </a>
                                
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $reviews->links() }}
        </div>
        
    @else
        <div class="text-center py-5">
            <i class="bi bi-chat-square-quote" style="font-size: 4rem; color: #ccc;"></i>
            <h3 class="mt-3">Belum ada ulasan</h3>
            <p class="text-muted">Anda belum memberikan ulasan untuk koleksi museum manapun.</p>
            <a href="/koleksi" class="btn btn-primary mt-3">Jelajahi Koleksi Museum</a>
        </div>
    @endif
</div>

<style>
    .card {
        transition: transform 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .rating-stars {
        line-height: 1;
    }
</style>
@endsection