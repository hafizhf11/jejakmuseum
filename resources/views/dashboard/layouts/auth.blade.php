<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Authentication' }} | Jejak Museum Indonesia</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <style>
      body {
        min-height: 100vh;
        background: linear-gradient(135deg, #8B4513, #D2B48C);
        display: flex;
        align-items: center;
        padding: 20px 0;
      }
      
      .auth-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 0;
      }
      
      .auth-image {
        background-size: cover;
        background-position: center;
        min-height: 100%;
      }
      
      .auth-logo {
        margin-bottom: 30px;
        text-align: center;
      }
      
      .auth-logo img {
        max-height: 80px;
      }
      
      .auth-form {
        padding: 40px;
      }
      
      .form-floating {
        margin-bottom: 15px;
      }
      
      .auth-btn {
        background-color: #8B4513;
        border-color: #8B4513;
        padding: 12px;
        font-weight: 600;
        margin-top: 10px;
      }
      
      .auth-btn:hover {
        background-color: #6B3000;
        border-color: #6B3000;
      }
      
      .auth-link {
        color: #8B4513;
        text-decoration: none;
      }
      
      .auth-link:hover {
        color: #6B3000;
        text-decoration: underline;
      }
      
      .alert {
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <div class="card auth-card">
            <div class="row g-0">
              <div class="col-md-6 d-none d-md-block">
                <div class="auth-image h-100" style="background-image: url('{{ asset('img/museum-bg.jpg') }}');">
                </div>
              </div>
              <div class="col-md-6">
                <div class="auth-form">
                  <div class="auth-logo">
                    <a href="/">
                      <img src="{{ asset('img/logo.png') }}" alt="Jejak Museum Indonesia" class="img-fluid">
                    </a>
                  </div>
                  
                  @yield('auth-content')
                  
                  <div class="text-center mt-4">
                    <a href="/" class="auth-link"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>