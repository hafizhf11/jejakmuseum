@extends('layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" style="color: #8b5d33;">Home</a></li>
                    <li class="breadcrumb-item"><a href="/articles" style="color: #8b5d33;">Artikel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                </ol>
            </nav>
            
            <!-- Article Header -->
            <header class="article-header mb-4">
                <h1 class="mb-3" style="color: #6b4226; font-weight: 600;">{{ $article->title }}</h1>
                <div class="d-flex align-items-center mb-4">
                    <div class="author-avatar me-3">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; color: #8b5d33;">
                            <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="article-meta">
                        <p class="mb-0" style="font-weight: 500; color: #333;">{{ $article->user->name }}</p>
                        <p class="text-muted mb-0"><small>{{ $article->published_at->format('d M Y') }}</small></p>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($article->image)
            <div class="article-featured-image mb-4">
                <div class="rounded-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                </div>
            </div>
            @endif

            <!-- Article Content -->
            <div class="article-content bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4">
                <article class="fs-5 article-body">
                    {!! $article->body !!}
                </article>
            </div>
            
            <!-- Article Footer -->
            <div class="article-footer d-flex justify-content-between align-items-center mt-4 py-3 border-top">
                <a href="/articles" class="btn rounded-pill px-4" style="background-color: #8b5d33; color: white;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Artikel
                </a>
                <div class="article-share">
                    <span class="me-3 text-muted">Bagikan:</span>
                    <a href="#" class="me-2 text-decoration-none" style="color: #8b5d33;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="me-2 text-decoration-none" style="color: #8b5d33;">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="text-decoration-none" style="color: #8b5d33;">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <!-- Related Articles -->
            @if($relatedArticles->count())
            <div class="related-articles mt-5">
                <h4 class="mb-4" style="color: #6b4226;">Artikel Terkait</h4>
                <div class="row">
                    @foreach($relatedArticles as $relatedArticle)
                    <div class="col-md-4 mb-3">
                        <a href="/articles/{{ $relatedArticle->slug }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                @if($relatedArticle->image)
                                    <img src="{{ asset('storage/' . $relatedArticle->image) }}" class="card-img-top" alt="{{ $relatedArticle->title }}" style="height: 160px; object-fit: cover;">
                                @else
                                    <img src="https://source.unsplash.com/500x300?museum" class="card-img-top" alt="{{ $relatedArticle->title }}" style="height: 160px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #6b4226;">{{ $relatedArticle->title }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($relatedArticle->excerpt, 60) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .article-body {
        font-family: 'Georgia', serif;
        line-height: 1.8;
        color: #333;
    }
    
    .article-body h1, .article-body h2, .article-body h3,
    .article-body h4, .article-body h5, .article-body h6 {
        color: #6b4226;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .article-body p {
        margin-bottom: 1.5rem;
    }
    
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    .article-body a {
        color: #8b5d33;
        text-decoration: underline;
    }
    
    .article-body blockquote {
        border-left: 4px solid #8b5d33;
        padding-left: 1.5rem;
        font-style: italic;
        color: #666;
        margin: 1.5rem 0;
    }
    
    .article-body ul, .article-body ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
</style>
@endsection