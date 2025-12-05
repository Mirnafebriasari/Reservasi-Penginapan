<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil pengguna.
     */
    public function edit()
    {
        // Tampilkan halaman edit profil
        return view('profile.edit');
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Email wajib, format email, unik kecuali milik user ini sendiri
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'required', // Password saat ini wajib untuk keamanan
        ], [
            // Pesan error kustom
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'current_password.required' => 'Password saat ini wajib diisi untuk keamanan.',
        ]);

        // Cek kecocokan password saat ini dengan yang diinput user
        if (!Hash::check($request->current_password, $user->password)) {
            // Jika tidak cocok, kembali ke form dengan error
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
        }

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input password
        $validated = $request->validate([
            'current_password' => 'required', // Password lama wajib
            'password' => 'required|string|min:6|confirmed', // Password baru wajib, minimal 6 karakter, harus dikonfirmasi
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            // Jika password lama salah, kembali ke form dengan error
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Update password dengan yang baru (hashed)
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input password untuk konfirmasi penghapusan akun
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Password wajib diisi untuk menghapus akun.',
        ]);

        // Verifikasi password
        if (!Hash::check($request->password, $user->password)) {
            // Jika password salah, kembali dengan error
            return back()->withErrors(['password' => 'Password tidak sesuai.']);
        }

        // Logout user
        Auth::logout();
        
        // Invalidasi sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Hapus data user dari database
        $user->delete();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun Anda telah dihapus.');
    }
}
