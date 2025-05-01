@extends('layouts.main')

@section('container')
<div class="container my-5">    
    <h1 class='mb-5 text-center'>{{ $title }}</h1>
    
    @if ($favorites->count())
        <div class="gallery-container">
            @foreach ($favorites as $post)
                <div class="gallery-item">
                    <div class="artwork-image">
                        <a href="/posts/{{ $post->slug }}" class="artwork-link">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <img src="https://picsum.photos/800/600" alt="{{ $post->title }}">
                            @endif
                        </a>
                        <div class="artwork-actions">
                            <button 
                                class="action-btn favorite active" 
                                title="Hapus dari favorit"
                                data-post-id="{{ $post->id }}">
                                <i class="bi bi-star-fill"></i>
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
        
        <div class="d-flex justify-content-center mt-4">
            {{ $favorites->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-star display-1 text-muted"></i>
            <p class="fs-4 mt-3">Anda belum memiliki koleksi favorit.</p>
            <a href="/koleksi" class="btn btn-primary mt-2">
                Jelajahi Koleksi
            </a>
        </div>
    @endif
</div>
@endsection