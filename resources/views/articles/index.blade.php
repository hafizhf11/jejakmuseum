@extends('layouts.main')

@section('container')
<div class="container my-5">
    <h1 class='mb-2 text-center' style="color: #6b4226;">Artikel Museum Indonesia</h1>
    <p class="text-center text-muted mb-5">Jelajahi beragam artikel menarik tentang museum di Indonesia</p>

    <!-- <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari artikel..." name="search" value="{{ request('search') }}">
                <button class="btn" style="background-color: #8b5d33; color: white;" type="submit">Cari</button>
            </div>
        </div>
    </div> -->

    @if ($articles->count())
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="position-relative">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 240px; object-fit: cover;">
                        @else
                            <img src="https://source.unsplash.com/500x400?museum" class="card-img-top" alt="{{ $article->title }}" style="height: 240px; object-fit: cover;">
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
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold" style="color: #6b4226;">{{ $article->title }}</h5>
                        <p class="card-text text-muted mb-3">
                            <small>By: {{ $article->user->name }} · {{ $article->published_at->format('d M Y') }}</small>
                        </p>
                        <p class="card-text flex-grow-1">{{ $article->excerpt }}</p>
                        <div class="mt-3">
                            <a href="/articles/{{ $article->slug }}" class="text-decoration-none" style="color: #8b5d33;">
                                Jelajahi <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center my-5">
            <p class="fs-5 text-muted">Tidak menemukan artikel yang Anda cari?</p>
            <a href="/articles" class="btn btn-outline-secondary">Lihat Semua Artikel</a>
        </div>
    @endif
</div>
@endsection