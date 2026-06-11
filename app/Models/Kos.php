<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kos extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kos';

    // Kolom yang diizinkan untuk diisi (Mass Assignment Protection)
    protected $fillable = [
        'user_id',
        'nama_kos',
        'deskripsi',
        'harga_per_bulan',
        'alamat',
        'fasilitas',
        'kontak_pemilik',
        'foto',
        'link_gmaps',
    ];

    // Hubungan (Relasi): Setiap kos dimiliki oleh satu User (Pemilik)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}