@extends('dashboard.layouts.main')


@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h2 class="mb-3">{{ $article->title }}</h2>
            
            <a href="/dashboard/articles" class="btn btn-success"><i data-feather="arrow-left"></i> Kembali ke Daftar Artikel</a>
            <a href="/dashboard/articles/{{ $article->slug }}/edit" class="btn btn-warning"><i data-feather="edit"></i> Edit</a>
            <form action="/dashboard/articles/{{ $article->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Yakin akan menghapus artikel ini?')"><i data-feather="x-circle"></i> Delete</button>
            </form>
            
            <div class="mt-3">
                <span class="badge bg-{{ $article->published_at ? 'success' : 'warning' }}">
                    {{ $article->published_at ? 'Published: ' . Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'Draft' }}
                </span>
                <span class="badge bg-info">Penulis: {{ $article->user->name }}</span>
            </div>

            @if($article->image)
            <div class="mt-3">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid">
            </div>
            @endif

            <article class="my-3 fs-5">
                {!! $article->body !!}
            </article>
        </div>
    </div>
</div>
@endsection