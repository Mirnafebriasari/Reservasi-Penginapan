<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    // Endpoint API Fonnte untuk mengirim pesan WhatsApp
    protected $endpoint = 'https://api.fonnte.com/send';

    /**
     * Fungsi utama untuk mengirim pesan WhatsApp ke nomor target via API Fonnte
     *
     * @param string $target Nomor tujuan WhatsApp, harus sudah dalam format internasional (misal 628xxxx)
     * @param string $message Isi pesan yang ingin dikirim
     * @return array Response dari API berupa array status dan data atau alasan kegagalan
     */
    public function sendMessage($target, $message)
    {
        // Ambil API key dari environment (.env)
        $apiKey = env('FONNTE_API_KEY');

        // Validasi jika API key tidak ditemukan
        if (empty($apiKey)) {
            Log::error('Fonnte API Key tidak ditemukan di .env');
            return [
                'status' => false,
                'reason' => 'API Key tidak ditemukan'
            ];
        }

        // Validasi jika nomor target kosong
        if (empty($target)) {
            Log::error('Nomor target WhatsApp kosong');
            return [
                'status' => false,
                'reason' => 'Nomor target kosong'
            ];
        }

        // Logging request yang akan dikirim, untuk debugging dan audit
        Log::info('Mengirim WhatsApp via Fonnte', [
            'target' => $target,
            'message_preview' => substr($message, 0, 100) . '...', // preview pesan (100 karakter)
            'api_key_preview' => substr($apiKey, 0, 10) . '...'    // preview api key (jangan tampilkan full key)
        ]);

        try {
            // Kirim request POST multipart ke endpoint API Fonnte
            $response = Http::withHeaders([
                'Authorization' => $apiKey
            ])
            ->timeout(30) // Timeout 30 detik jika tidak ada respon
            ->asMultipart()
            ->post($this->endpoint, [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Kode negara Indonesia (bisa disesuaikan)
            ]);

            // Parsing response JSON
            $result = $response->json();

            // Logging response API
            Log::info('Response dari Fonnte API', [
                'status_code' => $response->status(),
                'response' => $result
            ]);

            // Cek apakah HTTP response sukses (kode 2xx)
            if ($response->successful()) {
                // Fonnte mengembalikan 'status' boolean true jika sukses
                if (isset($result['status']) && $result['status'] === true) {
                    return $result; // Kirim hasil sukses ke caller
                } else {
                    // Jika API merespon dengan status false, catat warning
                    Log::warning('Fonnte API mengembalikan status false', [
                        'response' => $result
                    ]);
                    return $result; // Kembalikan response error API
                }
            } else {
                // HTTP error (contoh: 400, 500)
                Log::error('HTTP Error dari Fonnte', [
                    'status_code' => $response->status(),
                    'response' => $result
                ]);
                return [
                    'status' => false,
                    'reason' => 'HTTP Error: ' . $response->status()
                ];
            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Exception saat koneksi timeout atau gagal koneksi
            Log::error('Gagal terkoneksi ke Fonnte API', [
                'error' => $e->getMessage()
            ]);
            return [
                'status' => false,
                'reason' => 'Koneksi timeout atau gagal'
            ];
        } catch (\Exception $e) {
            // Exception lain saat pengiriman pesan
            Log::error('Exception saat mengirim WhatsApp', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'status' => false,
                'reason' => $e->getMessage()
            ];
        }
    }

    /**
     * Fungsi untuk mengecek status device Fonnte (apakah device siap atau terhubung)
     *
     * @return array Status device dari API Fonnte atau error message jika gagal
     */
    public function checkDevice()
    {
        $apiKey = env('FONNTE_API_KEY');

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey
            ])->post('https://api.fonnte.com/get-devices');

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error mengecek device Fonnte', [
                'error' => $e->getMessage()
            ]);
            return [
                'status' => false,
                'reason' => $e->getMessage()
            ];
        }
    }
}
