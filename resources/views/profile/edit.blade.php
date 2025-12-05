@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
            <p class="text-gray-600 mt-2">Kelola informasi akun Anda</p>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Update Profile Information --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-orange-900 to-amber-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Profil
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', Auth::user()->name) }}" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', Auth::user()->email) }}" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                                   required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password Saat Ini <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror"
                                   placeholder="Masukkan password untuk konfirmasi perubahan"
                                   required>
                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Wajib diisi untuk keamanan perubahan data
                            </p>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-gradient-to-r from-amber-600 to-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-amber-900 to-amber-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Ubah Password
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="current_password_change" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password Saat Ini <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   id="current_password_change" 
                                   name="current_password" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror"
                                   required>
                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   id="new_password" 
                                   name="password" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                                   required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Minimal 6 karakter</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   required>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-gradient-to-r from-amber-700 to-amber-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-red-200">
            <div class="bg-gradient-to-r from-rose-900 to-amber-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Zona Berbahaya
                </h2>
            </div>
            <div class="p-6">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-red-800">Perhatian!</p>
                            <p class="text-sm text-red-700 mt-1">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan!')">
                    @csrf
                    @method('DELETE')

                    <div class="mb-6">
                        <label for="password_delete" class="block text-sm font-semibold text-gray-700 mb-2">
                            Masukkan Password untuk Konfirmasi <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password_delete" 
                               name="password" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                               placeholder="Masukkan password Anda"
                               required>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-gradient-to-r from-amber-900 to-rose-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Akun Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection