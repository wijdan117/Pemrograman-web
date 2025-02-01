<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Barang::factory(10)->create();
    }    
    public function run()
    {
        Barang::create([
            'nama' => 'Barang Contoh',
            'deskripsi' => 'Deskripsi barang',
            'harga_awal' => 100000,
            'tanggal_mulai' => now(),
            'tanggal_akhir' => now()->addDays(5),
        ]);
    }
}
