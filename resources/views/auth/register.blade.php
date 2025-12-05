@extends('layouts.app')

@section('title', 'Register User')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 to-yellow-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        {{-- Card Container --}}
        <div class="bg-white rounded-2xl shadow-xl p-8">
            {{-- Header --}}
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900">
                    Daftar Akun Pengguna
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Buat akun baru untuk melanjutkan
                </p>
            </div>

            {{-- Info Box --}}
            <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-amber-800">
                        Form ini khusus untuk pendaftaran <span class="font-semibold">user biasa</span> (tamu).
                        Jika Anda admin, silakan daftar melalui halaman khusus admin.
                    </p>
                </div>
            </div>

            {{-- Register Form --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <input 
                        id="name"
                        type="text" 
                        name="name" 
                        required
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 border @error('name') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out @error('name') bg-red-50 @endif"
                        placeholder="Masukkan nama lengkap Anda"
                    >
                    @error('name')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        id="email"
                        type="email" 
                        name="email" 
                        required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out @error('email') bg-red-50 @endif"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        id="password"
                        type="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 border @error('password') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out @error('password') bg-red-50 @endif"
                        placeholder="Minimal 8 karakter"
                    >
                    @error('password')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <input 
                        id="password_confirmation"
                        type="password" 
                        name="password_confirmation" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent transition duration-200 ease-in-out"
                        placeholder="Ulangi password Anda"
                    >
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit"
                    class="w-full bg-amber-700 text-white font-semibold py-3 px-4 rounded-lg hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2 transform transition duration-150 ease-in-out hover:scale-[1.02] active:scale-[0.98] mt-6"
                >
                    Daftar Sekarang
                </button>

                {{-- Login Link --}}
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-amber-700 hover:text-amber-800 transition duration-150">
                            Login di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection