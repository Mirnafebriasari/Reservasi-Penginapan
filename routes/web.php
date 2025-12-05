<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';


// ====================================
// DASHBOARD HANDLER (SETELAH LOGIN)
// ====================================
Route::middleware(['auth'])->get('/dashboard', function () {
    return auth()->user()->hasRole('admin')
        ? redirect()->route('admin.dashboard')
        : redirect()->route('users.dashboard');
})->name('dashboard');


// ====================================
// ADMIN ROUTES (HANYA INI SAJA!)
// ====================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('kamar', KamarController::class);
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('users', UserController::class);

        Route::resource('pembayaran', PembayaranController::class);
        Route::patch('/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])
            ->name('pembayaran.verifikasi');

       

});


// ====================================
// USER ROUTES (HANYA INI SAJA!)
// ====================================
Route::middleware(['auth', 'role:user'])
    ->prefix('users')
    ->name('users.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('users.dashboard');
        })->name('dashboard');

        Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
        Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

        Route::resource('reservasi', ReservasiController::class);
        Route::resource('pembayaran', PembayaranController::class);
        
});


// ====================================
// PROFILE ROUTES (SEMUA USER)
// ====================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::get('/admin/reservasi/my', [ReservasiController::class, 'myReservasi'])->name('admin.reservasi.my');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/fasilitas', FasilitasController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('fasilitas', FasilitasController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('fasilitas', FasilitasController::class);
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('fasilitas', \App\Http\Controllers\FasilitasController::class, [
        'as' => 'admin'  // Ini agar nama route prefix-nya 'admin.fasilitas.*'
    ]);
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('fasilitas', FasilitasController::class);
    });

    Route::resource('fasilitas', FasilitasController::class)->names('admin.fasilitas');


    // middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/fasilitas', FasilitasController::class, [
        'parameters' => ['fasilitas' => 'fasilitas'], // PENTING: paksa gunakan 'fasilitas'
        'names' => [
            'index' => 'admin.fasilitas.index',
            'create' => 'admin.fasilitas.create',
            'store' => 'admin.fasilitas.store',
            'show' => 'admin.fasilitas.show',
            'edit' => 'admin.fasilitas.edit',
            'update' => 'admin.fasilitas.update',
            'destroy' => 'admin.fasilitas.destroy',
        ]
    ]);
});

Route::put('admin/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('admin.fasilitas.update');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('fasilitas', FasilitasController::class);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users/reservasi/my', [ReservasiController::class, 'myReservasi'])->name('users.reservasi.my');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/kamar/create', [App\Http\Controllers\KamarController::class, 'create'])->name('kamar.create');
    Route::get('/admin/kamar', [App\Http\Controllers\KamarController::class, 'index'])->name('admin.kamar.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/kamar', [KamarController::class, 'index'])->name('kamar.index'); // <-- route index
    Route::get('/admin/kamar/create', [KamarController::class, 'create'])->name('kamar.create');
    Route::post('/admin/kamar', [KamarController::class, 'store'])->name('kamar.store');

    // route edit
    Route::get('/admin/kamar/{kamar}/edit', [KamarController::class, 'edit'])->name('kamar.edit');

    // Route untuk update (submit form edit)
    Route::put('/admin/kamar/{kamar}', [KamarController::class, 'update'])->name('kamar.update');

    // Route untuk hapus
    Route::delete('/admin/kamar/{kamar}', [KamarController::class, 'destroy'])->name('kamar.destroy');
});

Route::get('admin/kamar', [KamarController::class, 'index'])->name('admin.kamar.index');

Route::middleware(['auth'])->group(function () {
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:user'])->prefix('users')->name('users.')->group(function () {
    Route::get('reservasi/my', [ReservasiController::class, 'myReservasi'])->name('reservasi.my');
});


Route::put('admin/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('admin.fasilitas.update');



Route::delete('/admin/fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])->name('admin.fasilitas.destroy');
Route::resource('admin/fasilitas', FasilitasController::class);


Route::resource('admin/kamar', KamarController::class);

// Route untuk user biasa
Route::prefix('users')->name('users.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('reservasi/my', [ReservasiController::class, 'myReservations'])->name('reservasi.my');
    Route::resource('reservasi', ReservasiController::class)->except(['index']);
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
});


   Route::middleware(['auth', 'role:admin'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
             Route::resource('kamar', KamarController::class);
             Route::resource('fasilitas', FasilitasController::class);
             Route::resource('users', UserController::class);
             Route::resource('pembayaran', PembayaranController::class);
             Route::patch('/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
             Route::resource('reservasi', ReservasiController::class);
             Route::get('reservasi/my', [ReservasiController::class, 'myReservations'])->name('reservasi.my');
         });


        
Route::middleware(['auth'])->group(function() {
    Route::get('reservasi/my', [ReservasiController::class, 'myReservations'])->name('users.reservasi.my');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::put('/admin/reservasi/{id}/cancel', [ReservasiController::class, 'cancel'])
        ->name('admin.reservasi.cancel');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::put('/users/reservasi/{id}/cancel', [ReservasiController::class, 'cancel'])
        ->name('users.reservasi.cancel');
});

Route::middleware(['auth', 'role:user'])
    ->prefix('users')
    ->name('users.')
    ->group(function () {

        Route::get('/pembayaran/create/{reservasi}', [PembayaranController::class, 'create'])
            ->name('pembayaran.create');

        Route::resource('pembayaran', PembayaranController::class)->except(['create']);
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Custom route untuk create pembayaran dengan ID reservasi
        Route::get('/pembayaran/create/{reservasi}', [PembayaranController::class, 'create'])
            ->name('pembayaran.create');

        Route::resource('pembayaran', PembayaranController::class)->except(['create']);
});


Route::post('/users/pembayaran/{id}', [PembayaranController::class, 'store'])
    ->name('users.pembayaran.store')
    ->middleware(['auth','role:user']);

Route::post('/admin/pembayaran/{id}', [PembayaranController::class, 'store'])
    ->name('admin.pembayaran.store')
    ->middleware(['auth','role:admin']);

    
Route::get('/users/pembayaran/{id}', [PembayaranController::class, 'show'])
    ->name('pembayarans.show')
    ->middleware(['auth', 'role:user']);
Route::resource('pembayarans', PembayaranController::class);


Route::middleware('auth')->prefix('users')->name('users.')->group(function () {
    Route::delete('/reservasi/{id}/destroy', 
        [App\Http\Controllers\ReservasiController::class, 'destroyUser'])
        ->name('reservasi.destroy');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::delete('/reservasi/{id}/destroy', 
        [App\Http\Controllers\ReservasiController::class, 'destroyAdmin'])
        ->name('reservasi.destroy');
});

Route::get('/admin/reservasi/{id}', [ReservasiController::class, 'show'])->name('admin.reservasi.show');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users/reservasi/{id}', [ReservasiController::class, 'show'])->name('users.reservasi.show');
});


Route::post('/reservasi/{reservasi}/update-status', 
    [ReservasiController::class, 'updateStatus']
)->name('reservasi.updateStatus');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create/{reservasi}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/admin/reservasi/{id}/destroy', [ReservasiController::class, 'destroyAdmin'])
        ->name('admin.reservasi.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
});

// Route untuk menampilkan form profil (method GET)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// Route untuk proses update profil (method PUT)
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
