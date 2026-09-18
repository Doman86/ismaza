<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Jika sudah login, jangan tampilkan halaman login lagi.
     * Arahkan ke area sesuai role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            return $user->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return $next($request);
    }
}
