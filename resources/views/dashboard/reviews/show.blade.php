@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="mb-3">Detail Review</h1>

            <a href="{{ route('dashboard.reviews.index') }}" class="btn btn-success">
                <span data-feather="arrow-left"></span> Kembali ke Daftar Review
            </a>
            
            <form action="{{ route('dashboard.reviews.destroy', $review->id) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus review ini?')">
                    <span data-feather="trash-2"></span> Hapus Review
                </button>
            </form>
            
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Review untuk: {{ $review->post_title }}</h5>
                        <a href="{{ route('posts.show', $review->post_slug) }}" target="_blank">Lihat Koleksi</a>
                    </div>
                        <div>
                            @if($review->post_image)
                                <img src="{{ asset('storage/' . $review->post_image) }}" 
                                     alt="{{ $review->post_title }}" 
                                     style="max-height: 50px; max-width: 100px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6>Rating:</h6>
                    <div class="mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <span data-feather="star" class="text-warning"></span>
                            @else
                                <span data-feather="star"></span>
                            @endif
                        @endfor
                    </div>
                    
                    <h6>Komentar:</h6>
                    <div class="mb-3">
                        <p>{{ $review->comment }}</p>
                    </div>
                    
                    <h6>Informasi Reviewer:</h6>
                    <div class="mb-3">
                        <p><strong>Nama:</strong> {{ $review->user_name }}</p>
                        <p><strong>Email:</strong> {{ $review->user_email }}</p>
                    </div>
                    
                    <h6>Waktu Submit:</h6>
                    <p>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y H:i') }}</p>
                    
                    @if($review->created_at != $review->updated_at)
                    <p><small><em>Terakhir diedit: {{ \Carbon\Carbon::parse($review->updated_at)->format('d M Y H:i') }}</em></small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection