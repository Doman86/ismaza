<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed seluruh data awal aplikasi.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            IsmazaUserSeeder::class,
            SiteSettingSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
