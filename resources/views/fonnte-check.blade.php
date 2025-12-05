@extends('layouts.app')

@section('title', 'Fonnte Device Check')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Fonnte Device & Token Check</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">API Configuration</h2>
        
        <div class="space-y-2">
            <p><strong>API Key Preview:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $api_key_preview }}</code></p>
            <p><strong>API Key Length:</strong> {{ $api_key_length }} characters</p>
            <p><strong>HTTP Status Code:</strong> 
                <span class="px-2 py-1 rounded {{ $status_code == 200 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $status_code }}
                </span>
            </p>
            <p><strong>Token Valid:</strong> 
                <span class="px-2 py-1 rounded {{ $is_valid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $is_valid ? 'YES ✓' : 'NO ✗' }}
                </span>
            </p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">API Response</h2>
        <pre class="bg-gray-100 p-4 rounded overflow-auto text-sm">{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
    </div>

    @if($is_valid && isset($response['device']))
    <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-green-800 mb-4">✓ Connected Devices</h2>
        
        @foreach($response['device'] as $device)
        <div class="bg-white p-4 rounded mb-3 border border-green-300">
            <p><strong>Device Name:</strong> {{ $device['name'] ?? 'N/A' }}</p>
            <p><strong>Device Number:</strong> {{ $device['device'] ?? 'N/A' }}</p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 rounded {{ isset($device['status']) && $device['status'] == 'connect' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $device['status'] ?? 'unknown' }}
                </span>
            </p>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-red-800 mb-4">✗ Token Invalid atau Device Tidak Terhubung</h2>
        
        <div class="space-y-3">
            <p><strong>Kemungkinan Penyebab:</strong></p>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li>API Token salah atau sudah expired</li>
                <li>Device WhatsApp belum terhubung di Fonnte</li>
                <li>Akun Fonnte tidak aktif atau suspended</li>
                <li>Token yang dicopy tidak lengkap</li>
            </ul>

            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-300 rounded">
                <p class="font-semibold text-yellow-800 mb-2">Cara Mendapatkan Token yang Benar:</p>
                <ol class="list-decimal list-inside space-y-1 text-sm text-gray-700">
                    <li>Login ke <a href="https://app.fonnte.com" target="_blank" class="text-blue-600 underline">app.fonnte.com</a></li>
                    <li>Klik menu <strong>"Device"</strong></li>
                    <li>Pastikan ada device dengan status <strong>"Connected"</strong></li>
                    <li>Klik device tersebut, lalu cari <strong>"Show Token"</strong> atau <strong>"API Token"</strong></li>
                    <li>Copy token dan update di file <code>.env</code></li>
                    <li>Jalankan <code>php artisan config:clear</code></li>
                    <li>Restart server Laravel</li>
                </ol>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h2 class="text-xl font-semibold text-blue-800 mb-4">Test Kirim Pesan</h2>
        <p class="mb-3">Jika token valid, Anda bisa test kirim pesan dengan mengakses URL:</p>
        <code class="bg-white px-3 py-2 rounded border block">
            {{ url('/fonnte-test-send/6281234567890') }}
        </code>
        <p class="text-sm text-gray-600 mt-2">Ganti <strong>6281234567890</strong> dengan nomor WhatsApp Anda</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection