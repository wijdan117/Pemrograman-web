<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'barang_id',
        'user_id',
        'harga_penawaran',
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
