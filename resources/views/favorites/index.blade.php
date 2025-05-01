@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>{{ $title }}</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="row mt-4">
        @if($favorites->count())
            @foreach($favorites as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @else
                        <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                            <span>No Image</span>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->excerpt ?? $post->body, 100) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Lihat Detail</a>
                            
                            <button class="action-btn favorite active" 
                                    data-post-id="{{ $post->id }}" 
                                    title="Hapus dari favorit">
                                <i class="bi bi-star-fill"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-footer text-muted">
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <h4>Anda belum memiliki koleksi favorit</h4>
                <p class="text-muted">Jelajahi koleksi museum dan tambahkan ke favorit Anda</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Jelajahi Koleksi</a>
            </div>
        @endif
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $favorites->links() }}
    </div>
</div>
@endsection