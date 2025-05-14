@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Review Manager</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Koleksi</th>
                <th scope="col">User</th>
                <th scope="col">Rating</th>
                <th scope="col">Komentar</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ Str::limit($review->post_title, 30) }}</td>
                <td>{{ $review->user_name }}</td>
                <td>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            <span data-feather="star" class="text-warning"></span>
                        @else
                            <span data-feather="star"></span>
                        @endif
                    @endfor
                </td>
                <td>{{ Str::limit($review->comment, 50) }}</td>
                <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('dashboard.reviews.show', $review->id) }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <form action="{{ route('dashboard.reviews.destroy', $review->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Yakin ingin menghapus review ini?')">
                            <span data-feather="trash-2"></span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $reviews->links() }}
</div>

@endsection