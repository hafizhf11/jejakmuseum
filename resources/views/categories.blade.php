@extends('layouts/main')

@section('container')
<div class="container my-5">
    <h1 class='mb-4 text-center'>Kategori Koleksi</h1>
    <p class="text-center text-muted mb-5">Jelajahi koleksi museum berdasarkan kategori</p>

    <div class="category-grid">
        @foreach ($categories as $category)
        <a href="/koleksi?category={{ $category->slug }}" class="category-card">
            <div class="category-image">
                <img src="https://picsum.photos/seed/{{ $category->slug }}/800/500" alt="{{ $category->name }}">
                <div class="category-overlay"></div>
                <div class="category-icon">
                    <!-- Ikon bisa disesuaikan per kategori -->
                    <i class="bi bi-collection"></i>
                </div>
            </div>
            <div class="category-content">
                <h3>{{ $category->name }}</h3>
                <p class="category-description">
                    <!-- Jika ada deskripsi kategori, gunakan di sini -->
                    {{ $category->description ?? 'Lihat semua koleksi dalam kategori ini' }}
                </p>
                <div class="category-meta">
                    <span class="category-count">
                        <i class="bi bi-grid"></i> 
                        {{ $category->posts_count ?? 'Berbagai' }} koleksi
                    </span>
                </div>
            </div>
            <div class="category-action">
                <span>Jelajahi <i class="bi bi-arrow-right"></i></span>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="category-footer text-center mt-5">
        <p>Tidak menemukan kategori yang Anda cari?</p>
        <a href="/koleksi" class="btn btn-outline-dark mt-2">Lihat Semua Koleksi</a>
    </div>
</div>
@endsection