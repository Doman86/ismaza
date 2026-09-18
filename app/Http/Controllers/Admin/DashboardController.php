<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Photo;

class DashboardController extends Controller
{
    /**
     * Dashboard admin: statistik sederhana.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'totalPhotos'    => Photo::count(),
            'totalMessages'  => Message::count(),
            'latestPhotos'   => Photo::latest()->take(4)->get(),
            'latestMessages' => Message::latest()->take(4)->get(),
        ]);
    }
}
