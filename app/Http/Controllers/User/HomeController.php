<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Photo;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    /**
     * Halaman utama Ismaza: hero + galeri + pesan khusus + penutup.
     */
    public function index()
    {
        $sinceRaw = SiteSetting::get('since_date', '');
        $sinceDate = null;
        $daysTogether = 0;

        if ($sinceRaw && ($date = \Carbon\Carbon::make($sinceRaw))) {
            $sinceDate = $date;
            $daysTogether = max(0, (int) abs($date->startOfDay()->diffInDays(now())));
        }

        return view('user.home', [
            'siteTitle'    => SiteSetting::get('site_title', 'For Ismaza'),
            'ismazaName'   => SiteSetting::get('ismaza_name', 'ISMAZA'),
            'heroTitle'    => SiteSetting::get('hero_title', 'Untuk Seseorang yang Istimewa'),
            'heroSubtitle' => SiteSetting::get('hero_subtitle', 'Sebuah tempat kecil yang dibuat dengan penuh perhatian.'),
            'galleryTitle' => SiteSetting::get('gallery_title', 'Galeri Kenangan'),
            'closingText'  => SiteSetting::get('closing_text', 'Terima kasih sudah hadir di sini.'),
            'sinceDate'    => $sinceDate,
            'daysTogether' => $daysTogether,
            'photos'       => Photo::latest()->get(),
            'messages'     => Message::orderBy('created_at')->get(),
        ]);
    }
}
