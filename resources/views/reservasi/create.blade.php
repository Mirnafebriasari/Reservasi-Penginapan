@extends('layouts.app')

@section('title', 'Buat Reservasi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-amber-900 mb-2">Buat Reservasi Baru</h1>
            <p class="text-amber-700">Isi formulir di bawah untuk melakukan reservasi</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-amber-100">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Informasi Reservasi</h2>
                <p class="text-amber-100 text-sm mt-1">Lengkapi data berikut dengan benar</p>
            </div>

            <form action="{{ auth()->user()->hasRole('admin') ? route('admin.reservasi.store') : route('users.reservasi.store') }}"
                  method="POST" 
                  class="px-8 py-8 space-y-6">
                @csrf

                <!-- Nama Tamu -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="nama_tamu">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nama Tamu
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="text" 
                           name="nama_tamu" 
                           id="nama_tamu" 
                           value="{{ old('nama_tamu') }}" 
                           required
                           placeholder="Masukkan nama lengkap"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('nama_tamu') border-red-400 @enderror">
                    @error('nama_tamu')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Pilih Kamar -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="kamar_id">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Pilih Kamar
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <select name="kamar_id" 
                            id="kamar_id" 
                            required
                            class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('kamar_id') border-red-400 @enderror">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach($kamars as $kamar)
                            <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                                {{ $kamar->nama_kamar }} - Rp {{ number_format($kamar->harga, 0, ',', '.') }}/malam
                            </option>
                        @endforeach
                    </select>
                    @error('kamar_id')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Check-in & Check-out -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Check-in -->
                    <div class="space-y-2">
                        <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="check_in">
                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Tanggal Check-in
                            <span class="text-red-600 ml-1">*</span>
                        </label>
                       <input type="date" 
       name="check_in" 
       id="check_in" 
       value="{{ old('check_in') }}" 
       required
       min="{{ date('Y-m-d') }}"
       class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('check_in') border-red-400 @enderror">

                        @error('check_in')
                            <p class="text-red-600 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Check-out -->
                    <div class="space-y-2">
                        <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="check_out">
                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Tanggal Check-out
                            <span class="text-red-600 ml-1">*</span>
                        </label>
                        <input type="date" 
                               name="check_out" 
                               id="check_out" 
                               value="{{ old('check_out') }}" 
                               required
                               class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('check_out') border-red-400 @enderror">
                        @error('check_out')
                            <p class="text-red-600 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Jumlah Tamu -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="jumlah_tamu">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Jumlah Tamu
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="number" 
                           name="jumlah_tamu" 
                           id="jumlah_tamu" 
                           value="{{ old('jumlah_tamu', 1) }}" 
                           min="1" 
                           required
                           placeholder="Masukkan jumlah tamu"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('jumlah_tamu') border-red-400 @enderror">
                    @error('jumlah_tamu')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Nomor WhatsApp -->
                <div class="space-y-2">
                    <label class="flex items-center text-amber-900 text-sm font-semibold mb-2" for="nomor_wa">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Nomor WhatsApp
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="text" 
                           name="nomor_wa" 
                           id="nomor_wa" 
                           value="{{ old('nomor_wa') }}" 
                           required
                           placeholder="Contoh: 6281234567890"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('nomor_wa') border-red-400 @enderror">
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Masukkan nomor dengan kode negara tanpa tanda +
                    </p>
                    @error('nomor_wa')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-amber-100">
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('users.dashboard') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-2 border-amber-300 rounded-xl text-amber-700 font-semibold hover:bg-amber-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Buat Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Saat user memilih check_in → otomatis set minimal check_out = check_in + 1 hari
    document.getElementById('check_in').addEventListener('change', function() {
        let checkInDate = new Date(this.value);
        if (isNaN(checkInDate)) return;

        // Tambah 1 hari untuk check-out
        let nextDay = new Date(checkInDate);
        nextDay.setDate(checkInDate.getDate() + 1);

        // Format ke Y-m-d
        let yyyy = nextDay.getFullYear();
        let mm = String(nextDay.getMonth() + 1).padStart(2, '0');
        let dd = String(nextDay.getDate()).padStart(2, '0');

        let formatted = `${yyyy}-${mm}-${dd}`;

        let checkOutInput = document.getElementById('check_out');

        checkOutInput.min = formatted;  // Minimal check-out
        checkOutInput.value = formatted; // Auto set jika kosong
    });
</script>

@endsection