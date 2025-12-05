@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-amber-900 mb-2">Daftar Kamar</h1>
                    <p class="text-amber-700">Kelola semua kamar hotel Anda</p>
                </div>

                <a href="{{ route('admin.kamar.create') }}" 
                   class="mt-4 sm:mt-0 inline-flex items-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kamar
                </a>
            </div>
        </div>

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

        <!-- Search Section -->
        <div class="mb-6 bg-white rounded-xl shadow-lg p-6 border border-amber-100">
            <div class="relative">
                <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Cari berdasarkan nama kamar, harga, atau deskripsi..." 
                    class="w-full pl-12 pr-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                >
            </div>

            <!-- Results Counter -->
            <div class="mt-4 text-sm text-amber-700">
                Menampilkan <span id="resultCount" class="font-semibold">{{ $kamars->count() }}</span> dari {{ $kamars->count() }} kamar
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-amber-100">
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                    ID
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Nama Kamar
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Harga
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                    Deskripsi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-100" id="kamarTableBody">
                        @forelse ($kamars as $kamar)
                        <tr class="kamar-row hover:bg-amber-50 transition-colors duration-200"
                            data-search="{{ strtolower($kamar->nama_kamar) }} {{ strtolower($kamar->deskripsi ?? '') }} {{ $kamar->harga }}">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">
                                    {{ $kamar->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold mr-3 shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <span class="text-amber-900 font-semibold">{{ $kamar->nama_kamar }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'tersedia' => 'bg-green-100 text-green-800 border-green-300',
                                        'terisi' => 'bg-red-100 text-red-800 border-red-300',
                                        'maintenance' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                    ];
                                    $statusColor = $statusColors[$kamar->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                                    @if($kamar->status === 'tersedia')
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @elseif($kamar->status === 'terisi')
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($kamar->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-amber-900 font-bold text-lg">
                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                </span>
                                <span class="text-amber-600 text-xs block mt-1">per malam</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-amber-800 text-sm max-w-xs truncate" title="{{ $kamar->deskripsi }}">
                                    {{ $kamar->deskripsi ?? '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.kamar.edit', $kamar->id) }}"
                                       class="inline-flex items-center bg-amber-500 px-3 py-2 rounded-lg text-white hover:bg-amber-600 transition-colors duration-200 text-sm font-medium shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center bg-red-600 px-3 py-2 rounded-lg text-white hover:bg-red-700 transition-colors duration-200 text-sm font-medium shadow-md">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <p class="text-amber-800 font-medium text-lg">Belum ada data kamar</p>
                                <p class="text-amber-600 mt-1">Tambahkan kamar baru untuk memulai</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- No Results Message for Desktop -->
                <div id="noResultsDesktop" class="hidden px-6 py-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-amber-800 font-medium text-lg">Tidak ada kamar yang ditemukan</p>
                    <p class="text-amber-600 mt-1">Coba ubah kata kunci pencarian Anda</p>
                </div>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden p-4 space-y-4" id="mobileCardsContainer">
                @forelse($kamars as $kamar)
                @php
                    $statusColors = [
                        'tersedia' => 'bg-green-100 text-green-800 border-green-300',
                        'terisi' => 'bg-red-100 text-red-800 border-red-300',
                        'maintenance' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                    ];
                    $statusColor = $statusColors[$kamar->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                @endphp
                
                <div class="kamar-card bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-md border border-amber-100 overflow-hidden"
                     data-search="{{ strtolower($kamar->nama_kamar) }} {{ strtolower($kamar->deskripsi ?? '') }} {{ $kamar->harga }}">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-4 py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-30 flex items-center justify-center text-white font-bold mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">{{ $kamar->nama_kamar }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                            {{ ucfirst($kamar->status) }}
                        </span>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-amber-700 text-sm font-medium">ID Kamar:</span>
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">
                                {{ $kamar->id }}
                            </span>
                        </div>

                        <div class="border-t border-amber-100 pt-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-amber-700 text-sm font-medium">Harga:</span>
                                <div class="text-right">
                                    <span class="text-amber-900 font-bold text-lg">
                                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                    </span>
                                    <span class="text-amber-600 text-xs block">per malam</span>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-amber-100 pt-3">
                            <p class="text-amber-700 text-sm font-medium mb-1">Deskripsi:</p>
                            <p class="text-amber-800 text-sm">{{ $kamar->deskripsi ?? '-' }}</p>
                        </div>

                        <div class="flex gap-2 pt-2 border-t border-amber-100">
                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}"
                               class="flex-1 inline-flex items-center justify-center bg-amber-500 px-3 py-2 rounded-lg text-white hover:bg-amber-600 transition-colors duration-200 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" 
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center bg-red-600 px-3 py-2 rounded-lg text-white hover:bg-red-700 transition-colors duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12" id="emptyCardMobile">
                    <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <p class="text-amber-800 font-medium text-lg">Belum ada data kamar</p>
                    <p class="text-amber-600 mt-1">Tambahkan kamar baru untuk memulai</p>
                </div>
                @endforelse

                <!-- No Results Message for Mobile -->
                <div id="noResultsMobile" class="hidden text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-amber-800 font-medium text-lg">Tidak ada kamar yang ditemukan</p>
                    <p class="text-amber-600 mt-1">Coba ubah kata kunci pencarian Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const kamarRows = document.querySelectorAll('.kamar-row');
    const kamarCards = document.querySelectorAll('.kamar-card');
    const noResultsDesktop = document.getElementById('noResultsDesktop');
    const noResultsMobile = document.getElementById('noResultsMobile');
    const resultCount = document.getElementById('resultCount');
    const kamarTableBody = document.getElementById('kamarTableBody');

    function filterKamars() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        // Filter Desktop Rows
        kamarRows.forEach(row => {
            const searchData = row.dataset.search;
            
            if (searchData.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Filter Mobile Cards
        kamarCards.forEach(card => {
            const searchData = card.dataset.search;
            
            if (searchData.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });

        // Update result count
        resultCount.textContent = visibleCount;

        // Show/hide no results message for mobile
        if (kamarCards.length > 0) {
            const visibleCards = Array.from(kamarCards).filter(card => card.style.display !== 'none');
            if (visibleCards.length === 0) {
                noResultsMobile.classList.remove('hidden');
            } else {
                noResultsMobile.classList.add('hidden');
            }
        }
    }

    // Event listener
    if (searchInput) {
        searchInput.addEventListener('input', filterKamars);
    }
});
</script>
@endsection