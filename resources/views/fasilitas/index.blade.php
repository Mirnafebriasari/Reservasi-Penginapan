@extends('layouts.app')

@section('title', 'Daftar Fasilitas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50">
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-amber-800 to-orange-700 bg-clip-text text-transparent mb-2">✨ Daftar Fasilitas</h1>
                    <p class="text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Kelola dan lihat semua fasilitas penginapan
                    </p>
                </div>
                
                {{-- Tombol Tambah - Hanya untuk Admin --}}
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.fasilitas.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:from-amber-700 hover:to-orange-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Fasilitas
                    </a>
                @endif
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-md flex items-center animate-fade-in">
                <div class="bg-green-100 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Search Section --}}
        @if($fasilitas->count() > 0)
            <div class="mb-6 bg-white rounded-xl shadow-lg p-6 border border-amber-100">
                <div class="relative">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Cari fasilitas berdasarkan nama atau deskripsi..." 
                        class="w-full pl-12 pr-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                    >
                </div>

                {{-- Results Counter --}}
                <div class="mt-4 text-sm text-amber-700">
                    Menampilkan <span id="resultCount" class="font-semibold">{{ $fasilitas->count() }}</span> dari {{ $fasilitas->count() }} fasilitas
                </div>
            </div>
        @endif

        {{-- Facilities Grid --}}
        @if($fasilitas->count() > 0)
            <div id="fasilitasContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($fasilitas as $f)
                    <div class="fasilitas-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-amber-100"
                         data-search="{{ strtolower($f->nama_fasilitas) }} {{ strtolower($f->deskripsi ?? '') }}">
                        {{-- Image --}}
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-amber-100 to-orange-100">
                            @if($f->foto)
                                <img src="{{ asset('storage/fasilitas/' . $f->foto) }}" 
                                     alt="{{ $f->nama_fasilitas }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                {{-- Overlay on hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-20 h-20 text-amber-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-amber-400 text-sm font-medium">No Image</p>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Featured Badge --}}
                            <div class="absolute top-3 right-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Fasilitas
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <span class="mr-2"></span>
                                    {{ $f->nama_fasilitas }}
                                </h3>
                            </div>
                            
                            @if($f->deskripsi)
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">
                                    {{ $f->deskripsi }}
                                </p>
                            @else
                                <p class="text-gray-400 text-sm italic mb-4">Tidak ada deskripsi</p>
                            @endif

                            {{-- Divider --}}
                            <div class="border-t border-gray-100 my-4"></div>

                            {{-- Actions - Hanya untuk Admin --}}
                            @if(auth()->user()->hasRole('admin'))
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.fasilitas.edit', $f->id) }}" 
                                       class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 font-semibold rounded-lg hover:from-amber-200 hover:to-orange-200 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm(' Yakin ingin menghapus fasilitas {{ $f->nama_fasilitas }}?')"
                                          class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-100 to-red-200 text-red-700 font-semibold rounded-lg hover:from-red-200 hover:to-red-300 transition-all duration-200 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @else
                                {{-- Info untuk User --}}
                                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-lg p-3 flex items-center text-sm text-amber-800">
                                    <svg class="w-5 h-5 mr-2 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Tersedia untuk semua tamu</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- No Results Message --}}
            <div id="noResults" class="hidden bg-white rounded-2xl shadow-lg p-12 text-center border border-amber-100">
                <div class="bg-gradient-to-br from-amber-100 to-orange-100 w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-16 h-16 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Fasilitas Ditemukan</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">Tidak ada fasilitas yang sesuai dengan pencarian Anda. Coba ubah kata kunci pencarian.</p>
            </div>

            {{-- Pagination if needed --}}
            @if(method_exists($fasilitas, 'links'))
                <div class="mt-8">
                    {{ $fasilitas->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-amber-100">
                <div class="bg-gradient-to-br from-amber-100 to-orange-100 w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-16 h-16 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Fasilitas</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">Saat ini belum ada data fasilitas yang tersedia. Tambahkan fasilitas untuk meningkatkan pengalaman tamu Anda.</p>
                
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.fasilitas.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:from-amber-700 hover:to-orange-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Fasilitas Pertama
                    </a>
                @endif
            </div>
        @endif

        {{-- Info Card untuk User --}}
        @if(!auth()->user()->hasRole('admin') && $fasilitas->count() > 0)
            <div class="mt-8 bg-gradient-to-r from-amber-600 to-orange-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-start gap-4">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg mb-2 flex items-center">
                            <span class="mr-2"></span>
                            Informasi Fasilitas
                        </h3>
                        <p class="text-amber-50 text-sm leading-relaxed">
                            Semua fasilitas yang ditampilkan di atas tersedia untuk Anda gunakan selama menginap. 
                            Silakan hubungi resepsionis kami untuk informasi lebih lanjut tentang jam operasional dan tata cara penggunaan.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Statistics Card untuk Admin --}}
        @if(auth()->user()->hasRole('admin') && $fasilitas->count() > 0)
            <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 border border-amber-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-amber-100 to-orange-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Total Fasilitas</p>
                            <p class="text-2xl font-bold text-gray-900"><span id="totalCount">{{ $fasilitas->count() }}</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Terakhir diperbarui</p>
                        <p class="text-sm font-semibold text-amber-700">{{ now()->format('d M Y') }}</p>
                    </div>
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
    animation: fade-in 0.3s ease-out;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const fasilitasCards = document.querySelectorAll('.fasilitas-card');
    const noResults = document.getElementById('noResults');
    const resultCount = document.getElementById('resultCount');
    const fasilitasContainer = document.getElementById('fasilitasContainer');
    const totalCount = document.getElementById('totalCount');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            fasilitasCards.forEach(card => {
                const searchData = card.dataset.search;
                
                if (searchData.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update result count
            resultCount.textContent = visibleCount;
            if (totalCount) {
                // Update total count in statistics card for admin
                totalCount.textContent = visibleCount;
            }

            // Show/hide no results message
            if (visibleCount === 0) {
                fasilitasContainer.style.display = 'none';
                noResults.classList.remove('hidden');
            } else {
                fasilitasContainer.style.display = 'grid';
                noResults.classList.add('hidden');
            }
        });
    }
});
</script>
@endsection