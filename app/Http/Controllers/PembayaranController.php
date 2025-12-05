<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Services\FonnteService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            // Jika user adalah admin, ambil semua data pembayaran beserta relasi reservasi
            $pembayarans = Pembayaran::with('reservasi')->get();
        } else {
            // Jika user biasa, ambil hanya pembayaran yang terkait dengan reservasi milik user tersebut
            $pembayarans = Pembayaran::whereHas('reservasi', function ($query) {
                $query->where('user_id', auth()->id());
            })->with('reservasi')->get();
        }

        // Tampilkan view dengan data pembayaran
        return view('pembayaran.index', compact('pembayarans'));
    }

    // Menampilkan form untuk membuat pembayaran baru, berdasarkan reservasi tertentu
    public function create(Request $request)
    {
        // Ambil ID reservasi dari route parameter atau query string
        $reservasiId = $request->route('reservasi') ?? $request->query('reservasi');

        if (!$reservasiId) {
            // Jika tidak ada ID reservasi, kembalikan ke halaman sebelumnya dengan error
            return redirect()->back()->with('error', 'ID Reservasi tidak ditemukan.');
        }

        // Ambil data reservasi beserta relasi pembayaran
        $reservasi = Reservasi::with('pembayaran')->findOrFail($reservasiId);

        // Jika sudah ada pembayaran untuk reservasi ini
        if ($reservasi->pembayaran) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.pembayaran.index')
                    ->with('error', 'Pembayaran untuk reservasi ini sudah ada.');
            }
            return redirect()->route('users.pembayaran.index')
                ->with('error', 'Anda sudah melakukan pembayaran untuk reservasi ini.');
        }

        // Tampilkan form create pembayaran dengan data reservasi
        return view('pembayaran.create', compact('reservasi'));
    }

    // Menyimpan data pembayaran baru ke database
    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validated = $request->validate([
            'reservasi_id' => 'required|integer|exists:reservasis,id',
            'metode' => 'required|string',
            'bukti_transfer'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil reservasi terkait beserta pembayaran
        $reservasi = Reservasi::with('pembayaran')->findOrFail($validated['reservasi_id']);

        // Jika reservasi sudah memiliki pembayaran, tolak pembuatan baru
        if ($reservasi->pembayaran) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.pembayaran.index')
                    ->with('error', 'Pembayaran untuk reservasi ini sudah ada.');
            }
            return redirect()->route('users.pembayaran.index')
                ->with('error', 'Pembayaran untuk reservasi ini sudah dilakukan.');
        }

        // Buat instance pembayaran baru dan isi data
        $pembayaran = new Pembayaran();
        $pembayaran->reservasi_id = $validated['reservasi_id'];
        $pembayaran->metode = $validated['metode'];
        $pembayaran->jumlah = $reservasi->total_harga; // Jumlah otomatis dari total harga reservasi
        $pembayaran->status = 'pending'; // Status default pending

        // Upload bukti transfer jika ada
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $pembayaran->bukti_transfer = $path;
        }

        // Simpan pembayaran ke database
        $pembayaran->save();

        // Redirect sesuai role user
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.reservasi.my')
                ->with('success', 'Pembayaran berhasil ditambahkan.');
        }

        return redirect()->route('users.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi admin.');
    }

    // Verifikasi pembayaran (update status pembayaran)
    public function verifikasi(Request $request, $id, FonnteService $fonnte)
    {
        // Validasi status pembayaran yang diupdate
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed',
        ]);

        // Ambil pembayaran beserta relasi reservasi dan kamar
        $pembayaran = Pembayaran::with('reservasi.kamar')->findOrFail($id);
        $pembayaran->status = $validated['status'];
        $pembayaran->save();

        // Jika status sudah 'paid', update status reservasi menjadi 'confirmed'
        if ($validated['status'] === 'paid') {
            $reservasi = $pembayaran->reservasi;
            $reservasi->status = 'confirmed';
            $reservasi->save();

            // Format pesan WhatsApp untuk konfirmasi pembayaran
            $checkIn  = Carbon::parse($reservasi->tanggal_checkin)->format('d M Y, H:i');
            $checkOut = Carbon::parse($reservasi->tanggal_checkout)->format('d M Y, H:i');
            $jumlahHari = Carbon::parse($reservasi->tanggal_checkin)
                        ->diffInDays(Carbon::parse($reservasi->tanggal_checkout));

            $message =
                "📢 *PEMBAYARAN BERHASIL!* \n\n".
                "Halo *{$reservasi->nama_tamu}*,\n".
                "Pembayaran reservasi *#{$reservasi->id}* telah diverifikasi.\n\n".
                "🛏 Kamar: *{$reservasi->kamar->nama_kamar}*\n".
                "📅 Check-in: $checkIn\n".
                "📅 Check-out: $checkOut\n".
                "• Durasi: {$jumlahHari} malam\n" .
                "• Jumlah Tamu: {$reservasi->jumlah_tamu} orang\n" .
                "💰 Total: Rp " . number_format($reservasi->total_harga, 0, ',', '.') . "\n\n".
                "Status reservasi Anda sekarang: *CONFIRMED*.\n".
                "Terima kasih 🙏";

            // Kirim pesan WA via service Fonnte
            try {
                $fonnte->sendMessage($reservasi->nomor_wa, $message);
            } catch (\Exception $e) {
                \Log::error("WA gagal: " . $e->getMessage());
            }
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    // Menghapus data pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus file bukti transfer jika ada
        if ($pembayaran->bukti_transfer && \Storage::exists('public/' . $pembayaran->bukti_transfer)) {
            \Storage::delete('public/' . $pembayaran->bukti_transfer);
        }

        // Hapus data pembayaran dari database
        $pembayaran->delete();

        // Redirect ke halaman index pembayaran dengan pesan sukses
        return redirect()->route('pembayarans.index')
                         ->with('success', 'Pembayaran berhasil dihapus');
    }

    // Menampilkan form edit pembayaran berdasarkan id
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        return view('pembayaran.edit', compact('pembayaran'));
    }

    // Memproses update data pembayaran
    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate
        $validated = $request->validate([
            'metode' => 'required|string',
            'status' => 'required|in:pending,paid,failed',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        // Update atribut pembayaran
        $pembayaran->metode = $validated['metode'];
        // Note: field 'jumlah' diupdate tapi tidak divalidasi, ini bisa jadi issue
        $pembayaran->jumlah = $validated['jumlah'] ?? $pembayaran->jumlah;
        $pembayaran->status = $validated['status'];

        // Jika ada upload bukti transfer baru
        if ($request->hasFile('bukti_transfer')) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_transfer && Storage::exists('public/' . $pembayaran->bukti_transfer)) {
                Storage::delete('public/' . $pembayaran->bukti_transfer);
            }

            // Simpan file baru
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $pembayaran->bukti_transfer = $path;
        }

        // Simpan perubahan
        $pembayaran->save();

        // Redirect ke halaman index pembayaran dengan pesan sukses
        return redirect()
            ->route('pembayarans.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }
}
