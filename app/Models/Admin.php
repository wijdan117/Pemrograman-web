<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function penawarans()
    {
        return $this->hasMany(Penawaran::class);
    }
}
