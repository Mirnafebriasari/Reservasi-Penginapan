<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    // Method untuk menampilkan halaman dashboard utama
    // Halaman ini ditujukan untuk pengguna umum yang belum login
    public function index()
    {
        // Mengembalikan view 'welcome' yang biasanya halaman landing page atau homepage aplikasi
        return view('welcome');
    }
}
