<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Menampilkan daftar semua kamar
    public function index()
    {
        $kamars = Kamar::all(); // Mengambil semua data kamar dari database
        return view('kamar.index', compact('kamars')); // Mengirim data ke view kamar.index
    }

    // Menampilkan form untuk menambah kamar baru
    public function create()
    {
        return view('kamar.create'); // Tampilkan halaman form create kamar
    }

    // Menyimpan data kamar baru ke database
    public function store(Request $request)
    {
        // Validasi input yang dikirimkan dari form
        $validated = $request->validate([
            'nama_kamar' => 'required|string|max:255', // Nama kamar wajib dan maksimal 255 karakter
            'status' => 'required|string',              // Status kamar wajib diisi
            'harga' => 'required|integer',              // Harga wajib dan berupa integer
            'deskripsi' => 'nullable|string',           // Deskripsi opsional
        ]);

        // Simpan data kamar yang sudah tervalidasi
        Kamar::create($validated);

        // Redirect ke halaman index kamar dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    // Menampilkan form edit kamar, menerima objek Kamar lewat route model binding
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar')); // Tampilkan form edit dengan data kamar yang dipilih
    }

    // Memproses update data kamar
    public function update(Request $request, Kamar $kamar)
    {
        // Validasi data input dari form update
        $validated = $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'status' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        // Update data kamar dengan data validasi
        $kamar->update($validated);

        // Redirect ke halaman index kamar dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    // Menghapus data kamar berdasarkan id
    public function destroy($id)
    {
        // Cari kamar berdasarkan id, jika tidak ditemukan akan error 404
        $kamar = \App\Models\Kamar::findOrFail($id);

        // Hapus data kamar dari database
        $kamar->delete();

        // Redirect ke halaman daftar kamar dengan pesan sukses
        return redirect()->route('admin.kamar.index')->with('success', 'Data kamar berhasil dihapus.');
    }
}
