@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Daftar Pembayaran</h1>
                <p class="text-gray-600">Kelola dan pantau status pembayaran reservasi</p>
            </div>
            <div class="flex items-center space-x-2 bg-white px-4 py-3 rounded-lg shadow-md">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-right">
                    <p class="text-xs text-gray-500">Total Pembayaran</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pembayarans->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-lg shadow-sm flex items-center animate-fade-in">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search & Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Box -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pembayaran</label>
                <div class="relative">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Cari nama tamu, kamar, atau metode pembayaran..." 
                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                <select id="statusFilter" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Lunas</option>
                    <option value="failed">Gagal</option>
                </select>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-lg border border-yellow-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-800 text-sm font-medium">Pending</p>
                        <p class="text-2xl font-bold text-yellow-900" id="pendingCount">0</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-800 text-sm font-medium">Lunas</p>
                        <p class="text-2xl font-bold text-green-900" id="paidCount">0</p>
                    </div>
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg border border-red-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-800 text-sm font-medium">Gagal</p>
                        <p class="text-2xl font-bold text-red-900" id="failedCount">0</p>
                    </div>
                    <div class="w-12 h-12 bg-red-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="paymentTable">
                <thead>
                    <tr class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Nama Tamu</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Kamar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Metode</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Jumlah</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Bukti Transfer</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Bayar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($pembayarans as $pembayaran)
                    <tr class="hover:bg-gray-50 transition-colors duration-200" data-status="{{ $pembayaran->status }}">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>

                        {{-- Nama tamu --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center mr-3 shadow-md">
                                    <span class="text-white font-bold text-sm">
                                        {{ substr($pembayaran->reservasi->nama_tamu ?? '-', 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $pembayaran->reservasi->nama_tamu ?? '-' }}
                                </span>
                            </div>
                        </td>

                        {{-- Kamar --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border border-purple-300">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                {{ $pembayaran->reservasi->kamar->nama_kamar ?? '-' }}
                            </span>
                        </td>

                        {{-- Metode --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300 capitalize">
                                {{ $pembayaran->metode }}
                            </span>
                        </td>

                        {{-- Jumlah --}}
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'pending' => 'bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border-yellow-300',
                                    'paid' => 'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-300',
                                    'failed' => 'bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-300'
                                ];
                                $statusClass = $statusStyles[$pembayaran->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                            @endphp

                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold border {{ $statusClass }} capitalize shadow-sm">
                                @if($pembayaran->status === 'pending')
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @elseif($pembayaran->status === 'paid')
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @else
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                                {{ $pembayaran->status }}
                            </span>
                        </td>

                        {{-- Bukti --}}
                        <td class="px-6 py-4 text-sm">
                            @if($pembayaran->bukti_transfer)
                                <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" target="_blank" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium rounded-lg transition-all border border-blue-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada bukti</span>
                            @endif
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $pembayaran->created_at->format('d/m/Y') }}</span>
                                <span class="text-xs text-gray-500">{{ $pembayaran->created_at->format('H:i') }} WIB</span>
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-2">
                                {{-- ADMIN --}}
                                @if(auth()->user()->hasRole('admin'))
                                    {{-- Dropdown verifikasi --}}
                                    <form action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" 
                                                class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all bg-white"
                                                onchange="this.form.submit()">
                                            <option value="pending" {{ $pembayaran->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $pembayaran->status === 'paid' ? 'selected' : '' }}>Lunas</option>
                                            <option value="failed" {{ $pembayaran->status === 'failed' ? 'selected' : '' }}>Gagal</option>
                                        </select>
                                    </form>

                                    <div class="flex space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('pembayarans.edit', $pembayaran->id) }}"
                                           class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition shadow-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('pembayarans.destroy', $pembayaran->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?');"
                                              class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition shadow-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                {{-- USER --}}
                                @else
                                    <div class="flex space-x-2">

                                        {{-- Hapus --}}
                                        <form action="{{ route('pembayarans.destroy', $pembayaran->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data pembayaran ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="9" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-gray-500 text-lg">Belum ada pembayaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden px-6 py-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <p class="text-gray-500 text-lg">Tidak ada hasil yang ditemukan</p>
            <p class="text-gray-400 text-sm mt-2">Coba ubah kata kunci pencarian atau filter Anda</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.querySelector('#paymentTable tbody');
    const rows = tableBody.querySelectorAll('tr:not(#emptyRow)');
    const noResults = document.getElementById('noResults');
    const emptyRow = document.getElementById('emptyRow');

    // Update statistics
    function updateStats() {
        let pending = 0, paid = 0, failed = 0;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const status = row.getAttribute('data-status');
                if (status === 'pending') pending++;
                else if (status === 'paid') paid++;
                else if (status === 'failed') failed++;
            }
        });
        document.getElementById('pendingCount').textContent = pending;
        document.getElementById('paidCount').textContent = paid;
        document.getElementById('failedCount').textContent = failed;
    }

    // Filter function
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const status = row.getAttribute('data-status');
            
            const matchesSearch = text.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (emptyRow) emptyRow.style.display = 'none';
        if (visibleCount === 0 && rows.length > 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }

        updateStats();
    }

    // Event listeners
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Initial stats
    updateStats();
});
</script>

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
    animation: fade-in 0.3s ease-in-out;
}
</style>
@endsection