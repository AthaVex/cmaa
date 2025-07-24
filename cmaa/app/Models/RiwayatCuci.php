<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatCuci extends Model
{
    use HasFactory;

    protected $table = 'riwayat_cucis';

    protected $fillable = [
        'pelanggan_id',
        'waktu_cuci',
    ];

    protected $casts = [
        'waktu_cuci' => 'datetime',
    ];

    public $timestamps = false; // ⛔ Nonaktifkan timestamps

    // Relasi: RiwayatCuci milik satu pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
