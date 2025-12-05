<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Services\FonnteService;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    /* ============================================================
       LIST RESERVASI
    ============================================================ */
    public function index(Request $request)
    {
        // Jika user admin, ambil semua reservasi dengan relasi kamar dan user
        // Jika user biasa, hanya ambil reservasi miliknya dengan relasi kamar
        if (auth()->user()->hasRole('admin')) {
            $query = Reservasi::with(['kamar', 'user']);
        } else {
            $query = Reservasi::with('kamar')
                ->where('user_id', auth()->id());
        }

        /* ===========================
           PENCARIAN / FILTER
        ============================ */

        // Filter berdasarkan nama tamu (search)
        if ($request->filled('search')) {
            $query->where('nama_tamu', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status reservasi (pending, confirmed, dll)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal check-in
        if ($request->filled('checkin_date')) {
            $query->whereDate('tanggal_checkin', $request->checkin_date);
        }

        // Filter berdasarkan kamar yang dipilih
        if ($request->filled('kamar_id')) {
            $query->where('kamar_id', $request->kamar_id);
        }

        // Ambil hasil dengan pagination terbaru
        $reservasis = $query->latest()->paginate(10);

        // Ambil semua kamar untuk dropdown filter di view
        $kamars = Kamar::all();

        return view('reservasi.index', compact('reservasis', 'kamars'));
    }


    /* ============================================================
       FORM CREATE
    ============================================================ */
    public function create()
    {
        // Ambil kamar yang statusnya tersedia untuk opsi pemesanan baru
        $kamars = Kamar::where('status', 'available')->get();
        return view('reservasi.create', compact('kamars'));
    }

    /* ============================================================
       STORE RESERVASI BARU
    ============================================================ */
    public function store(Request $request, FonnteService $fonnte)
    {
        // Validasi data inputan form reservasi baru
        $validated = $request->validate([
            'kamar_id'   => 'required|exists:kamars,id',
            'check_in'   => 'required|date|after_or_equal:today',
            'check_out'  => 'required|date|after:check_in',
            'jumlah_tamu'=> 'required|integer|min:1',
            'nama_tamu'  => 'required|string|max:255',
            // Validasi nomor WA dengan regex Indonesia (62 atau 08 di awal)
            'nomor_wa'   => ['required','string','regex:/^(62|08)\d{9,12}$/'],
        ]);

        // Normalisasi nomor WA menjadi format internasional tanpa 0 diawal
        $nomorWA = $validated['nomor_wa'];
        if (str_starts_with($nomorWA, '0')) {
            $nomorWA = '62' . substr($nomorWA, 1);
        }

        /* ------ Set waktu checkin & checkout dengan jam sekarang ------ */
        $now = now();

        $checkIn  = Carbon::parse($validated['check_in'])
                    ->setTime($now->hour, $now->minute, $now->second);

        $checkOut = Carbon::parse($validated['check_out'])
                    ->setTime($now->hour, $now->minute, $now->second);

        // Ambil data kamar dan hitung total harga berdasarkan durasi
        $kamar = Kamar::findOrFail($validated['kamar_id']);
        $jumlahHari = $checkIn->diffInDays($checkOut);
        $totalHarga = $kamar->harga * $jumlahHari;

        // Simpan data reservasi baru
        $reservasi = Reservasi::create([
            'kamar_id'        => $validated['kamar_id'],
            'tanggal_checkin' => $checkIn,
            'tanggal_checkout'=> $checkOut,
            'jumlah_tamu'     => $validated['jumlah_tamu'],
            'nama_tamu'       => $validated['nama_tamu'],
            'nomor_wa'        => $nomorWA,
            'user_id'         => auth()->id(),
            'status'          => 'pending', // status awal pending
            'total_harga'     => $totalHarga,
        ]);

        // Update status kamar menjadi tidak tersedia karena sudah dipesan
        $kamar->update(['status' => 'not_available']);

        // Kirim notifikasi WA menggunakan layanan FonnteService
        try {
            $message =
                "🏨 *KONFIRMASI RESERVASI*\n\n" .
                "Halo *{$reservasi->nama_tamu}*,\n\n" .
                "Reservasi Anda berhasil dibuat!\n\n" .
                "• ID Reservasi: #{$reservasi->id}\n" .
                "• Kamar: {$kamar->nama_kamar}\n" .
                "• Check-in: {$checkIn->format('d M Y, H:i')}\n" .
                "• Check-out: {$checkOut->format('d M Y, H:i')}\n" .
                "• Durasi: {$jumlahHari} malam\n" .
                "• Jumlah Tamu: {$reservasi->jumlah_tamu} orang\n" .
                "• Total: Rp " . number_format($totalHarga, 0, ',', '.') . "\n\n" .
                "Status: *PENDING*";

            $fonnte->sendMessage($nomorWA, $message);
        } catch (\Exception $e) {
            // Log error jika gagal kirim WA
            \Log::error('WA gagal', ['error' => $e->getMessage()]);
        }

        // Redirect ke halaman sesuai role user dengan pesan sukses
        return redirect()
            ->route(auth()->user()->hasRole('admin') ? 'admin.reservasi.index' : 'users.reservasi.my')
            ->with('success', 'Reservasi berhasil dibuat.');
    }

    /* ============================================================
       RESERVASI SAYA
    ============================================================ */
    public function myReservations()
    {
        // Ambil semua reservasi user saat ini
        $reservasis = Reservasi::with('kamar')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('reservasi.my', compact('reservasis'));
    }

    /* ============================================================
       FORM EDIT
    ============================================================ */
    public function edit(Reservasi $reservasi)
    {
        // User biasa hanya boleh edit jika status reservasi masih pending
        if (auth()->user()->hasRole('user') && $reservasi->status !== 'pending') {
            return back()->with('error', 'Reservasi tidak bisa diedit kecuali masih PENDING.');
        }

        // Ambil kamar yang tersedia dan juga kamar yang sedang dipesan reservasi ini (untuk opsi edit)
        $kamars = Kamar::where('status', 'available')
            ->orWhere('id', $reservasi->kamar_id)
            ->get();

        return view('reservasi.edit', compact('reservasi', 'kamars'));
    }

    /* ============================================================
       UPDATE RESERVASI
    ============================================================ */
    public function update(Request $request, Reservasi $reservasi, FonnteService $fonnte)
    {
        // Batasi update hanya untuk user jika reservasi masih pending
        if (auth()->user()->hasRole('user') && $reservasi->status !== 'pending') {
            return back()->with('error', 'Reservasi yang tidak pending tidak dapat diedit.');
        }

        // Validasi inputan update reservasi
        $validated = $request->validate([
            'kamar_id'   => 'required|exists:kamars,id',
            'check_in'   => 'required|date|after_or_equal:today',
            'check_out'  => 'required|date|after:check_in',
            'jumlah_tamu'=> 'required|integer|min:1',
            'nama_tamu'  => 'required|string|max:255',
            'nomor_wa'   => ['required','string','regex:/^(62|08)\d{9,12}$/'],
        ]);

        // Normalisasi nomor WA
        $nomorWA = $validated['nomor_wa'];
        if (str_starts_with($nomorWA, '0')) {
            $nomorWA = '62' . substr($nomorWA, 1);
        }

        /* ------gunakan jam saat update------ */
        $now = now();
        $checkIn = Carbon::parse($validated['check_in'])
            ->setTime($now->hour, $now->minute, $now->second);

        $checkOut = Carbon::parse($validated['check_out'])
            ->setTime($now->hour, $now->minute, $now->second);

        // Jika kamar diganti, update status kamar lama dan baru
        if ($reservasi->kamar_id != $validated['kamar_id']) {
            // Kamar lama jadi tersedia kembali
            Kamar::where('id', $reservasi->kamar_id)->update(['status' => 'available']);
            // Kamar baru jadi tidak tersedia
            Kamar::where('id', $validated['kamar_id'])->update(['status' => 'not_available']);
        }

        // Hitung harga total baru sesuai kamar dan durasi
        $kamar = Kamar::findOrFail($validated['kamar_id']);
        $jumlahHari = $checkIn->diffInDays($checkOut);
        $totalHarga = $kamar->harga * $jumlahHari;

        // Update data reservasi
        $reservasi->update([
            'kamar_id'        => $validated['kamar_id'],
            'tanggal_checkin' => $checkIn,
            'tanggal_checkout'=> $checkOut,
            'jumlah_tamu'     => $validated['jumlah_tamu'],
            'total_harga'     => $totalHarga,
            'nama_tamu'       => $validated['nama_tamu'],
            'nomor_wa'        => $nomorWA,
        ]);

        // Kirim notifikasi WA update reservasi
        try {
            $message =
                "🏨 *UPDATE RESERVASI*\n\n" .
                "Reservasi Anda telah diperbarui.\n\n" .
                "• ID: #{$reservasi->id}\n" .
                "• Kamar: {$kamar->nama_kamar}\n" .
                "• Check-in: {$checkIn->format('d M Y, H:i')}\n" .
                "• Check-out: {$checkOut->format('d M Y, H:i')}\n" .
                "• Durasi: {$jumlahHari} malam\n" .
                "• Tamu: {$reservasi->jumlah_tamu} orang\n" .
                "• Total: Rp " . number_format($totalHarga, 0, ',', '.') . "\n\n" .
                "Status: {$reservasi->status}";

            $fonnte->sendMessage($reservasi->nomor_wa, $message);
        } catch (\Exception $e) {
            \Log::error('WA Update gagal', ['error' => $e->getMessage()]);
        }

        // Redirect sesuai role dengan pesan sukses
        return redirect()
            ->route(auth()->user()->hasRole('admin') ? 'admin.reservasi.index' : 'users.reservasi.my')
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    // Method ini mirip dengan updateStatus pada PembayaranController, tampaknya ada kesalahan karena parameter Pembayaran tidak di-import
    public function updateStatus(Request $request, Pembayaran $pembayaran, FonnteService $fonnte)
    {
        // Validasi status pembayaran
        $request->validate([
            'status' => 'required|in:pending,paid,failed'
        ]);

        $pembayaran->update(['status' => $request->status]);

        // Jika status lunas, update status reservasi jadi confirmed
        if ($request->status === 'paid') {

            $reservasi = $pembayaran->reservasi;
            $reservasi->update(['status' => 'confirmed']);

            // Format pesan WA notifikasi pembayaran berhasil
            $checkIn  = Carbon::parse($reservasi->tanggal_checkin)->format('d M Y');
            $checkOut = Carbon::parse($reservasi->tanggal_checkout)->format('d M Y');

            $message = "📢 *PEMBAYARAN BERHASIL!* \n\n".
                       "Halo *{$reservasi->nama_tamu}*,\n".
                       "Pembayaran untuk reservasi *#{$reservasi->id}* telah kami terima.\n\n".
                       "🛏 Kamar: *{$reservasi->kamar->nama_kamar}*\n".
                       "📅 Check-in: $checkIn\n".
                       "📅 Check-out: $checkOut\n".
                       "💰 Total: Rp " . number_format($reservasi->total_harga, 0, ',', '.') . "\n\n".
                       "Status reservasi Anda sekarang: *CONFIRMED*.\n\n".
                       "Terima kasih sudah melakukan pembayaran 🙏";

            try {
                $fonnte->sendMessage($reservasi->nomor_wa, $message);
            } catch (\Exception $e) {
                \Log::error("WA gagal: " . $e->getMessage());
            }
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /* ============================================================
       CANCEL
    ============================================================ */
    public function cancel($id, FonnteService $fonnte)
    {
        // Cari reservasi yang milik user, status masih pending, berdasarkan id
        $reservasi = Reservasi::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        // Update status jadi cancelled
        $reservasi->update(['status' => 'cancelled']);

        // Update status kamar jadi tersedia kembali
        Kamar::where('id', $reservasi->kamar_id)->update(['status' => 'available']);

        // Kirim WA notifikasi pembatalan reservasi
        try {
            $message =
                "🏨 *PEMBATALAN RESERVASI*\n\n" .
                "Reservasi Anda telah dibatalkan.\n" .
                "• ID Reservasi: #{$reservasi->id}\n" .
                "• Status: *DIBATALKAN*";

            $fonnte->sendMessage($reservasi->nomor_wa, $message);
        } catch (\Exception $e) {
            \Log::error('WA Cancel gagal', ['error' => $e->getMessage()]);
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

    /* ============================================================
       SHOW DETAIL RESERVASI
    ============================================================ */
    public function show($id)
    {
        $query = Reservasi::with('kamar');

        // Jika user biasa, batasi hanya yang miliknya saja
        if (auth()->user()->hasRole('user')) {
            $query->where('user_id', auth()->id());
        }

        // Ambil reservasi berdasarkan id
        $reservasi = $query->findOrFail($id);

        // Ambil waktu konfirmasi pembayaran jika ada
        $paymentConfirmedAt = $reservasi->payment_confirmed_at
            ? Carbon::parse($reservasi->payment_confirmed_at)
            : null;

        $checkIn  = Carbon::parse($reservasi->tanggal_checkin);
        $checkOut = Carbon::parse($reservasi->tanggal_checkout);

        $durasiHari = $checkIn->diffInDays($checkOut);

        // Hitung checkout otomatis berdasar waktu konfirmasi pembayaran + durasi menginap
        $checkoutOtomatis = null;
        if ($paymentConfirmedAt) {
            $checkoutOtomatis = $paymentConfirmedAt
                ->copy()
                ->addDays($durasiHari)
                ->setTimeFromTimeString($paymentConfirmedAt->format('H:i:s'));
        }

        return view('reservasi.show', compact(
            'reservasi',
            'paymentConfirmedAt',
            'durasiHari',
            'checkoutOtomatis'
        ));
    }

    public function destroyAdmin($id)
    {
        // Cari reservasi berdasarkan id
        $reservasi = Reservasi::findOrFail($id);

        // Update status kamar jadi tersedia kembali
        Kamar::where('id', $reservasi->kamar_id)->update(['status' => 'available']);

        // Hapus reservasi
        $reservasi->delete();

        // Redirect ke list reservasi admin dengan pesan sukses
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

}
