@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-block">
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-800 to-orange-700 mb-2">
                    Detail Reservasi
                </h1>
                <div class="h-1 w-24 bg-gradient-to-r from-amber-600 to-orange-600 mx-auto rounded-full"></div>
            </div>
            <p class="text-amber-700 mt-3">Informasi lengkap reservasi Anda</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-amber-200">
            
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-amber-700 via-amber-800 to-orange-800 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="text-white">
                            <p class="text-sm text-amber-100 font-medium">ID Reservasi</p>
                            <p class="text-2xl font-bold">#{{ $reservasi->id }}</p>
                        </div>
                    </div>
                    <span class="px-5 py-2 rounded-full text-sm font-bold shadow-lg
                        {{ $reservasi->status == 'pending' ? 'bg-yellow-400 text-yellow-900' : 
                           ($reservasi->status == 'approved' ? 'bg-green-400 text-green-900' : 
                           ($reservasi->status == 'rejected' ? 'bg-red-400 text-red-900' : 
                           'bg-gray-400 text-gray-900')) }}">
                        {{ strtoupper($reservasi->status) }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <div class="grid gap-6 md:grid-cols-2">
                    
                    <!-- Informasi Kamar -->
                    <div class="col-span-2 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-6 border-2 border-amber-200">
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-600 to-orange-700 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-amber-800 uppercase tracking-wide mb-1">Informasi Kamar</p>
                                <p class="text-2xl font-bold text-amber-900">{{ $reservasi->kamar->nama_kamar }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Check-in -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 border border-blue-200 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-blue-700 uppercase tracking-wide">Check-in</p>
                                <p class="text-lg font-bold text-blue-900">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->translatedFormat('d M Y,  H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Check-out -->
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-5 border border-purple-200 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-purple-700 uppercase tracking-wide">Check-out</p>
                                <p class="text-lg font-bold text-purple-900">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->translatedFormat('d M Y, H:i') }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <!-- Tampilkan waktu konfirmasi pembayaran jika ada -->
                    @if ($paymentConfirmedAt)
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-5 border border-yellow-300 mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-yellow-700 uppercase tracking-wide">Waktu Konfirmasi Pembayaran</p>
                                    <p class="text-lg font-bold text-yellow-900">
                                        {{ $paymentConfirmedAt->translatedFormat('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Tampilkan waktu checkout otomatis -->
                    @if ($checkoutOtomatis)
                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-5 border border-pink-300 mb-6 transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-pink-700 uppercase tracking-wide">Check-out Otomatis</p>
                                    <p class="text-lg font-bold text-pink-900">
                                        {{ $checkoutOtomatis->translatedFormat('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Durasi -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-5 border border-green-200 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-green-700 uppercase tracking-wide">Durasi</p>
                                <p class="text-lg font-bold text-green-900">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->diffInDays($reservasi->tanggal_checkout) }} Malam
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Tamu -->
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-5 border border-indigo-200 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-indigo-700 uppercase tracking-wide">Jumlah Tamu</p>
                                <p class="text-lg font-bold text-indigo-900">
                                    {{ $reservasi->jumlah_tamu }} Orang
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Biaya -->
                    <div class="col-span-2 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl p-6 border-2 border-amber-300 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-600 to-orange-700 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-amber-800 uppercase tracking-wide">Total Biaya</p>
                                    <p class="text-3xl font-extrabold text-amber-900">
                                        Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <svg class="w-16 h-16 text-amber-300 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Card Footer -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 px-8 py-6 border-t-2 border-amber-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 text-amber-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium">Reservasi dibuat pada {{ $reservasi->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                    <a href="{{ url()->previous() }}"
                       class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-700 to-orange-800 text-white rounded-xl hover:from-amber-800 hover:to-orange-900 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center text-sm text-amber-700">
            <p>Jika ada pertanyaan, hubungi customer service kami</p>
        </div>

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

.bg-white {
    animation: fade-in 0.5s ease-out;
}
</style>
@endsection