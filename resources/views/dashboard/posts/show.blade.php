@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back To All My Posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" oncLick="return confirm('Are you sure?')"><span data-feather="x"></span>Delete</button>
            </form>

            <div style="max-height: 400; overflow:hidden;">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @else
                    <img src="https://picsum.photos/1600/900" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @endif
            </div>
            
            <article class="my-3">
                <h5>{{ $post->provinsi }}</h5>
                <p>Kabupaten/Kota : {{ $post->kabupaten }}</p>
                <p>Jumlah Koleksi : {{ $post->jumlah_koleksi }}</p>
                <p>Jenis Pemilik : {{ $post->category->name }}</p>
                <p>Pemilik : {{ $post->pemilik }}</p>
                <p>Tipe Terakhir : {{ $post->tipe_terakhir }}</p>
                <p>Nomor Pendaftaran : {{ $post->nomor_pendaftaran }}</p>
                
            </article>
            </div>
    </div>
</div>
@endsection