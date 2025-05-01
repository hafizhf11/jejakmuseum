@extends('dashboard.layouts.auth')

@section('auth-content')
  <h2 class="text-center mb-4">Buat Akun Baru</h2>
  <p class="text-center text-muted mb-4">Silakan lengkapi data diri Anda</p>
  
  <form action="/register" method="post">
    @csrf
    <div class="form-floating">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
             id="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
      <label for="name"><i class="bi bi-person-fill me-1"></i> Nama Lengkap</label>
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="form-floating">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
             id="username" placeholder="Username" required value="{{ old('username') }}">
      <label for="username"><i class="bi bi-person-badge-fill me-1"></i> Username</label>
      @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="form-floating">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
             id="email" placeholder="name@example.com" required value="{{ old('email') }}">
      <label for="email"><i class="bi bi-envelope-fill me-1"></i> Alamat Email</label>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="form-floating">
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
             id="password" placeholder="Password" required>
      <label for="password"><i class="bi bi-lock-fill me-1"></i> Kata Sandi</label>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="d-grid gap-2">
      <button class="btn btn-primary auth-btn" type="submit">
        <i class="bi bi-person-plus-fill me-1"></i> Daftar
      </button>
    </div>
  </form>
  
  <div class="text-center mt-3">
    <p class="mb-0">Sudah memiliki akun? <a href="/login" class="auth-link">Masuk</a></p>
  </div>
@endsection