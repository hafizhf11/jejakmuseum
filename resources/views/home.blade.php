@extends('layouts.main', ['showHero' => true])

@section('container')
<div class="stats-section">
    <div class="stats-content">
        <p>
            Temukan koleksi terbaik dari berbagai museum Indonesia, 
            <br> semua dalam satu tempat sebagai referensi kunjungan Anda!
        </p>
    </div>
</div>

<div class="recommendation-section loading">
    <div class="recommendation-content">
        <div class="recommendation-label">Eksplorasi Koleksi Museum Kami</div>
        <h2 class="recommendation-title">Jejak Museum Indonesia</h2>
        <div class="recommendation-description">
            <p>Katalog daring yang menghimpun informasi museum-museum di seluruh penjuru Nusantara. Melalui platform ini, kami menghadirkan pengalaman menjelajah koleksi dan sejarah museum secara digital sebagai upaya pelestarian budaya Indonesia di era modern. Dari artefak kuno hingga karya seni kontemporer, Jejak Museum Indonesia menjadi jembatan antara kekayaan masa lalu dan generasi masa kini.</p>
        </div>
        <a href="/categories" class="explore-button">Cari Kategori Museum <i class="bi bi-arrow-right"></i></a>
    </div>
</div>


<div class="articles-section">
    <div class="container">
        <div class="articles-header">
            <h2 class="section-title">Artikel Terbaru</h2>
            <a href="/articles" class="more-link">Lihat semua artikel <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="articles-showcase">
            @if(isset($latestArticles) && $latestArticles->count())
                <!-- Featured Article (artikel paling baru) -->
                <div class="featured-article">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="featured-image">
                                @if($latestArticles[0]->image)
                                    <img src="{{ asset('storage/' . $latestArticles[0]->image) }}" alt="{{ $latestArticles[0]->title }}" class="img-fluid rounded-4">
                                @else
                                    <img src="https://source.unsplash.com/900x600?museum,artifact" alt="{{ $latestArticles[0]->title }}" class="img-fluid rounded-4">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="featured-content p-lg-4">
                                <div class="badge mb-2" style="background-color: #8b5d33; color: white;">Artikel Terbaru</div>
                                <h3 class="mb-3"><a href="/articles/{{ $latestArticles[0]->slug }}" class="text-decoration-none" style="color: #6b4226;">{{ $latestArticles[0]->title }}</a></h3>
                                <p class="text-muted">{{ Str::limit($latestArticles[0]->excerpt, 150) }}</p>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="author-avatar me-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: #8b5d33;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <small class="d-block">{{ $latestArticles[0]->user->name }}</small>
                                        <small class="text-muted">{{ $latestArticles[0]->published_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="/articles/{{ $latestArticles[0]->slug }}" class="btn px-4 py-2 rounded-pill" style="background-color: #6b4226; color: white;">
                                        Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/articles/{{ $latestArticles[0]->slug }}" class="text-decoration-none"></a>
                </div>
                
                <!-- Other Articles - 3 artikel berikutnya -->
                <div class="other-articles mt-5">
                    <div class="row">
                        @foreach($latestArticles->skip(1)->take(3) as $article)
                            <div class="col-md-4 mb-4">
                                <div class="article-card h-100 rounded-4 overflow-hidden bg-white shadow-sm">
                                    <div class="article-img position-relative">
                                        @if($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://source.unsplash.com/500x300?museum,history,{{ $loop->index }}" alt="{{ $article->title }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                        @endif
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <div class="bg-white rounded-circle p-2 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#8b5d33" class="bi bi-journal-text" viewBox="0 0 16 16">
                                                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-12a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-content p-4">
                                        <h5 class="mb-2"><a href="/articles/{{ $article->slug }}" class="text-decoration-none" style="color: #6b4226;">{{ Str::limit($article->title, 45) }}</a></h5>
                                        <p class="text-muted small mb-3">{{ Str::limit($article->excerpt, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <small class="text-muted">{{ $article->published_at->format('d M Y') }}</small>
                                            <a href="/articles/{{ $article->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                                Jelajahi <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center my-5">
                    <p class="fs-5 text-muted">Belum ada artikel tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="collections-section">
    <div class="container">
        <div class="collections-header">
            <h2 class="section-title">Latest Collections</h2>
            <a href="/koleksi" class="more-link">More collections <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="collections-container">
            <div class="collections-wrapper custom-scrollbar">
                @if(isset($latestPosts) && $latestPosts->count())
                    @foreach($latestPosts as $post)
                        <div class="collection-item">
                            <div class="artwork-image">
                                <a href="/posts/{{ $post->slug }}" class="artwork-link">
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                    @else
                                        <img src="https://picsum.photos/800/600" alt="{{ $post->title }}">
                                    @endif
                                </a>
                                <div class="artwork-count">
                                    {{ $post->provinsi ?? '' }} 
                                    {{ $post->kabupaten ? '· '.$post->kabupaten : '' }}
                                </div>
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
                @else
                    <p>No collections available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Favorit button functionality
        const favoriteButtons = document.querySelectorAll('.action-btn.favorite');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                event.preventDefault();
                this.classList.toggle('active');
            });
        });
        
        // PERBAIKAN SLIDER
        const slider = document.querySelector('.collections-wrapper');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const items = document.querySelectorAll('.collection-item');
        
        if (slider && prevBtn && nextBtn && items.length > 0) {
            // Hitung lebar item aktual
            const firstItem = items[0];
            const itemWidth = firstItem.offsetWidth;
            const itemStyle = window.getComputedStyle(firstItem);
            const itemMargin = parseInt(itemStyle.marginRight) || 20;
            const scrollAmount = itemWidth + itemMargin;
            
            // Fungsi scroll dengan animasi halus
            nextBtn.onclick = function() {
                slider.scrollBy({ left: scrollAmount * 2, behavior: 'smooth' });
                setTimeout(updateButtonState, 400);
            };
            
            prevBtn.onclick = function() {
                slider.scrollBy({ left: -scrollAmount * 2, behavior: 'smooth' });
                setTimeout(updateButtonState, 400);
            };
            
            // Update button state
            const updateButtonState = () => {
                const isAtStart = slider.scrollLeft <= 5;
                const isAtEnd = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5;
                
                prevBtn.classList.toggle('disabled', isAtStart);
                nextBtn.classList.toggle('disabled', isAtEnd);
            };
            
            // Set initial state
            updateButtonState();
            
            // Update on scroll and resize
            slider.addEventListener('scroll', updateButtonState);
            window.addEventListener('resize', updateButtonState);
        }
        
        // Menambahkan script untuk fallback image pada recommendation section
        const recommendationSection = document.querySelector('.recommendation-section');
        
        // Cek apakah gambar lokal tersedia
        const img = new Image();
        img.onload = function() {
            // Gambar berhasil dimuat, gunakan gambar lokal
            recommendationSection.classList.remove('loading');
            recommendationSection.classList.add('local-bg');
        };
        
        img.onerror = function() {
            // Gambar gagal dimuat, gunakan fallback
            recommendationSection.classList.remove('loading');
            recommendationSection.classList.add('fallback-bg');
        };
        
        // Set sumber gambar yang akan dicek
        img.src = '/img/recom.jpg';
        
        // Set timeout untuk fallback jika terlalu lama
        setTimeout(function() {
            if (recommendationSection.classList.contains('loading')) {
                recommendationSection.classList.remove('loading');
                recommendationSection.classList.add('fallback-bg');
            }
        }, 3000); // Tunggu 3 detik maksimum
    });
</script>

@endsection