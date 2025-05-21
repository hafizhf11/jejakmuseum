@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Artikel</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/articles/{{ $article->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $article->title) }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $article->slug) }}">
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="excerpt" class="form-label">Ringkasan (Opsional)</label>
          <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt">{{ old('excerpt', $article->excerpt) }}</textarea>
          <small class="text-muted">Bisa dikosongkan, akan otomatis dibuat dari isi artikel.</small>
          @error('excerpt')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Gambar Artikel</label>
          <input type="hidden" name="oldImage" value="{{ $article->image }}">
          @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
          @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
          @endif
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Isi Artikel</label>
          @error('body')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body', $article->body) ?? ''}}">
          <trix-editor input="body"></trix-editor>
        </div>
        <div class="mb-3">
          <label class="form-label">Status Artikel</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="publish" value="published" {{ $article->published_at ? 'checked' : '' }}>
            <label class="form-check-label" for="publish">
              Publish
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="draft" value="draft" {{ !$article->published_at ? 'checked' : '' }}>
            <label class="form-check-label" for="draft">
              Draft
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Artikel</button>
    </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/articles/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection