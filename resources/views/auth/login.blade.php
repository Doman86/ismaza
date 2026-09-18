<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · For Ismaza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400;1,500&family=Great+Vibes&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>&#10084;</text></svg>">
</head>
<body class="user-body login-body">
    <div class="login-blob b1" aria-hidden="true"></div>
    <div class="login-blob b2" aria-hidden="true"></div>

    <main class="login-wrap">
        <div class="login-card">
            <p class="login-eyebrow">selamat datang</p>
            <h1 class="login-title">For Ismaza</h1>
            <p class="login-sub">masuk untuk melanjutkan</p>

            @include('partials.flash')

            {{-- Tab Ismaza / Admin --}}
            <div class="login-tabs" id="loginTabs">
                <button type="button" class="login-tab active" data-tab="ismaza">Ismaza</button>
                <button type="button" class="login-tab" data-tab="admin">Admin</button>
            </div>

            {{-- Form Ismaza: username saja --}}
            <form method="POST" action="{{ route('login.ismaza') }}" id="form-ismaza" class="login-form">
                @csrf
                <div class="field">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="ISMAZA"
                        autocomplete="off"
                        autofocus
                        required
                    >
                    @error('username')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-gold btn-block">Masuk</button>
            </form>

            {{-- Form Admin: email + password --}}
            <form method="POST" action="{{ route('login.admin') }}" id="form-admin" class="login-form" hidden>
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        autocomplete="username"
                        required
                    >
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <label class="checkbox">
                    <input type="checkbox" name="remember" value="1">
                    <span>Ingat saya</span>
                </label>

                <button type="submit" class="btn btn-gold btn-block">Masuk sebagai Admin</button>
            </form>
        </div>

        <p class="login-footnote">dibuat dengan penuh perhatian</p>
    </main>

    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</body>
</html>
