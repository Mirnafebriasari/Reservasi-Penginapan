<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory; // Mendukung factory Laravel untuk testing dan seeding data

    protected $table = 'kamars'; // Menentukan nama tabel secara eksplisit (defaultnya 'kamars')

    // Atribut yang bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'nama_kamar',  // Nama kamar, contoh: "Deluxe Room"
        'status',      // Status kamar, misal 'available', 'not_available'
        'harga',       // Harga kamar per malam (integer)
        'deskripsi',   // Deskripsi tambahan tentang kamar, nullable
    ];

    // Relasi one-to-many dengan model Reservasi
    // Satu kamar bisa memiliki banyak reservasi
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
