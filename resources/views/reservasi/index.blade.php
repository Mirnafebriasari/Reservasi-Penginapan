@extends('layouts.app')

@section('title', 'Daftar Reservasi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-amber-100 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section with Enhanced Design -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-2">
                    <h1 class="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-amber-800 to-orange-700 bg-clip-text text-transparent">
                        Daftar Reservasi
                    </h1>
                    <p class="text-amber-700 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Kelola semua reservasi hotel Anda dengan mudah
                    </p>
                </div>

                @php
                    $createReservasiRoute = auth()->user()->hasRole('admin')
                        ? route('admin.reservasi.create')
                        : route('users.reservasi.create');
                @endphp

                <a href="{{ $createReservasiRoute }}" 
                   class="inline-flex items-center justify-center bg-gradient-to-r from-amber-600 via-amber-700 to-orange-600 hover:from-amber-700 hover:via-amber-800 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Reservasi Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-r-xl shadow-lg animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-amber-200">
            <form method="GET" action="{{ auth()->user()->hasRole('admin') ? route('admin.reservasi.index') : route('users.reservasi.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search by Name -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-amber-900 mb-2">Cari Nama Tamu</label>
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Masukkan nama tamu..."
                                   class="w-full pl-10 pr-4 py-2.5 border-2 border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                            <svg class="absolute left-3 top-3 w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Filter by Status -->
                    <div>
                        <label class="block text-sm font-semibold text-amber-900 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 border-2 border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Filter by Check-in Date -->
                    <div>
                        <label class="block text-sm font-semibold text-amber-900 mb-2">Tanggal Check-in</label>
                        <input type="date" 
                               name="checkin_date" 
                               value="{{ request('checkin_date') }}"
                               class="w-full px-4 py-2.5 border-2 border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    </div>

                    <!-- Filter by Room -->
                    <div>
                        <label class="block text-sm font-semibold text-amber-900 mb-2">Kamar</label>
                        <select name="kamar_id" class="w-full px-4 py-2.5 border-2 border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                            <option value="">Semua Kamar</option>
                            @if(isset($kamars))
                                @foreach($kamars as $kamar)
                                    <option value="{{ $kamar->id }}" {{ request('kamar_id') == $kamar->id ? 'selected' : '' }}>
                                        {{ $kamar->nama_kamar }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin.reservasi.index') : route('users.reservasi.index') }}" 
                       class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

      
        <!-- Table Section with Enhanced Design -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border-2 border-amber-200">
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-600 via-amber-700 to-orange-600 text-white">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Nama Tamu</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Kamar</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Check-out</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Jumlah Tamu</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-100">
                        @forelse($reservasis as $reservasi)
                        <tr class="hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 transition-all duration-200 group">
                            <td class="px-6 py-4 text-amber-900 font-bold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 via-amber-500 to-orange-600 flex items-center justify-center text-white font-bold mr-3 shadow-lg group-hover:scale-110 transition-transform">
                                        {{ strtoupper(substr($reservasi->nama_tamu, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="text-amber-900 font-semibold text-base">{{ $reservasi->nama_tamu }}</span>
                                        @if($reservasi->user)
                                        <p class="text-xs text-amber-600">{{ $reservasi->user->email }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center bg-amber-100 rounded-lg px-3 py-2 inline-flex">
                                    <svg class="w-5 h-5 mr-2 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <span class="text-amber-900 font-semibold">{{ $reservasi->kamar->nama_kamar ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-amber-800">
                                    <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-amber-800">
                                    <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-amber-100 to-orange-100 text-amber-900 text-sm font-bold shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    {{ $reservasi->jumlah_tamu }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide shadow-md
                                    @if($reservasi->status === 'pending') bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900
                                    @elseif($reservasi->status === 'confirmed') bg-gradient-to-r from-green-400 to-green-500 text-green-900
                                    @elseif($reservasi->status === 'cancelled') bg-gradient-to-r from-red-400 to-red-500 text-red-900
                                    @elseif($reservasi->status === 'completed') bg-gradient-to-r from-blue-400 to-blue-500 text-blue-900
                                    @else bg-gradient-to-r from-gray-400 to-gray-500 text-gray-900
                                    @endif">
                                    @if($reservasi->status === 'pending')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @elseif($reservasi->status === 'confirmed')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @elseif($reservasi->status === 'cancelled')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    @elseif($reservasi->status === 'completed')
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($reservasi->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}"
                                           class="inline-flex items-center bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2 rounded-lg text-white hover:from-amber-600 hover:to-amber-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                    @elseif(auth()->id() === $reservasi->user_id && $reservasi->status === 'pending')
                                        <a href="{{ route('users.reservasi.edit', $reservasi->id) }}"
                                           class="inline-flex items-center bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2 rounded-lg text-white hover:from-amber-600 hover:to-amber-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->id() === $reservasi->user_id && $reservasi->status === 'pending')
                                        <form action="{{ route('users.reservasi.cancel', $reservasi->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?');" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center bg-gradient-to-r from-orange-600 to-red-600 px-4 py-2 rounded-lg text-white hover:from-orange-700 hover:to-red-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif

                                    @if(auth()->user()->hasRole('admin'))
                                        <form action="{{ route('admin.reservasi.destroy', $reservasi->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus reservasi ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center bg-gradient-to-r from-red-600 to-red-700 px-4 py-2 rounded-lg text-white hover:from-red-700 hover:to-red-800 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gradient-to-br from-amber-100 to-orange-100 rounded-full p-6 mb-4">
                                        <svg class="w-20 h-20 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-amber-900 font-bold text-xl mb-2">Belum Ada Reservasi</p>
                                    <p class="text-amber-600 mb-6">Mulai buat reservasi untuk melihat daftar di sini</p>
                                    <a href="{{ $createReservasiRoute }}" 
                                       class="inline-flex items-center bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Buat Reservasi Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4">
                @forelse($reservasis as $reservasi)
                <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-lg border-2 border-amber-200 overflow-hidden transform hover:scale-102 transition-all">
                    <div class="bg-gradient-to-r from-amber-600 to-orange-600 px-4 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-white bg-opacity-30 flex items-center justify-center text-white font-bold mr-3">
                                    {{ strtoupper(substr($reservasi->nama_tamu, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="text-white font-bold text-lg">{{ $reservasi->nama_tamu }}</h3>
                                    <p class="text-amber-100 text-xs">Reservasi #{{ $loop->iteration }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if($reservasi->status === 'pending') bg-yellow-400 text-yellow-900
                                @elseif($reservasi->status === 'confirmed') bg-green-400 text-green-900
                                @elseif($reservasi->status === 'cancelled') bg-red-400 text-red-900
                                @elseif($reservasi->status === 'completed') bg-blue-400 text-blue-900
                                @else bg-gray-400 text-gray-900
                                @endif">
                                {{ ucfirst($reservasi->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <div class="flex items-center text-amber-800">
                            <svg class="w-5 h-5 mr-3 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <div>
                                <p class="text-xs text-amber-600 font-medium">Kamar</p>
                                <p class="font-semibold">{{ $reservasi->kamar->nama_kamar ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-start text-amber-800">
                                <svg class="w-5 h-5 mr-2 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-amber-600 font-medium">Check-in</p>
                                    <p class="font-semibold text-sm">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->format('d M Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start text-amber-800">
                                <svg class="w-5 h-5 mr-2 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-amber-600 font-medium">Check-out</p>
                                    <p class="font-semibold text-sm">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between pt-2 border-t border-amber-200">
                            <div class="flex items-center text-amber-800">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="font-semibold">{{ $reservasi->jumlah_tamu }} Tamu</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 pt-3">
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}"
                                   class="flex-1 inline-flex items-center justify-center bg-gradient-to-r from-amber-500 to-amber-600 px-3 py-2 rounded-lg text-white hover:from-amber-600 hover:to-amber-700 transition-all text-sm font-semibold shadow-md">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            @elseif(auth()->id() === $reservasi->user_id && $reservasi->status === 'pending')
                                <a href="{{ route('users.reservasi.edit', $reservasi->id) }}"
                                   class="flex-1 inline-flex items-center justify-center bg-gradient-to-r from-amber-500 to-amber-600 px-3 py-2 rounded-lg text-white hover:from-amber-600 hover:to-amber-700 transition-all text-sm font-semibold shadow-md">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            @endif

                            @if(auth()->id() === $reservasi->user_id && $reservasi->status === 'pending')
                                <form action="{{ route('users.reservasi.cancel', $reservasi->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?');" class="flex-1">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center bg-gradient-to-r from-orange-600 to-red-600 px-3 py-2 rounded-lg text-white hover:from-orange-700 hover:to-red-700 transition-all text-sm font-semibold shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Batalkan
                                    </button>
                                </form>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                                <form action="{{ route('admin.reservasi.destroy', $reservasi->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus reservasi ini?');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center bg-gradient-to-r from-red-600 to-red-700 px-3 py-2 rounded-lg text-white hover:from-red-700 hover:to-red-800 transition-all text-sm font-semibold shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-gradient-to-br from-amber-100 to-orange-100 rounded-full p-6 mb-4">
                            <svg class="w-20 h-20 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <p class="text-amber-900 font-bold text-xl mb-2">Belum Ada Reservasi</p>
                        <p class="text-amber-600 mb-6 px-4">Mulai buat reservasi untuk melihat daftar di sini</p>
                        <a href="{{ $createReservasiRoute }}" 
                           class="inline-flex items-center bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Reservasi Pertama
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($reservasis->hasPages())
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-lg border-2 border-amber-200 px-6 py-4">
                {{ $reservasis->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

.hover\:scale-102:hover {
    transform: scale(1.02);
}
</style>
@endsection