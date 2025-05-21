@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Artikel</h1>
</div>

@if(session()->has('success'))
  <div class="alert alert-success col-lg-10" role="alert">
    {{ session('success') }}
  </div>
@endif

<div class="table-responsive col-lg-10">
    <a href="/dashboard/articles/create" class="btn btn-primary mb-3">Buat Artikel Baru</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">Status</th>
          <th scope="col">Tanggal Dibuat</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($articles as $article)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $article->title }}</td>
          <td>
            @if($article->published_at)
              <span class="badge bg-success">Published</span>
            @else
              <span class="badge bg-warning">Draft</span>
            @endif
          </td>
          <td>{{ $article->created_at->format('d M Y') }}</td>
          <td>
            <a href="/dashboard/articles/{{ $article->slug }}" class="badge bg-info"><i data-feather="eye"></i></a>
            <a href="/dashboard/articles/{{ $article->slug }}/edit" class="badge bg-warning"><i data-feather="edit"></i></a>
            <form action="/dashboard/articles/{{ $article->slug }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Yakin akan menghapus artikel ini?')"><i data-feather="x-circle"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection