<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') &middot; For Ismaza</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>&#9881;</text></svg>">
</head>
<body class="admin-body">
    <nav class="topbar">
        <div class="topbar-inner">
            <a href="{{ route('admin.dashboard') }}" class="topbar-brand">For Ismaza &mdash; Admin</a>

            <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <div class="topbar-links" id="navLinks">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.photos.index') }}" class="{{ request()->routeIs('admin.photos.*') ? 'active' : '' }}">Foto</a>
                <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Pesan</a>
                <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">Pengaturan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    @include('partials.flash')

    <main class="admin-main">
        @yield('content')
    </main>

    <script src="{{ asset('assets/js/admin.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
