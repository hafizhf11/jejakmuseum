@extends('layouts.main')

@section('container')
<div class="museum-detail">
    <!-- Main Content - Langsung tanpa jarak dari navbar -->
    <div class="container py-4">
        <!-- Hero Image dengan Container -->
        <div class="museum-hero mb-4">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="hero-image">
            @else
                <img src="https://picsum.photos/1200/600" alt="{{ $post->title }}" class="hero-image">
            @endif
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>{{ $post->title }}</h1>
                <div class="location-badge">
                    <i class="bi bi-geo-alt-fill"></i> {{ $post->provinsi }}
                </div>
            </div>
        </div>
        
        <!-- Navigation Bar -->
        <div class="action-bar mb-4">
            <a href="/koleksi" class="back-button">
                <i class="bi bi-arrow-left"></i> Kembali ke Koleksi
            </a>
            <div class="action-buttons">
                @auth
                <button class="action-btn favorite-btn {{ Auth::user()->hasFavorited($post) ? 'active' : '' }}" 
                        title="{{ Auth::user()->hasFavorited($post) ? 'Hapus dari favorit' : 'Simpan ke favorit' }}"
                        data-post-id="{{ $post->id }}">
                    <i class="bi {{ Auth::user()->hasFavorited($post) ? 'bi-star-fill' : 'bi-star' }}"></i>
                </button>
            @else
                <a href="{{ route('login') }}" class="action-btn" title="Login untuk menyimpan ke favorit">
                    <i class="bi bi-star"></i>
                </a>
            @endauth
                <div class="artwork-actions">
                    <button 
                        class="action-btn favorite {{ Auth::check() && Auth::user()->hasFavorited($post) ? 'active' : '' }}" 
                        title="{{ Auth::check() && Auth::user()->hasFavorited($post) ? 'Hapus dari favorit' : 'Tambahkan ke favorit' }}"
                        data-post-id="{{ $post->id }}">
                        <i class="bi {{ Auth::check() && Auth::user()->hasFavorited($post) ? 'bi-star-fill' : 'bi-star' }}"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Main Info -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="m-0">Informasi Museum</h2>
                        <span class="category-badge">
                            <a href="/koleksi?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-pin-map"></i> Lokasi
                                </div>
                                <div class="info-value">
                                    {{ $post->kabupaten }}, {{ $post->provinsi }}
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-collection"></i> Jumlah Koleksi
                                </div>
                                <div class="info-value">
                                    {{ $post->jumlah_koleksi }} item
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-person"></i> Pemilik
                                </div>
                                <div class="info-value">
                                    {{ $post->pemilik ?: '-' }}
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-card-list"></i> Tipe Terakhir
                                </div>
                                <div class="info-value">
                                    {{ $post->tipe_terakhir }}
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-upc"></i> Nomor Pendaftaran
                                </div>
                                <div class="info-value">
                                    {{ $post->nomor_pendaftaran }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($post->body)
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="m-0">Deskripsi</h2>
                    </div>
                    <div class="card-body">
                        <div class="museum-description">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Review Section -->
                <div id="review-section" class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="m-0">Ulasan Pengunjung</h2>
                        <div class="rating-summary">
                            @php $avgRating = $post->getAverageRatingAttribute(); @endphp
                            <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $avgRating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @elseif($i <= $avgRating + 0.5)
                                        <i class="bi bi-star-half text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-count">({{ $post->reviews->count() }} ulasan)</span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Form untuk submit review jika user login -->
                        <!-- Form untuk submit review jika user login -->
                    @auth
                        @php
                            $userReview = $post->reviews->where('user_id', auth()->id())->first();
                        @endphp

                        <div class="review-form-container mb-4">
                            <!-- Pesan sukses/error -->
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
                            
                            <!-- Review section untuk user yang sudah login dan memberikan review -->
                            @if($userReview)
                                <div class="user-review-display p-4 bg-light rounded mb-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="mb-3">Ulasan Anda</h4>
                                        <button class="btn btn-sm btn-secondary edit-review-btn" title="Edit ulasan">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="fw-bold mb-2">Rating Anda:</div>
                                        <div class="d-flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $userReview->rating ? 'bi-star-fill' : 'bi-star' }} text-warning me-1"></i>
                                            @endfor
                                            <span class="ms-2">({{ $userReview->rating }}/5)</span>
                                        </div>
                                    </div>
                                    
                                    @if($userReview->comment)
                                        <div class="mb-0">
                                            <div class="fw-bold mb-2">Komentar Anda:</div>
                                            <div class="p-3 bg-white rounded">{{ $userReview->comment }}</div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Form Edit Review (tersembunyi secara default) -->
                                <div id="editReviewForm" style="display: none;">
                                    <h4>Edit Ulasan Anda</h4>
                                    <form action="{{ route('reviews.update', $userReview->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="star-rating">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" name="rating" id="edit-rating-{{ $i }}" value="{{ $i }}" 
                                                        {{ $userReview->rating == $i ? 'checked' : '' }} required>
                                                    <label for="edit-rating-{{ $i }}">
                                                        <i class="bi bi-star-fill"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Komentar (Maks. 1000 karakter)</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="3" 
                                                maxlength="1000">{{ $userReview->comment }}</textarea>
                                            <small class="text-muted">
                                                <span id="char-count">{{ strlen($userReview->comment) }}</span>/1000 karakter
                                            </small>
                                            @error('comment')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary">
                                                Perbarui Ulasan
                                            </button>
                                            
                                            <button type="button" class="btn btn-outline-secondary ms-2" id="cancelEdit">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                    <form action="{{ route('reviews.destroy', $userReview->id) }}" 
                                                method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('Yakin ingin menghapus ulasan ini?')">
                                                    Hapus Ulasan
                                                </button>
                                    </form>
                                </div>
                            @else
                                <!-- User belum memberikan review -->
                                <h4>Berikan Ulasan</h4>
                                <form action="{{ route('reviews.store', ['id' => $post->id]) }}" method="POST" id="review-form">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <div class="star-rating">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required>
                                                <label for="rating-{{ $i }}">
                                                    <i class="bi bi-star-fill"></i>
                                                </label>
                                            @endfor
                                        </div>
                                        @error('rating')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Komentar (Maks. 1000 karakter)</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3" 
                                            maxlength="1000">{{ old('comment') }}</textarea>
                                        <small class="text-muted">
                                            <span id="char-count">0</span>/1000 karakter
                                        </small>
                                        @error('comment')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info mb-4">
                            <p class="mb-0"><a href="{{ route('login') }}" class="alert-link">Login</a> untuk memberikan ulasan tentang museum ini.</p>
                        </div>
                    @endauth
                        
                        <!-- Daftar ulasan dari pengunjung -->
                        <div class="reviews-list">
                            <h4 class="mb-3">Semua Ulasan ({{ $post->reviews->count() }})</h4>
                            
                            @if($post->reviews->count() > 0)
                                @foreach($post->reviews->sortByDesc('created_at') as $review)
                                    <div class="review-item">
                                        <div class="review-header">
                                            <div class="review-user">
                                                <div class="user-avatar">
                                                    {{ substr($review->user->name, 0, 1) }}
                                                </div>
                                                <div class="user-info">
                                                    <h5>{{ $review->user->name }}</h5>
                                                    <span class="review-date">{{ $review->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                    @else
                                                        <i class="bi bi-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">Belum ada ulasan untuk museum ini.</p>
                                    <p>Jadilah yang pertama memberikan ulasan!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
            
            <!-- Right Column - Additional Info -->
            <div class="col-lg-4">
                <!-- Museum Map -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="m-0">Lokasi Museum</h2>
                    </div>
                    <div class="card-body p-0">
                        @if($post->latitude && $post->longitude)
                            <!-- Peta Interaktif dengan Leaflet + OpenStreetMap -->
                            <div id="museumMap" style="height: 300px; width: 100%;"></div>
                            
                            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
                            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var map = L.map('museumMap').setView([{{ $post->latitude }}, {{ $post->longitude }}], 15);
                                    
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                    }).addTo(map);
                                    
                                    L.marker([{{ $post->latitude }}, {{ $post->longitude }}])
                                        .addTo(map)
                                        .bindPopup("{{ $post->title }}")
                                        .openPopup();
                                });
                            </script>
                        @else
                            <!-- Placeholder jika tidak ada koordinat -->
                            <img src="{{ asset('images/no-map.jpg') }}" alt="Lokasi belum tersedia" class="img-fluid w-100">
                        @endif
                        
                        <div class="map-link-container">
                            @if($post->maps_link)
                                <!-- Tetap menggunakan Google Maps Link -->
                                <a href="{{ $post->maps_link }}" class="map-link" target="_blank" rel="noopener">
                                    <i class="bi bi-geo-alt"></i> Lihat di Google Maps
                                </a>
                            @else
                                <span class="text-muted">
                                    <i class="bi bi-geo-alt"></i> Link lokasi belum tersedia
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Related Museums -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="m-0">Museum Terkait</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="related-list">
                            @if($relatedMuseums->count())
                                @foreach($relatedMuseums as $relatedMuseum)
                                    <a href="/posts/{{ $relatedMuseum->slug }}" class="related-item">
                                        <div class="related-img" style="background-image: url('{{ $relatedMuseum->image ? asset('storage/' . $relatedMuseum->image) : 'https://picsum.photos/seed/' . $relatedMuseum->id . '/100/100' }}')"></div>
                                        <div class="related-info">
                                            <h4>{{ $relatedMuseum->title }}</h4>
                                            <p>{{ $relatedMuseum->kabupaten }}, {{ $relatedMuseum->provinsi }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="p-3 text-center">
                                    <p class="text-muted mb-0">Tidak ada museum terkait dalam kategori yang sama.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Favorite button functionality
    const favoriteBtn = document.querySelector('.favorite-btn');
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) {
                this.querySelector('i').classList.remove('bi-bookmark');
                this.querySelector('i').classList.add('bi-bookmark-fill');
                this.style.backgroundColor = '#ff6b6b';
                this.querySelector('i').style.color = 'white';
            } else {
                this.querySelector('i').classList.remove('bi-bookmark-fill');
                this.querySelector('i').classList.add('bi-bookmark');
                this.style.backgroundColor = '#f5f5f5';
                this.querySelector('i').style.color = '#555';
            }
        });
    }
    
    // Share button functionality
    const shareBtn = document.querySelector('.share-btn');
    if (shareBtn && navigator.share) {
        shareBtn.addEventListener('click', async function() {
            try {
                await navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } catch (err) {
                console.error('Error sharing:', err);
            }
        });
    } else if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            // Fallback for browsers that don't support Web Share API
            const dummy = document.createElement('input');
            document.body.appendChild(dummy);
            dummy.value = window.location.href;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            
            // Show feedback
            alert('URL disalin ke clipboard!');
        });
    }
</script>
@endsection