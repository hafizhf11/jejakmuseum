<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="is-logged-in" content="true">
    @else
    <meta name="is-logged-in" content="false">
    @endauth
    <title>Jejak Museum Indonesia | {{ $title ?? 'Home' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- My Style -->
    <link rel="stylesheet" href="/css/styles.css">

    <!-- Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- CSS untuk notifikasi toast -->
    <style>
        .toast-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            z-index: 1000;
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .toast-notification.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        
        /* Styles untuk button favorit */
        .action-btn.favorite {
            background: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .action-btn.favorite:hover {
            transform: scale(1.1);
        }

        .action-btn.favorite i {
            color: #777;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .action-btn.favorite.active i {
            color: #FFD700;
        }
    </style>

    @yield('head')
  </head>
  <body>
    <div class="content-wrapper">
        <div class="hero-section">
            @include('partials.navbar')
            
            @if(isset($showHero) && $showHero)
            <div class="hero-banner" style="background-image: url('https://picsum.photos/1600/900');">
                <div class="hero-content">
                    <h1>Traces of the Indonesian Digital Museum</h1>
                    <p>Thousands of techniques, genres and media to explore</p>
                    <a href="#" class="more-button">More artworks <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            @endif
        </div>
        
        @yield('container')
    </div>

    <footer class="footer">
        <div class="container">
            <p>Jejak Museum Indonesia <a href="#" class="footer-link">Jamus</a>, by <a href="#" class="footer-link">@mdo</a>.</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Dropdown menu functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        // Handle click for desktop/mobile devices
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('.dropdown-wrapper');
                const menu = parent.querySelector('.dropdown-menu');
                
                // Close any other open dropdown menus
                document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
                    if (openMenu !== menu) {
                        openMenu.classList.remove('show');
                    }
                });
                
                // Toggle the clicked dropdown
                menu.classList.toggle('show');
            });
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-wrapper')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    });
    </script>
    
    <!-- Favorites functionality script -->
    <script src="{{ asset('js/favorites.js') }}"></script>
    
    <!-- Area untuk script khusus per halaman -->
    @yield('scripts')
  </body>
</html>