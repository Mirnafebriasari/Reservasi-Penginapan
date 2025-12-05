@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-amber-900 mb-2">Tambah User Baru</h1>
            <p class="text-amber-700">Lengkapi informasi untuk menambahkan pengguna baru</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-amber-100">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Pengguna
                </h2>
                <p class="text-amber-100 text-sm mt-1">Isi semua data dengan lengkap dan benar</p>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="px-8 py-8 space-y-6">
                @csrf

                <!-- Nama -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nama Lengkap
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           required
                           placeholder="Masukkan nama lengkap"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Alamat Email
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required
                           placeholder="contoh@email.com"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Peran Pengguna
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <select name="role" 
                            required
                            class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('role') border-red-400 @enderror">
                        <option value="">-- Pilih Role --</option>
                        <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>
                            User
                        </option>
                        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-amber-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-amber-700 font-medium">Pengaturan Keamanan</span>
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="password" 
                           name="password"
                           required
                           placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('password') border-red-400 @enderror">
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal
                    </p>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Konfirmasi Password
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="password" 
                           name="password_confirmation"
                           required
                           placeholder="Ulangi password"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200">
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Password harus sama dengan password di atas
                    </p>
                </div>

                <!-- Info Box -->
                <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-amber-900 font-semibold mb-1">Informasi Penting</h3>
                            <ul class="text-amber-800 text-sm space-y-1">
                                <li>• Semua field dengan tanda (<span class="text-red-600">*</span>) wajib diisi</li>
                                <li>• Email harus unik dan belum terdaftar sebelumnya</li>
                                <li>• Password minimal 8 karakter</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-amber-100">
                    <a href="{{ route('admin.users.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-2 border-amber-300 rounded-xl text-amber-700 font-semibold hover:bg-amber-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection