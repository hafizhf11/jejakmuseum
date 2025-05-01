@extends('layouts.main')
@section('container')
<div class="container my-5">    
    <h1 class='mb-5 text-center'>{{ $title }}</h1>
    @if ($posts->count())
        <div class="gallery-container">
            @foreach ($posts as $post)
                <div class="gallery-item">
                    <div class="artwork-image">
                        <!-- Tambahkan link pada gambar -->
                        <a href="/posts/{{ $post->slug }}" class="artwork-link">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <img src="https://picsum.photos/800/600" alt="{{ $post->title }}">
                            @endif
                        </a>
                        <div class="artwork-actions">
                        <button 
                            class="action-btn favorite {{ Auth::check() && Auth::user()->hasFavorited($post) ? 'active' : '' }}" 
                            title="{{ Auth::check() && Auth::user()->hasFavorited($post) ? 'Hapus dari favorit' : 'Tambahkan ke favorit' }}"
                            data-post-id="{{ $post->id }}">
                            <i class="bi {{ Auth::check() && Auth::user()->hasFavorited($post) ? 'bi-star-fill' : 'bi-star' }}"></i>
                        </button>
                        </div>
                    </div>
                    
                    <div class="artwork-info">
                        <h3 class="title">
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
                        </h3>
                        <div class="details">
                            @if($post->provinsi)
                                {{ $post->provinsi }},
                            @endif
                            @if($post->kabupaten)
                                {{ $post->kabupaten }},
                            @endif
                            @if($post->created_at)
                                {{ $post->created_at->format('Y') }}
                            @endif
                        </div>
                        
                        <div class="category-tag">
                            <a href="/koleksi?category={{ $post->category->slug }}">
                                {{ $post->category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center fs-4">No Post Found.</p>
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //Add click handlers for favorite and zoom buttons
        const favoriteButtons = document.querySelectorAll('.action-btn.favorite');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Prevent triggering the parent link
                event.stopPropagation();
                event.preventDefault();
                this.classList.toggle('active');
            });
        });
    });
</script>
@endsection