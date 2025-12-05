<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory; // Trait untuk mendukung factory Laravel, berguna untuk testing dan seeding data

    // Daftar atribut yang boleh diisi secara massal (mass assignment)
    // Ini untuk mencegah mass assignment vulnerability dan memudahkan pengisian data saat create/update
    protected $fillable = [
        'nama_fasilitas', // Nama fasilitas, misal: "Kolam Renang"
        'deskripsi',      // Deskripsi fasilitas, bisa berupa teks panjang, nullable
        'foto',           // Nama file atau path foto fasilitas, nullable
    ];
}
