@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50">
    
    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        {{-- Welcome Hero Section --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-amber-900 via-orange-900 to-yellow-900 rounded-3xl p-8 md:p-12 mb-8 shadow-2xl">
            <div class="relative z-10">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                            Dashboard Admin
                        </h1>
                        <p class="text-amber-200 text-lg">
                            Selamat datang kembali, <span class="font-semibold">{{ auth()->user()->name }}</span>
                        </p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl px-6 py-3 border border-amber-700/30">
                        <p class="text-amber-200 text-sm">Tanggal</p>
                        <p class="text-white font-bold text-lg">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            {{-- Decorative circles --}}
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- Total Pengguna --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">Total</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Jumlah Pengguna</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                <div class="mt-3 flex items-center text-sm text-amber-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="font-medium">Terdaftar</span>
                </div>
            </div>

            {{-- Total Reservasi --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-yellow-600 to-amber-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-yellow-700 bg-yellow-50 px-3 py-1 rounded-full border border-yellow-200">Total</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Total Reservasi</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalReservasi ?? 0 }}</p>
                <div class="mt-3 flex items-center text-sm text-yellow-700">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">Semua Waktu</span>
                </div>
            </div>

            {{-- Total Kamar --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-700 bg-orange-50 px-3 py-1 rounded-full border border-orange-200">Total</span>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-1">Jumlah Kamar</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalKamar ?? 0 }}</p>
                <div class="mt-3 flex items-center text-sm text-orange-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">Tersedia</span>
                </div>
            </div>

        </div>

        {{-- Quick Action Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- Kelola Pengguna --}}
            <a href="{{ route('admin.users.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-orange-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Kelola Pengguna</h3>
                    <p class="text-gray-600 text-sm">Manage user accounts</p>
                </div>
            </a>

            {{-- Semua Reservasi --}}
            <a href="{{ route('admin.reservasi.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-orange-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Semua Reservasi</h3>
                    <p class="text-gray-600 text-sm">Lihat semua booking</p>
                </div>
            </a>

            {{-- Data Kamar --}}
            <a href="{{ route('admin.kamar.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-red-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Data Kamar</h3>
                    <p class="text-gray-600 text-sm">Kelola informasi kamar</p>
                </div>
            </a>

            {{-- Verifikasi Pembayaran --}}
            <a href="{{ route('admin.pembayaran.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-yellow-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Verifikasi</h3>
                    <p class="text-gray-600 text-sm">Konfirmasi pembayaran</p>
                </div>
            </a>

        </div>

        {{-- Additional Menu Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            {{-- Daftar Fasilitas --}}
            <a href="{{ route('admin.fasilitas.index') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-100 to-amber-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Daftar Fasilitas</h3>
                            <p class="text-gray-600 text-sm">Kelola fasilitas penginapan</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-yellow-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

            {{-- Reservasi Saya --}}
            <a href="{{ route('admin.reservasi.my') }}" class="group">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-amber-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Reservasi Saya</h3>
                            <p class="text-gray-600 text-sm">Lihat reservasi pribadi</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-orange-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        {{-- Tabel Reservasi Terbaru --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-amber-900 via-orange-900 to-yellow-900 px-6 py-5">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Reservasi Terbaru
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-50 to-orange-50 border-b-2 border-amber-200">
                            <th class="px-6 py-4 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Nama Tamu</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Kamar</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recentReservasi ?? [] as $r)
                            <tr class="hover:bg-amber-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold mr-3 shadow-md">
                                            {{ substr($r->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ $r->user->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-700">{{ $r->kamar->nama_kamar ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center text-gray-700">
                                        <svg class="w-4 h-4 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusConfig = match(strtolower($r->status)) {
                                            'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-300'],
                                            'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'border' => 'border-amber-300'],
                                            'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-300'],
                                            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-300'],
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-20 h-20 text-amber-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">Belum ada reservasi terbaru</p>
                                        <p class="text-gray-400 text-sm mt-1">Reservasi akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection