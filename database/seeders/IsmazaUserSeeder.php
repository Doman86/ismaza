<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class IsmazaUserSeeder extends Seeder
{
    /**
     * Akun khusus Ismaza.
     * Sengaja TIDAK menyimpan password apa pun (termasuk password palsu),
     * karena login hanya menggunakan username.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'ismaza@local'],
            [
                'name'     => 'ISMAZA',
                'password' => null,
                'role'     => User::ROLE_USER,
            ]
        );
    }
}
