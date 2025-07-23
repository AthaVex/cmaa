<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatCuci extends Model
{
    protected $fillable = ['pelanggan_id', 'waktu_cuci'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
