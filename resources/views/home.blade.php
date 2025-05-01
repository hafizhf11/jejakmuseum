@extends('layouts.main', ['showHero' => true])

@section('container')
<div class="stats-section">
    <div class="stats-content">
        <p>
            Museum Trace Indonesia is an online catalog of <strong>184 522</strong> artworks
            <br>of which <strong>28 492</strong> in public domain
        </p>
    </div>
</div>

<div class="recommendation-section">
    <div class="recommendation-content">
        <div class="recommendation-label">Eksplorasi Koleksi Museum Kami</div>
        <h2 class="recommendation-title">Jejak Museum Indonesia</h2>
        <div class="recommendation-description">
            <p>Katalog daring yang menghimpun informasi museum-museum di seluruh penjuru Nusantara. Melalui platform ini, kami menghadirkan pengalaman menjelajah koleksi dan sejarah museum secara digital sebagai upaya pelestarian budaya Indonesia di era modern. Dari artefak kuno hingga karya seni kontemporer, Jejak Museum Indonesia menjadi jembatan antara kekayaan masa lalu dan generasi masa kini.</p>
        </div>
        <a href="/koleksi" class="explore-button">Explore collection <i class="bi bi-arrow-right"></i></a>
    </div>
</div>

<!-- Collections Section - Dipindahkan ke posisi paling bawah -->
<div class="collections-section">
    <div class="container">
        <div class="collections-header">
            <h2 class="section-title">Latest Collections</h2>
            <a href="/koleksi" class="more-link">More collections <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="collections-slider">
            <div class="collections-wrapper">
                @if(isset($latestPosts) && $latestPosts->count())
                    @foreach($latestPosts as $post)
                        <div class="collection-item">
                            <div class="artwork-image">
                                <!-- Link pada gambar seperti di koleksi.blade.php -->
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
<!-- End Collections Section -->
@endsection

<!-- Tambahkan di bagian head -->
@section('head')
<style>
    .collections-slider {
        position: relative;
        margin: 30px 0;
    }

    .collections-wrapper {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
        gap: 20px;
        padding: 10px 0;
    }

    .collections-wrapper::-webkit-scrollbar {
        display: none;
    }

    .collection-item {
        flex: 0 0 auto;
        width: 300px;
        transition: transform 0.3s;
    }

    .scroll-indicator {
    text-align: center;
    margin-top: 15px;
    color: #999;
    font-size: 0.9rem;
    }

</style>
@endsection

<!-- Tambahkan inline script di bagian akhir -->
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
    });
</script>

@endsection