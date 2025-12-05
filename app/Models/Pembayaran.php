<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory; // Mendukung fitur factory Laravel untuk testing dan seeding data

    // Atribut yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'reservasi_id',    // Foreign key ke tabel reservasi
        'metode',          // Metode pembayaran, misal 'transfer', 'cash', dll
        'jumlah',          // Jumlah pembayaran (integer)
        'status',          // Status pembayaran, misal 'pending', 'paid', 'failed'
        'bukti_transfer',  // Path file bukti transfer (nullable)
    ];

    // Relasi ke model Reservasi (Many-to-One)
    // Setiap pembayaran terkait dengan satu reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}
