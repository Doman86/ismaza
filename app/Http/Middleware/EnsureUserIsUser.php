<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsUser
{
    /**
     * Pastikan hanya user role 'user' (Ismaza) yang bisa mengakses halaman user.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->isAdmin()) {
            // Admin tidak perlu ke halaman user, arahkan ke dashboard-nya
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
