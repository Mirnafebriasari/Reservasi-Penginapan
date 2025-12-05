@extends('layouts.app')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 py-10">
    <div class="container mx-auto px-4">
        
        <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8 transform transition-all">
            
            <!-- Header -->
            <h1 class="text-3xl font-bold text-amber-800 mb-6 text-center">
                Tambah Fasilitas
            </h1>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-r-lg shadow-md">
                    <ul class="list-disc pl-6 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Nama Fasilitas -->
                <div>
                    <label for="nama_fasilitas" class="block font-semibold text-amber-900 mb-1">
                        Nama Fasilitas
                    </label>
                    <input type="text" id="nama_fasilitas" name="nama_fasilitas"
                        value="{{ old('nama_fasilitas') }}" required
                        class="w-full border border-amber-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none shadow-sm" />
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block font-semibold text-amber-900 mb-1">
                        Deskripsi (opsional)
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="w-full border border-amber-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none shadow-sm">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block font-semibold text-amber-900 mb-1">
                        Foto (opsional)
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                        file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-4">
                    <button type="submit"
                        class="bg-amber-700 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-amber-800 transition-all">
                        Simpan
                    </button>

                    <a href="{{ route('admin.fasilitas.index') }}"
                        class="text-amber-700 hover:underline font-medium">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
