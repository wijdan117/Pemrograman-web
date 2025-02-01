<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat admin default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com', // Ganti dengan email admin yang diinginkan
            'password' => bcrypt('admin'), // Ganti dengan password admin yang diinginkan
            'role' => 'admin', // Pastikan kolom role ada di tabel users
        ]);
    }
}
