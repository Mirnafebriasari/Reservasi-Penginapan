@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50">
    
    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        {{-- Welcome Hero Section --}}
        <div class="relative overflow-hidden bg-white bg-opacity-30 backdrop-blur-md rounded-3xl p-8 md:p-12 mb-8 shadow-2xl">

            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-black mb-3">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>
                <p class="text-amber-700 text-lg max-w-2xl">
                    Kelola reservasi penginapan Anda dengan mudah dan cepat. Nikmati pengalaman menginap yang tak terlupakan!
                </p>
            </div>
            {{-- Decorative circles --}}
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        {{-- Quick Action Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            
            {{-- Card 1: Lihat Fasilitas --}}
            <a href="{{ route('users.fasilitas.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Lihat Fasilitas</h3>
                    <p class="text-gray-600 text-sm">Jelajahi kamar dan fasilitas yang tersedia</p>
                </div>
            </a>

            {{-- Card 2: Buat Reservasi --}}
            <a href="{{ route('users.reservasi.create') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-600 to-amber-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Buat Reservasi</h3>
                    <p class="text-gray-600 text-sm">Pesan kamar untuk tanggal Anda</p>
                </div>
            </a>

            {{-- Card 3: Reservasi Saya --}}
            <a href="{{ route('users.reservasi.my') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Reservasi Saya</h3>
                    <p class="text-gray-600 text-sm">Lihat daftar reservasi Anda</p>
                </div>
            </a>

            {{-- Card 4: Status Pembayaran --}}
            <a href="{{ route('users.pembayaran.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-700 to-orange-800 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Status Pembayaran</h3>
                    <p class="text-gray-600 text-sm">Cek status pembayaran reservasi</p>
                </div>
            </a>

            {{-- Card 5: Edit Profil --}}
            <a href="{{ route('profile.edit') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-600 to-yellow-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Edit Profil</h3>
                    <p class="text-gray-600 text-sm">Kelola informasi akun Anda</p>
                </div>
            </a>

            {{-- Card 6: Dashboard --}}
            <a href="{{ url('/') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-700 to-amber-800 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Beranda</h3>
                    <p class="text-gray-600 text-sm">Kembali ke halaman utama</p>
                </div>
            </a>

        </div>

        {{-- Information Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            {{-- Panduan Card --}}
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-200 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Panduan Penggunaan</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-sm font-bold">1</span>
                        <span class="text-gray-700">Lihat fasilitas yang tersedia untuk mengetahui detail kamar</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-sm font-bold">2</span>
                        <span class="text-gray-700">Buat reservasi dengan memilih tanggal dan kamar yang diinginkan</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-sm font-bold">3</span>
                        <span class="text-gray-700">Lakukan pembayaran dan upload bukti transfer</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center text-sm font-bold">4</span>
                        <span class="text-gray-700">Pantau status pembayaran dan verifikasi dari admin</span>
                    </li>
                </ul>
            </div>

            {{-- Info Penting Card --}}
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-orange-200 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Informasi Penting</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <span class="text-orange-600 text-lg">•</span>
                        <span class="text-gray-700">Pastikan data reservasi yang Anda masukkan sudah benar</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-orange-600 text-lg">•</span>
                        <span class="text-gray-700">Upload bukti pembayaran segera setelah transfer</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-orange-600 text-lg">•</span>
                        <span class="text-gray-700">Cek status verifikasi pembayaran secara berkala</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-orange-600 text-lg">•</span>
                        <span class="text-gray-700">Hubungi admin jika ada kendala atau pertanyaan</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- CTA Section --}}
       <div class="bg-amber-900 bg-opacity-30 backdrop-blur-md rounded-3xl p-8 text-center shadow-2xl">
            <h3 class="text-2xl font-bold text-amber-900 mb-3">Siap Untuk Reservasi? </h3>
            <p class="text-orange-700 mb-6 max-w-2xl mx-auto">
                Jangan lewatkan kesempatan untuk menikmati pengalaman menginap yang nyaman dan berkesan di Penginapan Puncak Sari!
            </p>
            <a href="{{ route('users.reservasi.create') }}" 
               class="inline-block bg-white text-orange-700 font-bold px-8 py-3 rounded-full hover:bg-orange-50 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                Buat Reservasi Sekarang →
            </a>
        </div>

    </div>
</div>
@endsection