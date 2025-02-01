<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->text,
            'harga_awal' => $this->faker->randomFloat(2, 100, 1000),
            'tanggal_mulai' => $this->faker->date,
            'tanggal_akhir' => $this->faker->date,
        ];
    }    
}
