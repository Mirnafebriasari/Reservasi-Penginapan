<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extends model untuk autentikasi bawaan Laravel
use Illuminate\Notifications\Notifiable;                 // Trait untuk fitur notifikasi
use Spatie\Permission\Traits\HasRoles;                   // Trait dari package Spatie untuk manajemen role dan permission (WAJIB jika menggunakan Spatie)
use Laravel\Sanctum\HasApiTokens;                        // Trait untuk API token (jika menggunakan Laravel Sanctum untuk API authentication)

class User extends Authenticatable
{
    // Menggunakan beberapa trait penting:
    // - HasApiTokens: untuk mendukung API token authentication (Sanctum)
    // - Notifiable: untuk kemampuan mengirim notifikasi ke user
    // - HasRoles: untuk mengelola roles dan permissions menggunakan package Spatie
    use HasApiTokens, Notifiable, HasRoles;

    // Field yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Field yang disembunyikan ketika model diubah menjadi array/JSON
    // Biasanya untuk menjaga kerahasiaan data sensitif
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
