<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = ['kode'];

    public function riwayatCuci()
    {
        return $this->hasMany(RiwayatCuci::class);
    }
}
