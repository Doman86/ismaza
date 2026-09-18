<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Pastikan hanya admin yang bisa mengakses area admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            // User biasa (Ismaza) yang mencoba masuk /admin/* diarahkan ke halamannya
            if ($user) {
                return redirect()->route('home');
            }

            // Belum login sama sekali -> ke halaman login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
