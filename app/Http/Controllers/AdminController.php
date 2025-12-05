<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Fasilitas;

class AdminController extends Controller
{
    // Method untuk menampilkan halaman dashboard admin
    public function dashboard()
    {
        // Menghitung total kamar yang tersedia
        $totalKamar = Kamar::count();
        // Menghitung total reservasi yang dibuat
        $totalReservasi = Reservasi::count();
        // Menghitung total user yang terdaftar
        $totalUser = User::count();
        // Menghitung total pembayaran yang tercatat
        $totalPembayaran = Pembayaran::count();
        // Menghitung total fasilitas yang tersedia
        $totalFasilitas = Fasilitas::count();

        // Menghitung jumlah reservasi dengan status 'pending'
        $pendingReservasi = Reservasi::where('status', 'pending')->count();
        // Menghitung jumlah reservasi dengan status 'approved'
        $approvedReservasi = Reservasi::where('status', 'approved')->count();
        // Menghitung jumlah reservasi dengan status 'rejected'
        $rejectedReservasi = Reservasi::where('status', 'rejected')->count();

        // Mengambil 5 data reservasi terbaru beserta relasi user dan kamar
        $recentReservasi = Reservasi::with(['user', 'kamar'])
            ->latest()
            ->take(5)
            ->get();

        // Mengirim data ke view admin.dashboard menggunakan compact
        return view('admin.dashboard', compact(
            'totalKamar',
            'totalReservasi',
            'totalUser',
            'totalPembayaran',
            'totalFasilitas',
            'pendingReservasi',
            'approvedReservasi',
            'rejectedReservasi',
            'recentReservasi' 
        ));
    }

    // Method untuk menampilkan halaman list reservasi untuk admin
    public function index()
    {
        // Mengambil semua reservasi beserta relasi kamar dan pembayaran
        $reservasis = Reservasi::with('kamar', 'pembayaran')->get();
        // Mengambil semua kamar
        $kamars = Kamar::all();

        // Mengirim data ke view reservasi.index menggunakan compact
        return view('reservasi.index', compact('reservasis', 'kamars'));
    }

    // Method untuk menyetujui reservasi berdasarkan ID
    public function approve($id)
    {
        // Mencari reservasi berdasarkan id, jika tidak ada akan gagal (throw 404)
        $reservasi = Reservasi::findOrFail($id);
        // Mengubah status reservasi menjadi 'approved'
        $reservasi->status = 'approved';
        // Menyimpan perubahan ke database
        $reservasi->save();

        // Redirect ke halaman reservasi.index dengan pesan sukses
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil disetujui.');
    }

    // Method untuk menolak reservasi berdasarkan ID
    public function reject($id)
    {
        // Mencari reservasi berdasarkan id, jika tidak ada akan gagal (throw 404)
        $reservasi = Reservasi::findOrFail($id);
        // Mengubah status reservasi menjadi 'rejected'
        $reservasi->status = 'rejected';
        // Menyimpan perubahan ke database
        $reservasi->save();

        // Redirect ke halaman reservasi.index dengan pesan sukses
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil ditolak.');
    }
}
