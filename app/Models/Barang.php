<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_awal',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
        'gambar',
        'is_sold',
    ];
    public function penawarans()
    {
        return $this->hasMany(Penawaran::class);
    }
        public function pemenang()
    {
        return $this->belongsTo(User::class, 'pemenang_id');
    }

}
