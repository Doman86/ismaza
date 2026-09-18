<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Contoh pesan — konten aslinya bisa ditentukan sendiri lewat dashboard admin.
     */
    public function run(): void
    {
        Message::query()->updateOrCreate(
            ['title' => 'Untuk Ismaza'],
            ['content' => 'Terima kasih sudah menjadi bagian dari cerita yang begitu berarti.']
        );
    }
}
