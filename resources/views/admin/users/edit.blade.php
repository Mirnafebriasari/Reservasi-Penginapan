@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-amber-900 mb-2">Edit Pengguna</h1>
            <p class="text-amber-700 font-medium">Penginapan Puncak Sari</p>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-r-lg shadow-md animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Alert Error -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-r-lg shadow-md">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-amber-100">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Pengguna
                </h2>
                <p class="text-amber-100 text-sm mt-1">Perbarui data pengguna dengan hati-hati</p>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="px-8 py-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Security Section -->
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-red-900 font-semibold mb-1">Verifikasi Keamanan</h3>
                            <p class="text-red-800 text-sm">Masukkan password saat ini untuk memverifikasi identitas Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Password Sekarang -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password Sekarang
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="password" 
                           name="current_password" 
                           required
                           placeholder="Masukkan password saat ini"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-amber-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-amber-700 font-medium">Informasi Akun</span>
                    </div>
                </div>

                <!-- Nama -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nama Lengkap
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           placeholder="Masukkan nama lengkap"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Alamat Email
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           placeholder="contoh@email.com"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Peran Pengguna
                    </label>
                    <select name="role" 
                            class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                            Administrator
                        </option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                            Pengguna Biasa
                        </option>
                    </select>
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-amber-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-amber-700 font-medium">Ubah Password (Opsional)</span>
                    </div>
                </div>

                <!-- Password Baru -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Password Baru
                        <span class="text-amber-600 text-xs ml-2 font-normal">(Kosongkan jika tidak ingin mengubah)</span>
                    </label>
                    <input type="password" 
                           name="password"
                           placeholder="Masukkan password baru"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" 
                           name="password_confirmation"
                           placeholder="Ulangi password baru"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Password harus sama dengan password baru di atas
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-amber-100">
                    <a href="{{ route('admin.users.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-2 border-amber-300 rounded-xl text-amber-700 font-semibold hover:bg-amber-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Perbarui Pengguna
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-md">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-amber-900 font-semibold mb-1">Tips Keamanan</h3>
                    <ul class="text-amber-800 text-sm space-y-1">
                        <li>• Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol</li>
                        <li>• Jangan bagikan password kepada siapa pun</li>
                        <li>• Password minimal 8 karakter untuk keamanan optimal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection