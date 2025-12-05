<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List user dengan fitur pencarian dan filter role
    public function index(Request $request)
    {
        $query = User::query()->with('roles'); // Eager load relasi roles (pakai Spatie Role)

        // Jika ada parameter pencarian, cari berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role user (admin atau user)
        if ($request->filled('role')) {
            $role = $request->input('role');
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        // Paginate hasil, dengan mempertahankan query string agar pagination tetap sesuai filter/search
        $users = $query->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // Form untuk menampilkan halaman tambah user baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        // Validasi input user baru, termasuk password konfirmasi dan role (harus admin atau user)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        // Buat user baru dengan password yang sudah di-hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign role menggunakan package Spatie
        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Form untuk edit user sudah ada pada method edit

    // Update data user
    public function update(Request $request, User $user)
    {
        // Validasi input, termasuk konfirmasi password lama untuk keamanan perubahan data
        $validated = $request->validate([
            'current_password' => 'required',
            'name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($user->id)], // Unique kecuali user yang sedang diupdate
            'password' => 'nullable|string|min:6|confirmed', // Password baru opsional
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        // Cek kecocokan password lama
        if (!Hash::check($request->current_password, $user->password)) {
            // Jika password lama salah, kembali dengan error dan data input tetap terisi
            return back()->withErrors(['current_password' => 'Password sekarang salah!'])->withInput();
        }

        // Update nama dan email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Jika password baru diisi, update password dengan hash baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update role user, ganti role lama dengan yang baru
        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Form edit user, menampilkan form dengan data user yang dipilih
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Hapus user dari database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    // Dashboard untuk user yang sedang login (bisa diisi data tambahan jika perlu)
    public function dashboard()
    {
        $user = auth()->user(); // Ambil user yang sedang login

        // Bisa tambahkan data lain misal statistik, notifikasi, dsb

        return view('users.dashboard', compact('user'));
    }
}
