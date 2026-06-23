<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SenimanController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Seniman;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{karya}', [GalleryController::class, 'show'])->name('gallery.show');

// Halaman publik seniman pakai prefix /artists — tidak bentrok dengan group seniman
Route::get('/artists', [SenimanController::class, 'index'])->name('seniman.index');
Route::get('/artists/{user}', [SenimanController::class, 'show'])->name('seniman.profile.public');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [Admin\UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/verifikasi', [Admin\UserController::class, 'verifikasi'])->name('users.verifikasi');
    Route::post('/users/{user}/tolak', [Admin\UserController::class, 'tolakVerifikasi'])->name('users.tolak');
    Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/karya', [Admin\KaryaController::class, 'index'])->name('karyas.index');
    Route::get('/karya/{karya}', [Admin\KaryaController::class, 'show'])->name('karyas.show');
    Route::delete('/karya/{karya}', [Admin\KaryaController::class, 'destroy'])->name('karyas.destroy');

    Route::get('/transaksi', [Admin\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{pesanan}', [Admin\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/pembayaran/{pembayaran}/verifikasi', [Admin\TransaksiController::class, 'verifikasiPembayaran'])->name('pembayaran.verifikasi');
    Route::post('/pembayaran/{pembayaran}/tolak', [Admin\TransaksiController::class, 'tolakPembayaran'])->name('pembayaran.tolak');
    Route::get('/laporan', [Admin\TransaksiController::class, 'laporan'])->name('laporan');
});

/*
|--------------------------------------------------------------------------
| Seniman Routes — prefix /seniman (dashboard, karya, pesanan, profil)
|--------------------------------------------------------------------------
*/
Route::prefix('seniman')->name('seniman.')->middleware(['auth', 'role:seniman'])->group(function () {
    Route::get('/dashboard', [Seniman\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/karya', [Seniman\KaryaController::class, 'index'])->name('karya.index');
    Route::get('/karya/create', [Seniman\KaryaController::class, 'create'])->name('karya.create');
    Route::post('/karya', [Seniman\KaryaController::class, 'store'])->name('karya.store');
    Route::get('/karya/{karya}/edit', [Seniman\KaryaController::class, 'edit'])->name('karya.edit');
    Route::put('/karya/{karya}', [Seniman\KaryaController::class, 'update'])->name('karya.update');
    Route::delete('/karya/{karya}', [Seniman\KaryaController::class, 'destroy'])->name('karya.destroy');

    Route::get('/pesanan', [Seniman\PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [Seniman\PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{pesanan}/status', [Seniman\PesananController::class, 'updateStatus'])->name('pesanan.status');

    Route::get('/profil', [Seniman\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [Seniman\ProfilController::class, 'update'])->name('profil.update');
});

/*
|--------------------------------------------------------------------------
| Pelanggan Routes
|--------------------------------------------------------------------------
*/
Route::prefix('pelanggan')->name('pelanggan.')->middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/dashboard', [Pelanggan\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pesanan', [Pelanggan\PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [Pelanggan\PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan', [Pelanggan\PesananController::class, 'store'])->name('pesanan.store');
    Route::post('/pesanan/{pesanan}/upload-bukti', [Pelanggan\PesananController::class, 'uploadBukti'])->name('pesanan.upload-bukti');
    Route::post('/pesanan/{pesanan}/pengambilan', [Pelanggan\PesananController::class, 'pilihanPengambilan'])->name('pesanan.pengambilan');
    
    Route::get('/profil', [Pelanggan\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [Pelanggan\ProfilController::class, 'update'])->name('profil.update');
    
     Route::post('/pesanan/{pesanan}/ulasan', [\App\Http\Controllers\Pelanggan\UlasanController::class, 'store'])->name('ulasan.store');
    Route::delete('/ulasan/{ulasan}', [\App\Http\Controllers\Pelanggan\UlasanController::class, 'destroy'])->name('ulasan.destroy');
});
    
/*
|--------------------------------------------------------------------------
| Chat Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:seniman,pelanggan'])->group(function () {
    Route::post('/chat/{pesanan}/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/{pesanan}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
});

