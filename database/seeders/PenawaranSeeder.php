<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penawaran;
use App\Models\Barang;
use App\Models\User;

class PenawaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $barang = Barang::first(); // Ambil barang pertama
        $user = User::first();     // Ambil user pertama
    
        if ($barang && $user) {
            Penawaran::create([
                'barang_id' => $barang->id,
                'user_id' => $user->id,
                'harga_penawaran' => $barang->harga_awal + 10000,
            ]);
        }
    }
}


