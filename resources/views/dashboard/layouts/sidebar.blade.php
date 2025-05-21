<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse min-vh-100">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : 'text-dark' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : 'text-dark' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span> Koleksi Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/articles*') ? 'active' : 'text-dark' }}" href="/dashboard/articles">
                    <i data-feather="file-text"></i>
                    Artikel Post
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/reviews*') ? 'active' : 'text-dark' }}" href="{{ route('dashboard.reviews.index') }}">
                    <span data-feather="star"></span> Review Manager
                </a>
            </li>
        </ul>
    </div>
</nav>

