<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Daftar key konten yang bisa diubah lewat dashboard.
     */
    public const KEYS = [
        'site_title'    => ['label' => 'Judul Website',        'default' => 'For Ismaza'],
        'ismaza_name'   => ['label' => 'Nama (Ismaza)',        'default' => 'ISMAZA'],
        'hero_title'    => ['label' => 'Judul Hero',           'default' => 'Untuk Seseorang yang Istimewa'],
        'hero_subtitle' => ['label' => 'Subjudul Hero',        'default' => 'Sebuah tempat kecil yang dibuat dengan penuh perhatian.'],
        'gallery_title' => ['label' => 'Judul Galeri',         'default' => 'Galeri Kenangan'],
        'closing_text'  => ['label' => 'Teks Penutup',         'default' => 'Terima kasih sudah hadir di sini.'],
        'since_date'    => ['label' => 'Tanggal Penting (penghitung hari, YYYY-MM-DD — kosongkan untuk menyembunyikan)', 'default' => ''],
    ];

    /**
     * Tampilkan form pengaturan.
     */
    public function index()
    {
        $settings = [];
        foreach (self::KEYS as $key => $meta) {
            $settings[$key] = [
                'label'   => $meta['label'],
                'value'   => SiteSetting::get($key, $meta['default']),
                'default' => $meta['default'],
            ];
        }

        return view('admin.settings', ['settings' => $settings]);
    }

    /**
     * Simpan perubahan konten.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings'                          => ['required', 'array'],
            'settings.site_title'               => ['nullable', 'string', 'max:255'],
            'settings.ismaza_name'              => ['nullable', 'string', 'max:255'],
            'settings.hero_title'               => ['nullable', 'string', 'max:255'],
            'settings.hero_subtitle'            => ['nullable', 'string', 'max:255'],
            'settings.gallery_title'            => ['nullable', 'string', 'max:255'],
            'settings.closing_text'             => ['nullable', 'string', 'max:1000'],
            'settings.since_date'               => ['nullable', 'string', 'max:10'],
        ], [
            'settings.required' => 'Data pengaturan tidak valid.',
        ]);

        foreach (self::KEYS as $key => $meta) {
            $value = $validated['settings'][$key] ?? '';
            SiteSetting::set($key, $value !== '' ? $value : null);
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
