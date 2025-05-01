<div class="header-container">
    <div class="logo-left">Jejak Museum</div>
    <div class="search-container">
        <form action="/koleksi" method="GET" class="search-form">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="search-input-group">
                    <input type="text" placeholder="Search for artworks, artists..." class="search-input" name="search" value="{{ request('search') }}">
                    <button type="submit" class="search-button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
        </form>
    </div>
    <div class="logo-right">Indonesia</div>
</div>

<nav class="main-navigation">
    <ul>
        <li><a class="{{ ($active === "home") ? 'active' : "" }}" href="/">Home</a></li>
        <li><a class="{{ ($active === "koleksi") ? 'active' : "" }}" href="/koleksi">Collection</a></li>
        <li><a class="{{ ($active === "about") ? 'active' : "" }}" href="/about">About</a></li>
        <li><a class="{{ ($active === "categories") ? 'active' : "" }}" href="/categories">Category</a></li>
        
        @auth
            <li class="dropdown-wrapper">
                <a href="#" class="dropdown-toggle">{{ auth()->user()->name }}</a>
                <ul class="dropdown-menu">
                    @can('is.admin')
                        <li><a href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                        @endcan
                    <li><a class="dropdown-item" href="{{ route('favorites.index') }}">
                        <i class="bi bi-star me-2"></i> Koleksi Favorit
                    </a></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        @else
            <li><a class="{{ ($active === "login") ? 'active' : "" }}" href="/login"><i class="bi bi-box-arrow-right"></i> Login</a></li>
        @endauth
    </ul>
</nav>