@extends('layouts.app')

@section('title', 'Reservasi Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-amber-900 mb-2">Reservasi Saya</h1>
            <p class="text-amber-700">Kelola dan pantau reservasi Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-r-lg shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($reservasis->count() > 0)
            <!-- Search and Filter Section -->
            <div class="mb-6 bg-white rounded-xl shadow-lg p-6 border border-amber-100">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input 
                                type="text" 
                                id="searchInput" 
                                placeholder="Cari berdasarkan nama tamu, atau tanggal..." 
                                class="w-full pl-12 pr-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            >
                        </div>
                    </div>

                    <!-- Filter by Status -->
                    <div class="md:w-64">
                        <select id="statusFilter" class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <!-- Results Counter -->
                <div class="mt-4 text-sm text-amber-700">
                    Menampilkan <span id="resultCount" class="font-semibold">{{ $reservasis->count() }}</span> dari {{ $reservasis->count() }} reservasi
                </div>
            </div>

            <!-- Reservations Grid -->
            <div id="reservasiContainer" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($reservasis as $reservasi)
                    <div class="reservasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-amber-100" 
                         data-status="{{ $reservasi->status }}"
                         data-search="{{ strtolower($reservasi->kamar->nomor_kamar ?? '') }} {{ strtolower($reservasi->kamar->tipe ?? '') }} {{ strtolower($reservasi->nama_tamu ?? '') }} {{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->format('d-m-Y, H:i') }} {{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->format('d-m-Y, H:i') }}">
                        <!-- Header Card -->
                        <div class="bg-gradient-to-r from-amber-600 to-amber-700 p-4">
                            <div class="flex justify-between items-start">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">
                                        {{ $reservasi->kamar->nomor_kamar ?? '-' }}
                                    </h3>
                                    <p class="text-amber-100 text-sm font-medium">
                                        {{ $reservasi->kamar->tipe ?? '-' }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold shadow-md
                                    @if($reservasi->status === 'pending') bg-yellow-400 text-yellow-900
                                    @elseif($reservasi->status === 'approved') bg-green-400 text-green-900
                                    @elseif($reservasi->status === 'rejected') bg-red-400 text-red-900
                                    @else bg-blue-400 text-blue-900
                                    @endif">
                                    {{ ucfirst($reservasi->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="p-5 space-y-3">
                            <div class="flex items-center text-amber-900">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="font-semibold">{{ $reservasi->nama_tamu ?? '-' }}</span>
                            </div>

                            <div class="border-t border-amber-100 pt-3 space-y-2">
                                <div class="flex items-center text-sm text-amber-800">
                                    <svg class="w-4 h-4 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    <span class="font-medium">Check-in:</span>
                                    <span class="ml-2">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkin)->format('d-m-Y, H:i') }}</span>
                                </div>

                                <div class="flex items-center text-sm text-amber-800">
                                    <svg class="w-4 h-4 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span class="font-medium">Check-out:</span>
                                    <span class="ml-2">{{ \Carbon\Carbon::parse($reservasi->tanggal_checkout)->format('d-m-Y, H:i') }}</span>
                                </div>

                                <div class="flex items-center text-sm text-amber-800">
                                    <svg class="w-4 h-4 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="font-medium">Jumlah Tamu:</span>
                                    <span class="ml-2">{{ $reservasi->jumlah_tamu }} orang</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-4 space-y-2">
                                <a href="{{ route(auth()->user()->hasRole('admin')
                                    ? 'admin.reservasi.show'
                                    : 'users.reservasi.show', $reservasi->id) }}"
                                   class="block text-center bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2.5 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                   <span class="flex items-center justify-center">
                                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                       </svg>
                                       Lihat Detail
                                   </span>
                                </a>

                                @if($reservasi->status === 'pending')
                                    <a href="{{ route(auth()->user()->hasRole('admin')
                                        ? 'admin.reservasi.edit'
                                        : 'users.reservasi.edit', $reservasi->id) }}"
                                       class="block text-center bg-gradient-to-r from-amber-500 to-amber-600 text-white py-2.5 px-4 rounded-lg hover:from-amber-600 hover:to-amber-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                       <span class="flex items-center justify-center">
                                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                           </svg>
                                           Edit Reservasi
                                       </span>
                                    </a>

                                    <a href="{{ route(auth()->user()->hasRole('admin')
                                            ? 'admin.pembayaran.create'
                                            : 'users.pembayaran.create', $reservasi->id) }}"
                                       class="block text-center bg-gradient-to-r from-green-600 to-green-700 text-white py-2.5 px-4 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                       <span class="flex items-center justify-center">
                                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                           </svg>
                                           Bayar Sekarang
                                       </span>
                                    </a>

                                    <form action="{{ route(auth()->user()->hasRole('admin')
                                                ? 'admin.reservasi.cancel'
                                                : 'users.reservasi.cancel', $reservasi->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-2.5 px-4 rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 font-medium shadow-md hover:shadow-lg"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')">
                                            <span class="flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Batalkan Reservasi
                                            </span>
                                        </button>
                                    </form>
                                @endif

                                @if($reservasi->status === 'cancelled')
                                    <div class="pt-4">
                                        <form action="{{ route(auth()->user()->hasRole('admin')
                                                        ? 'admin.reservasi.destroy'
                                                        : 'users.reservasi.destroy', $reservasi->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus reservasi ini? Data tidak bisa dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-red-600 to-red-700 
                                                text-white py-2.5 px-4 rounded-lg 
                                                hover:from-red-700 hover:to-red-800 
                                                transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                                Hapus Reservasi
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden bg-white rounded-xl shadow-lg p-12 text-center border border-amber-100">
                <svg class="w-24 h-24 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <p class="text-xl text-amber-800 font-medium">Tidak ada reservasi yang ditemukan</p>
                <p class="text-amber-600 mt-2">Coba ubah kata kunci pencarian atau filter Anda</p>
            </div>

        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-amber-100">
                <svg class="w-24 h-24 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-xl text-amber-800 font-medium">Anda belum memiliki reservasi</p>
                <p class="text-amber-600 mt-2">Mulai pesan kamar untuk pengalaman menginap terbaik</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const reservasiCards = document.querySelectorAll('.reservasi-card');
    const noResults = document.getElementById('noResults');
    const resultCount = document.getElementById('resultCount');
    const reservasiContainer = document.getElementById('reservasiContainer');
    const totalReservations = {{ $reservasis->count() }};

    function filterReservations() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const statusValue = statusFilter.value.toLowerCase();
        let visibleCount = 0;

        reservasiCards.forEach(card => {
            const searchData = card.dataset.search;
            const cardStatus = card.dataset.status;
            
            const matchesSearch = searchData.includes(searchTerm);
            const matchesStatus = statusValue === '' || cardStatus === statusValue;
            
            if (matchesSearch && matchesStatus) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update result count
        resultCount.textContent = visibleCount;

        // Show/hide no results message
        if (visibleCount === 0) {
            reservasiContainer.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            reservasiContainer.style.display = 'grid';
            noResults.classList.add('hidden');
        }
    }

    // Event listeners
    if (searchInput) {
        searchInput.addEventListener('input', filterReservations);
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', filterReservations);
    }
});
</script>
@endsection