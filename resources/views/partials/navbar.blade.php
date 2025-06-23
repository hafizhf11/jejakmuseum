<nav class="museum-navbar">
    <!-- Desktop & Mobile Header -->
    <div class="nav-header">
        <div class="brand">
            <a href="/">Jejak Museum <span>Indonesia</span></a>
        </div>
        
        <!-- Mobile Menu Button -->
        <button class="menu-toggle" aria-label="Toggle navigation">
            <span class="hamburger"></span>
        </button>
    </div>
    
    <!-- Navigation Container -->
    <div class="nav-container">
        <!-- Left Menu Links -->
        <ul class="nav-menu">
            <li><a class="{{ ($active === "home") ? 'active' : "" }}" href="/">Home</a></li>
            <li><a class="{{ ($active === "categories") ? 'active' : "" }}" href="/categories">Category</a></li>
            <li><a class="{{ ($active === "koleksi") ? 'active' : "" }}" href="/koleksi">Collection</a></li>
            <li><a class="{{ $active === 'articles' ? 'active' : '' }}" href="/articles">Artikel</a></li>
            <li><a class="{{ ($active === "about") ? 'active' : "" }}" href="/about">About</a></li>
        </ul>
        
        <!-- Right Side Items -->
        <div class="nav-right">
            <!-- Search Button - Toggles Search Panel -->
            <button class="search-toggle" aria-label="Toggle search">
                <i class="bi bi-search"></i>
            </button>
            
            <!-- Auth Menu -->
            <div class="auth-menu">
                @auth
                    <div class="user-dropdown">
                        <button class="dropdown-button">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            @can('is.admin')
                                <a href="/dashboard">
                                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                                    <span>My Dashboard</span>
                                </a>
                            @endcan
                            <a href="{{ route('favorites.index') }}">
                                <i class="bi bi-star"></i>
                                <span>Koleksi Favorit</span>
                            </a>
                            <a href="{{ route('my.reviews') }}">
                                <i class="bi bi-chat-square-text"></i>
                                <span>Ulasan Saya</span>
                            </a>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="login-button {{ ($active === "login") ? 'active' : "" }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Full-width Search Panel (Hidden by default) -->
    <div class="search-panel">
        <form action="/search" method="GET">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    placeholder="Cari koleksi atau artikel..." 
                    name="search" 
                    value="{{ request('search') }}"
                >
                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <button type="button" class="search-close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </form>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navContainer = document.querySelector('.nav-container');
    
    menuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        navContainer.classList.toggle('active');
        document.body.classList.toggle('menu-open');
    });
    
    // Search Toggle
    const searchToggle = document.querySelector('.search-toggle');
    const searchPanel = document.querySelector('.search-panel');
    const searchClose = document.querySelector('.search-close');
    
    searchToggle.addEventListener('click', function() {
        searchPanel.classList.toggle('active');
        searchPanel.querySelector('input').focus();
    });
    
    searchClose.addEventListener('click', function() {
        searchPanel.classList.remove('active');
    });
    
    // User Dropdown
    const dropdownButton = document.querySelector('.dropdown-button');
    
    if (dropdownButton) {
        dropdownButton.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('active');
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function closeDropdown(e) {
                if (!e.target.closest('.user-dropdown')) {
                    dropdown.classList.remove('active');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        });
    }
});
</script>