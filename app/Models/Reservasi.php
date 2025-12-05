<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel eksplisit jika tidak mengikuti konvensi Laravel (pluralisasi otomatis)
    protected $table = 'reservasis';

    // Atribut yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
        'user_id',           // ID user yang membuat reservasi (foreign key ke tabel users)
        'kamar_id',          // ID kamar yang dipesan (foreign key ke tabel kamars)
        'nama_tamu',         // Nama tamu yang melakukan reservasi
        'nomor_wa',          // Nomor WhatsApp tamu, untuk komunikasi/pemberitahuan
        'tanggal_checkin',   // Waktu check-in (datetime)
        'tanggal_checkout',  // Waktu check-out (datetime)
        'jumlah_tamu',       // Jumlah tamu yang menginap
        'total_harga',       // Total harga yang harus dibayar (decimal)
        'status'             // Status reservasi: pending, confirmed, cancelled, completed, dll
    ];

    // Casting otomatis kolom tertentu ke tipe data yang diinginkan saat diakses
    protected $casts = [
        'tanggal_checkin' => 'datetime',    // Cast tanggal_checkin ke objek Carbon (datetime)
        'tanggal_checkout' => 'datetime',   // Cast tanggal_checkout ke objek Carbon (datetime)
        'total_harga' => 'decimal:2'         // Cast total_harga ke decimal dengan 2 angka dibelakang koma
    ];

    /**
     * Relasi One-to-One ke model Pembayaran
     * Satu reservasi memiliki satu pembayaran terkait
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    /**
     * Relasi Many-to-One ke model Kamar
     * Satu reservasi dimiliki oleh satu kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    /**
     * Relasi Many-to-One ke model User
     * Satu reservasi dibuat oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
