<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FasilitasController extends Controller
{
    // Menampilkan semua data fasilitas
    public function index()
    {
        $fasilitas = Fasilitas::all(); // Mengambil semua data fasilitas dari database
        return view('fasilitas.index', compact('fasilitas')); // Menampilkan view dengan data fasilitas
    }

    // Menampilkan form untuk menambahkan fasilitas baru
    public function create()
    {
        return view('fasilitas.create'); // Menampilkan halaman form create fasilitas
    }

    // Menyimpan data fasilitas baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255', // Nama fasilitas wajib diisi, max 255 karakter
            'deskripsi' => 'nullable|string', // Deskripsi bersifat opsional
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto opsional, harus berupa gambar dan max 2MB
        ]);

        // Jika ada file foto yang diupload, simpan di storage dan simpan namanya
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName(); // Buat nama file unik dengan timestamp
            $file->storeAs('public/fasilitas', $filename); // Simpan file di folder public/fasilitas
            $validated['foto'] = $filename; // Tambahkan nama file ke data validasi
        }

        // Simpan data fasilitas baru ke database
        Fasilitas::create($validated);

        // Redirect ke halaman index fasilitas dengan pesan sukses
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    // Menampilkan form edit fasilitas berdasarkan id
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id); // Cari fasilitas berdasarkan id, error 404 jika tidak ditemukan
        return view('fasilitas.edit', compact('fasilitas')); // Tampilkan form edit dengan data fasilitas
    }

    // Memperbarui data fasilitas berdasarkan id
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id); // Cari fasilitas yang akan diupdate

        // Validasi input dari form update
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada file foto baru yang diupload, hapus file lama dan simpan file baru
        if ($request->hasFile('foto')) {
            if ($fasilitas->foto && Storage::exists('public/fasilitas/'.$fasilitas->foto)) {
                Storage::delete('public/fasilitas/'.$fasilitas->foto); // Hapus file foto lama jika ada
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName(); // Buat nama file unik
            $file->storeAs('public/fasilitas', $filename); // Simpan file baru
            $validated['foto'] = $filename; // Update nama file pada data validasi
        }

        // Update data fasilitas dengan data yang sudah tervalidasi
        $updated = $fasilitas->update($validated);

        // Redirect ke halaman index fasilitas dengan pesan sukses
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    // Menghapus data fasilitas berdasarkan id
    public function destroy($id)
    {
        \Log::info('Mencoba hapus fasilitas id: ' . $id); // Log info percobaan hapus fasilitas

        $fasilitas = Fasilitas::find($id); // Cari fasilitas berdasarkan id

        // Jika fasilitas tidak ditemukan, log dan kembalikan error
        if (!$fasilitas) {
            \Log::info('Fasilitas tidak ditemukan');
            return redirect()->back()->with('error', 'Fasilitas tidak ditemukan.');
        }

        // Jika fasilitas memiliki foto dan file tersebut ada, hapus file foto dari storage
        if ($fasilitas->foto && Storage::exists('public/fasilitas/' . $fasilitas->foto)) {
            Storage::delete('public/fasilitas/' . $fasilitas->foto);
        }

        // Hapus data fasilitas dari database
        $deleted = $fasilitas->delete();

        \Log::info("Hasil hapus: " . ($deleted ? 'Berhasil' : 'Gagal')); // Log hasil penghapusan

        // Redirect ke halaman index fasilitas dengan pesan sukses
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}
