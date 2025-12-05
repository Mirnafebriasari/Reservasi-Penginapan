@extends('layouts.app')

@section('title', 'Edit Kamar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-amber-900 mb-2">Edit Kamar</h1>
            <div class="inline-flex items-center bg-white px-4 py-2 rounded-full shadow-md border border-amber-200">
                <svg class="w-5 h-5 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-amber-900 font-semibold">{{ $kamar->nama_kamar }}</span>
            </div>
        </div>

        <!-- Alert Error -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-r-lg shadow-md">
                <div class="flex items-start">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-amber-100">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Perbarui Informasi Kamar
                </h2>
                <p class="text-amber-100 text-sm mt-1">Ubah data kamar sesuai kebutuhan</p>
            </div>

            <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" class="px-8 py-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Info Box -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-blue-900 font-semibold mb-1">Data Saat Ini</h3>
                            <div class="text-blue-800 text-sm space-y-1">
                                <p>• Status: <span class="font-semibold">{{ ucfirst($kamar->status) }}</span></p>
                                <p>• Harga: <span class="font-semibold">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama Kamar -->
                <div class="space-y-2">
                    <label for="nama_kamar" class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Nama Kamar
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <input type="text" 
                           id="nama_kamar" 
                           name="nama_kamar" 
                           value="{{ old('nama_kamar', $kamar->nama_kamar) }}" 
                           required
                           placeholder="Contoh: Deluxe Room 101"
                           class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('nama_kamar') border-red-400 @enderror">
                    @error('nama_kamar')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Status Kamar
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <select id="status" 
                            name="status" 
                            required
                            class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('status') border-red-400 @enderror">
                        <option value="">-- Pilih Status --</option>
                        <option value="available" {{ old('status', $kamar->status) == 'available' ? 'selected' : '' }}>
                            Tersedia (Available)
                        </option>
                        <option value="booked" {{ old('status', $kamar->status) == 'booked' ? 'selected' : '' }}>
                            Terpesan (Booked)
                        </option>
                        <option value="maintenance" {{ old('status', $kamar->status) == 'maintenance' ? 'selected' : '' }}>
                            Maintenance
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="space-y-2">
                    <label for="harga" class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Harga per Malam
                        <span class="text-red-600 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-amber-700 font-semibold">
                            Rp
                        </span>
                        <input type="number" 
                               id="harga" 
                               name="harga" 
                               value="{{ old('harga', $kamar->harga) }}" 
                               required 
                               min="0"
                               placeholder="500000"
                               class="w-full pl-12 pr-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 @error('harga') border-red-400 @enderror">
                    </div>
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Masukkan harga dalam rupiah tanpa titik atau koma
                    </p>
                    @error('harga')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="flex items-center text-amber-900 text-sm font-semibold mb-2">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Deskripsi
                        <span class="text-amber-600 text-xs ml-2 font-normal">(Opsional)</span>
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              placeholder="Deskripsikan fasilitas dan keunggulan kamar ini..."
                              class="w-full px-4 py-3 border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all duration-200 resize-none @error('deskripsi') border-red-400 @enderror">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                    <p class="text-amber-600 text-xs mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Jelaskan fasilitas seperti AC, TV, WiFi, ukuran kasur, dll.
                    </p>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Warning Box -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-yellow-900 font-semibold mb-1">Perhatian</h3>
                            <ul class="text-yellow-800 text-sm space-y-1">
                                <li>• Pastikan data yang diubah sudah benar sebelum menyimpan</li>
                                <li>• Perubahan status akan mempengaruhi ketersediaan booking</li>
                                <li>• Perubahan harga akan berlaku untuk reservasi baru</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-amber-100">
                    <a href="{{ route('admin.kamar.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-2 border-amber-300 rounded-xl text-amber-700 font-semibold hover:bg-amber-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Kamar
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Log Info -->
        <div class="mt-6 bg-white rounded-xl shadow-md p-6 border border-amber-100">
            <h3 class="text-lg font-semibold text-amber-900 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Tips Mengedit Kamar
            </h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-amber-900 text-sm">Ubah Status dengan Bijak</p>
                        <p class="text-xs text-amber-700">Status kamar mempengaruhi sistem booking</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-amber-900 text-sm">Update Deskripsi Lengkap</p>
                        <p class="text-xs text-amber-700">Deskripsi detail meningkatkan minat tamu</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-amber-900 text-sm">Sesuaikan Harga Kompetitif</p>
                        <p class="text-xs text-amber-700">Harga yang wajar meningkatkan occupancy</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-amber-900 text-sm">Periksa Sebelum Simpan</p>
                        <p class="text-xs text-amber-700">Pastikan semua data sudah benar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection