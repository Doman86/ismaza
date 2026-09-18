<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Login ADMIN: email + password.
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Hanya akun dengan role admin yang boleh masuk
        $credentials['role'] = User::ROLE_ADMIN;

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /**
     * Login ISMAZA: cukup username saja, tanpa password.
     * Case-insensitive: ISMAZA / Ismaza / ismaza dianggap sama.
     */
    public function ismazaLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
        ], [
            'username.required' => 'Username wajib diisi.',
        ]);

        $user = User::query()
            ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['username']))])
            ->where('role', User::ROLE_USER)
            ->first();

        if (! $user) {
            return back()
                ->withErrors(['username' => 'Username tidak ditemukan.'])
                ->onlyInput('username');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
