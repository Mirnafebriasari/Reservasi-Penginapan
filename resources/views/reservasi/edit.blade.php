@extends('layouts.app')

@section('title', 'Edit Reservasi')

@section('content')
<div class="container mx-auto p-6">

    <div class="bg-[#5C3D2E] text-white p-6 rounded-xl shadow-lg mb-6">
        <h1 class="text-3xl font-bold">Edit Reservasi</h1>
        <p class="text-sm text-gray-200">Perbarui informasi reservasi tamu dengan mudah.</p>
    </div>

    <form action="{{ auth()->user()->hasRole('admin')
        ? route('admin.reservasi.update', $reservasi->id)
        : route('users.reservasi.update', $reservasi->id)
     }}" 
     method="POST"
     class="bg-[#F5ECE3] p-8 rounded-xl shadow-md border border-[#D9C5B2]">

        @csrf
        @method('PUT')

        {{-- Nama Tamu --}}
        <div class="mb-5">
            <label class="block font-semibold mb-1 text-[#5C3D2E]">Nama Tamu</label>
            <input type="text" 
                   name="nama_tamu" 
                   value="{{ old('nama_tamu', $reservasi->nama_tamu) }}"
                   class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
                   required>
        </div>

        {{-- Nomor WA --}}
        <div class="mb-5">
            <label class="block font-semibold mb-1 text-[#5C3D2E]">Nomor WhatsApp</label>
            <input type="text" 
                   name="nomor_wa" 
                   value="{{ old('nomor_wa', $reservasi->nomor_wa) }}"
                   placeholder="Contoh: 6281234567890"
                   class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
                   required>
        </div>

        {{-- Pilih Kamar --}}
        <div class="mb-5">
            <label class="block font-semibold mb-1 text-[#5C3D2E]">Kamar</label>
            <select name="kamar_id" 
                    class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
                    required>
                @foreach ($kamars as $kamar)
                    <option value="{{ $kamar->id }}" 
                        {{ (old('kamar_id', $reservasi->kamar_id) == $kamar->id) ? 'selected' : '' }}>
                        {{ $kamar->nama_kamar }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Check-in --}}
<div class="mb-5">
    <label class="block font-semibold mb-1 text-[#5C3D2E]">Tanggal Check-in</label>
    <input type="date" 
           name="check_in" 
           id="check_in"
           value="{{ old('check_in', $reservasi->tanggal_checkin) }}"
           min="{{ date('Y-m-d') }}"
           class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
           required>
</div>

{{-- Check-out --}}
<div class="mb-5">
    <label class="block font-semibold mb-1 text-[#5C3D2E]">Tanggal Check-out</label>
    <input type="date" 
           name="check_out" 
           id="check_out"
           value="{{ old('check_out', $reservasi->tanggal_checkout) }}"
           min="{{ old('check_in', $reservasi->tanggal_checkin) }}"
           class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
           required>
</div>

        {{-- Jumlah Tamu --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1 text-[#5C3D2E]">Jumlah Tamu</label>
            <input type="number" 
                   name="jumlah_tamu" 
                   value="{{ old('jumlah_tamu', $reservasi->jumlah_tamu) }}"
                   min="1"
                   class="w-full border border-[#A07555] p-3 rounded-lg focus:ring-2 focus:ring-[#A07555] focus:outline-none bg-white"
                   required>
        </div>

        {{-- Tombol Update --}}
        <button type="submit" 
                class="w-full bg-[#A07555] hover:bg-[#8A5F43] text-white font-semibold py-3 rounded-lg transition">
            Update Reservasi
        </button>

    </form>
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
