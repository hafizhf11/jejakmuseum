@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Create New Post</h1>
</div>

<div class="col-lg-8">
    <form method="post" action='/dashboard/posts' class="mb-5" enctype="multipart/form-data">
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Jenis Pemilik</label>
        <select class="form-select" name="category_id">
            @foreach($categories as $category)
            @if(old('category_id') == $category->id)
            <<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Post Image</label>
      <img class="img-preview img-fluid mb-3 col-sm-5" >
      <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
      @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="provinsi" class="form-label ">Provinsi</label>
        <input type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
        @error('provinsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="kabupaten" class="form-label">Kabupaten</label>
        <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
        @error('kabupaten')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="mb-3">
          <label for="jumlah_koleksi" class="form-label">Jumlah Koleksi</label>
          <input type="integer" class="form-control" id="jumlah_koleksi" name="jumlah_koleksi" value="{{ old('jumlah_koleksi') }}">
        </div>
        <div class="mb-3">
          <label for="pemilik" class="form-label">Pemilik</label>
          <input type="text" class="form-control" id="pemilik" name="pemilik" value="{{ old('pemilik') }}">
        </div>
        <div class="mb-3">
          <label for="tipe_terakhir" class="form-label">Tipe Terakhir</label>
          <input type="text" class="form-control" id="tipe_terakhir" name="tipe_terakhir" value="{{ old('tipe_terakhir') }}">
        </div>
        <div class="mb-3">
          <label for="nomor_pendaftaran" class="form-label">Nomor Pendaftaran</label>
          <input type="text" class="form-control" id="nomor_pendaftaran" name="nomor_pendaftaran" value="{{ old('nomor_pendaftaran') }}">
        </div>

        <!-- maps -->
        <div class="mb-3">
          <label for="maps_link" class="form-label">Link Google Maps</label>
          <input type="url" class="form-control @error('maps_link') is-invalid @enderror" 
                id="maps_link" name="maps_link" placeholder="https://maps.google.com/?q=..."
                value="{{ old('maps_link') }}">
          @error('maps_link')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
          <small class="text-muted">Format: https://maps.google.com/?q=Museum+Penerangan</small>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="text" class="form-control @error('latitude') is-invalid @enderror" 
                    id="latitude" name="latitude" placeholder="Contoh: -6.2088" 
                    value="{{ old('latitude') }}">
              @error('latitude')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                    id="longitude" name="longitude" placeholder="Contoh: 106.8456" 
                    value="{{ old('longitude') }}">
              @error('longitude')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Panduan untuk admin -->
        <div class="alert alert-info mb-4">
          <h5><i class="bi bi-info-circle"></i> Cara Mendapatkan Data Lokasi:</h5>
          <ol class="mb-0">
            <li>Buka <a href="https://maps.google.com" target="_blank" rel="noopener">Google Maps</a></li>
            <li>Cari lokasi museum</li>
            <li>Klik kanan pada lokasi dan pilih "Apa yang ada di sini?"</li>
            <li>Koordinat akan muncul di panel bawah (misalnya -6.2088, 106.8456)</li>
            <li>Untuk link, klik tombol "Bagikan" dan salin URL</li>
          </ol>
        </div>

      
      <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script>
    const title= document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
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