<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Konten default yang bisa diubah admin kapan saja dari dashboard.
     */
    public function run(): void
    {
        $defaults = [
            'site_title'    => 'For Ismaza',
            'ismaza_name'   => 'ISMAZA',
            'hero_title'    => 'Untuk Seseorang yang Istimewa',
            'hero_subtitle' => 'Sebuah tempat kecil yang dibuat dengan penuh perhatian.',
            'gallery_title' => 'Galeri Kenangan',
            'closing_text'  => 'Terima kasih sudah hadir di sini.',
            'since_date'    => '',  // isi mis: 2024-02-14 lewat dashboard untuk mengaktifkan penghitung hari
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
