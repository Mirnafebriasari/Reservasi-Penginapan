@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="container mx-auto p-6 max-w-lg">

    <h1 class="text-2xl font-bold mb-4">Edit Pembayaran #{{ $pembayaran->id }}</h1>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
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

    <form action="{{ route('pembayarans.update', $pembayaran->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Metode Pembayaran --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Metode Pembayaran</label>
            <select name="metode" class="w-full border border-gray-300 rounded px-3 py-2" required>
                @php
                    $metodes = ['BRI','Mandiri','BCA','OVO','GoPay','Tunai'];
                @endphp

                @foreach($metodes as $m)
                    <option value="{{ $m }}" 
                        {{ $pembayaran->metode === $m ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jumlah Pembayaran (Rp)</label>
            <input type="number" name="jumlah" value="{{ $pembayaran->jumlah }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status Pembayaran</label>
            <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="pending" {{ $pembayaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $pembayaran->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="failed" {{ $pembayaran->status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        {{-- Bukti Transfer --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Bukti Transfer (Opsional)</label>

            @if($pembayaran->bukti_transfer)
                <p class="text-sm text-gray-700 mb-2">Bukti saat ini:</p>
                <img src="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" 
                     alt="Bukti Transfer"
                     class="w-40 rounded border mb-3">
            @endif

            <input type="file" name="bukti_transfer" accept="image/*">
            <p class="text-sm text-gray-600 mt-1">Upload baru jika ingin mengganti bukti.</p>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Update Pembayaran
        </button>
    </form>
</div>
@endsection
