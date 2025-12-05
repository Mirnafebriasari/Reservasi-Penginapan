@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah Pembayaran untuk Reservasi: {{ $reservasi->nama_tamu }}</h1>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan Error Umum --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pesan Error Validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{ 
    auth()->user()->hasRole('admin') 
    ? route('admin.pembayaran.store', $reservasi->id) 
    : route('users.pembayaran.store', $reservasi->id) 
}}"
 method="POST" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">

        <div class="mb-4">
            <label for="metode" class="block mb-1 font-semibold">Metode Pembayaran</label>
            <select name="metode" id="metode" class="w-full border border-gray-300 rounded px-3 py-2 @error('metode') border-red-500 @enderror" required>
                <option value="" disabled {{ old('metode') ? '' : 'selected' }}>-- Pilih Metode Pembayaran --</option>
                <option value="BRI" {{ old('metode') == 'BRI' ? 'selected' : '' }}>BRI</option>
                <option value="Mandiri" {{ old('metode') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                <option value="BCA" {{ old('metode') == 'BCA' ? 'selected' : '' }}>BCA</option>
                <option value="OVO" {{ old('metode') == 'OVO' ? 'selected' : '' }}>OVO</option>
                <option value="GoPay" {{ old('metode') == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                <option value="Tunai" {{ old('metode') == 'Tunai' ? 'selected' : '' }}>Bayar Tunai</option>
            </select>
            @error('metode')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p id="keterangan-rekening" class="mt-2 text-gray-700 text-sm"></p>
        </div>

        <div class="mb-4">
    <label for="jumlah" class="block mb-1 font-semibold">Jumlah Pembayaran (Rp)</label>
    <input type="number" 
           name="jumlah" 
           id="jumlah" 
           value="{{ $reservasi->total_harga }}" 
           readonly
           class="w-full border border-gray-300 bg-gray-100 rounded px-3 py-2" 
           required>
</div>


        <div class="mb-4">
            <label for="bukti" class="block mb-1 font-semibold">Upload Bukti Pembayaran (Opsional)</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*">
            @error('bukti')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700 transition">Simpan Pembayaran</button>
    </form>
</div>

<script>
    const rekeningInfo = {
        BRI: "Nomor Rekening BRI: 1234-5678-9012 (a.n. PT Reservasi)",
        Mandiri: "Nomor Rekening Mandiri: 2345-6789-0123 (a.n. PT Reservasi)",
        BCA: "Nomor Rekening BCA: 3456-7890-1234 (a.n. PT Reservasi)",
        OVO: "Nomor OVO: 0812-3456-7890 (a.n. PT Reservasi)",
        GoPay: "Nomor GoPay: 0812-9876-5432 (a.n. PT Reservasi)",
        Tunai: "Pembayaran dilakukan secara langsung / tunai di tempat."
    };

    const metodeSelect = document.getElementById('metode');
    const keteranganDiv = document.getElementById('keterangan-rekening');

    function updateKeterangan() {
        const selected = metodeSelect.value;
        if (rekeningInfo[selected]) {
            keteranganDiv.textContent = rekeningInfo[selected];
        } else {
            keteranganDiv.textContent = '';
        }
    }

    metodeSelect.addEventListener('change', updateKeterangan);

    window.addEventListener('DOMContentLoaded', () => {
        updateKeterangan();
    });
</script>
@endsection
