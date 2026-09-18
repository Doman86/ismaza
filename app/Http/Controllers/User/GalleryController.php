<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\SiteSetting;

class GalleryController extends Controller
{
    /**
     * Halaman galeri khusus dengan layout grid modern + lightbox.
     */
    public function index()
    {
        return view('user.gallery', [
            'galleryTitle' => SiteSetting::get('gallery_title', 'Galeri Kenangan'),
            'photos'       => Photo::latest()->get(),
        ]);
    }
}
