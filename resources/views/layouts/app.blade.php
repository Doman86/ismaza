<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'For Ismaza')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Great+Vibes&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>&#10084;</text></svg>">
</head>
<body class="user-body">
    {{-- Tirai pembuka --}}
    <div class="preloader" id="preloader" aria-hidden="true">
        <div class="preloader-name">{{ $siteTitle ?? 'For Ismaza' }}</div>
        <div class="preloader-sub">a place made with love</div>
        <div class="preloader-heart">&hearts;</div>
    </div>

    {{-- Hati bertaburan --}}
    <canvas class="heart-canvas" id="hearts" aria-hidden="true"></canvas>

    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">{{ $siteTitle ?? 'For Ismaza' }}</a>

            <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <div class="nav-links" id="navLinks">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Galeri</a>
                <a href="{{ route('messages') }}" class="{{ request()->routeIs('messages') ? 'active' : '' }}">Pesan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-logout">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    @include('partials.flash')

    <main class="page-main">
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} {{ $siteTitle ?? 'For Ismaza' }} &middot; every second with you is a gift</p>
    </footer>

    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
