@extends('layouts.main')

@section('container')
<div class="container my-5">
    <h1 class="mb-4 text-center" style="color: #6b4226;">Hasil Pencarian: "{{ $query }}"</h1>
    
    <!-- Tab navigation -->
    <ul class="nav nav-tabs mb-4 justify-content-center" id="searchResultTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                Semua Hasil <span class="badge rounded-pill ms-1" style="background-color: #8b5d33;">{{ $posts->total() + $articles->total() }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="collections-tab" data-bs-toggle="tab" data-bs-target="#collections" type="button" role="tab">
                Koleksi Museum <span class="badge rounded-pill ms-1" style="background-color: #8b5d33;">{{ $posts->total() }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles" type="button" role="tab">
                Artikel <span class="badge rounded-pill ms-1" style="background-color: #8b5d33;">{{ $articles->total() }}</span>
            </button>
        </li>
    </ul>
    
    <div class="tab-content" id="searchResultTabContent">
        <!-- Tab: All Results -->
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <!-- Collection Posts Section -->
            @if($posts->count())
            <div class="search-section mb-5">
                <h2 style="color: #6b4226;" class="mb-4">Koleksi Museum</h2>
                
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://source.unsplash.com/500x400?museum" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge" style="background-color: #8b5d33;">{{ $post->category->name }}</span>
                                    @if($post->provinsi)
                                    <span class="text-muted small">{{ $post->provinsi }}</span>
                                    @endif
                                </div>
                                <h5 class="card-title" style="color: #6b4226;">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                    Lihat Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    <a href="/search?search={{ $query }}&tab=collections" class="btn btn-outline-secondary">
                        Lihat Semua Koleksi
                    </a>
                </div>
            </div>
            @endif
            
            <!-- Articles Section -->
            @if($articles->count())
            <div class="search-section">
                <h2 style="color: #6b4226;" class="mb-4">Artikel</h2>
                
                <div class="row">
                    @foreach ($articles as $article)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="position-relative">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://source.unsplash.com/500x300?museum,history" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
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
                            <div class="card-body p-4">
                                <h5 class="card-title" style="color: #6b4226;">{{ $article->title }}</h5>
                                <p class="card-text text-muted mb-2">
                                    <small>By: {{ $article->user->name }} · {{ $article->published_at->format('d M Y') }}</small>
                                </p>
                                <p class="card-text">{{ Str::limit($article->excerpt, 100) }}</p>
                                <a href="/articles/{{ $article->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    <a href="/search?search={{ $query }}&tab=articles" class="btn btn-outline-secondary">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
            @endif
            
            @if(!$posts->count() && !$articles->count())
            <div class="text-center my-5">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#6b4226" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </div>
                <h3 style="color: #6b4226;">Tidak Ada Hasil Ditemukan</h3>
                <p class="text-muted mb-4">Coba gunakan kata kunci yang berbeda atau lebih umum</p>
                <a href="/" class="btn px-4 py-2" style="background-color: #8b5d33; color: white;">
                    Kembali ke Beranda
                </a>
            </div>
            @endif
        </div>
        
        <!-- Tab: Collections Only -->
        <div class="tab-pane fade" id="collections" role="tabpanel" aria-labelledby="collections-tab">
            <!-- Code for collections tab (same layout as in the "all" tab but only showing posts) -->
            @if($posts->count())
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://source.unsplash.com/500x400?museum" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge" style="background-color: #8b5d33;">{{ $post->category->name }}</span>
                                @if($post->provinsi)
                                <span class="text-muted small">{{ $post->provinsi }}</span>
                                @endif
                            </div>
                            <h5 class="card-title" style="color: #6b4226;">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->appends(['search' => $query, 'tab' => 'collections'])->links() }}
            </div>
            @else
            <div class="text-center my-5">
                <p class="fs-5 text-muted">Tidak ada koleksi museum yang sesuai dengan kata kunci "{{ $query }}"</p>
            </div>
            @endif
        </div>
        
        <!-- Tab: Articles Only -->
        <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
            <!-- Code for articles tab (same layout as in the "all" tab but only showing articles) -->
            @if($articles->count())
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://source.unsplash.com/500x300?museum,history" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
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
                        <div class="card-body p-4">
                            <h5 class="card-title" style="color: #6b4226;">{{ $article->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                <small>By: {{ $article->user->name }} · {{ $article->published_at->format('d M Y') }}</small>
                            </p>
                            <p class="card-text">{{ Str::limit($article->excerpt, 100) }}</p>
                            <a href="/articles/{{ $article->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->appends(['search' => $query, 'tab' => 'articles'])->links() }}
            </div>
            @else
            <div class="text-center my-5">
                <p class="fs-5 text-muted">Tidak ada artikel yang sesuai dengan kata kunci "{{ $query }}"</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        color: #6b4226;
        border: none;
        padding: 0.75rem 1.5rem;
    }
    
    .nav-tabs .nav-link.active {
        color: #6b4226;
        font-weight: bold;
        border-bottom: 3px solid #8b5d33;
        background-color: transparent;
    }
    
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #8b5d33;
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    .page-item.active .page-link {
        background-color: #8b5d33;
        border-color: #8b5d33;
    }
    
    .page-link {
        color: #6b4226;
    }
    
    .page-link:focus {
        box-shadow: 0 0 0 0.25rem rgba(107, 66, 38, 0.25);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get tab from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        
        // Activate tab if specified in URL
        if (tab) {
            const tabToShow = document.getElementById(tab + '-tab');
            if (tabToShow) {
                const tabTrigger = new bootstrap.Tab(tabToShow);
                tabTrigger.show();
            }
        }
        
        // Update URL when tab changes
        const tabs = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                const targetId = event.target.id.replace('-tab', '');
                const currentUrl = new URL(window.location);
                currentUrl.searchParams.set('tab', targetId);
                history.pushState({}, '', currentUrl);
            });
        });
    });
</script>
@endsection