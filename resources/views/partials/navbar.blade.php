<div class="header-container">
    <div class="logo-left">Jejak Museum</div>
    <div class="search-container">
        <form action="/search" method="GET" class="search-form">
            <div class="input-group">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Cari koleksi atau artikel..." 
                    name="search" 
                    value="{{ request('search') }}"
                >
                <button class="btn" type="submit" style="background-color: #8b5d33; color: white;">
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
        <li class="nav-item">
            <a class="nav-link {{ $active === 'articles' ? 'active' : '' }}" href="/articles">Artikel</a>
        </li>
        
        @auth
            <li class="dropdown-wrapper">
                <a href="#" class="dropdown-toggle">{{ auth()->user()->name }}</a>
                <ul class="dropdown-menu">
                    @can('is.admin')
                        <li><a href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                        @endcan
                    <li>
                        <a class="dropdown-item" href="{{ route('favorites.index') }}">
                        <i class="bi bi-star me-2"></i> Koleksi Favorit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('my.reviews') ? 'active' : '' }}" href="{{ route('my.reviews') }}">
                            <i class="bi bi-chat-square-text me-1"></i> Ulasan Saya
                        </a>
                    </li>
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