<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MessagePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth (publik)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('login.admin');
    Route::post('/login/ismaza', [LoginController::class, 'ismazaLogin'])->name('login.ismaza');
});

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Area ISMAZA (role: user)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role.user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/messages', [MessagePageController::class, 'index'])->name('messages');

    // Halaman utama saat mengunjungi root domain
    Route::get('/', fn () => redirect()->route('login'))->name('welcome');
});

/*
|--------------------------------------------------------------------------
| Area ADMIN (role: admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role.admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD foto
        Route::resource('photos', PhotoController::class)->except(['show']);

        // CRUD pesan
        Route::resource('messages', MessageController::class)->except(['show']);

        // Pengaturan konten website
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
