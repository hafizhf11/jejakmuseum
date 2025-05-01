@extends('dashboard.layouts.auth')

@section('auth-content')
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  
  @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <h2 class="text-center mb-4">Selamat Datang Kembali</h2>
  <p class="text-center text-muted mb-4">Silakan masuk untuk melanjutkan</p>

  <form action="/login" method="post">
    @csrf
    <div class="form-floating">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
             id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
      <label for="email"><i class="bi bi-envelope-fill me-1"></i> Alamat Email</label>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="form-floating">
      <input type="password" name="password" class="form-control" 
             id="password" placeholder="Password" required>
      <label for="password"><i class="bi bi-lock-fill me-1"></i> Kata Sandi</label>
    </div>
    
    <div class="d-grid gap-2">
      <button class="btn btn-primary auth-btn" type="submit">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
      </button>
    </div>
  </form>
  
  <div class="text-center mt-3">
    <p class="mb-0">Belum memiliki akun? <a href="/register" class="auth-link">Daftar Sekarang</a></p>
  </div>
@endsection