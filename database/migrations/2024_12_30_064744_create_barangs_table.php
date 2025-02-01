<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama')->index(); // Nama barang dengan indeks
            $table->text('deskripsi')->nullable(); // Deskripsi barang (boleh kosong)
            $table->decimal('harga_awal', 15, 2); // Harga awal
            $table->date('tanggal_mulai'); // Tanggal mulai lelang
            $table->date('tanggal_akhir'); // Tanggal akhir lelang
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif'); // Status lelang
            $table->timestamps(); // Timestamps
        });
        Schema::table('barangs', function (Blueprint $table) {
            $table->boolean('is_sold')->default(false);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
