<?php

use App\Models\User;
use App\Models\Kamar;
use App\Models\BuktiPembayaranUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\DataKamarController;
use App\Http\Controllers\AdminDataPesananUser;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\PemesananUserController;
use App\Http\Controllers\HistoryPesananController;
use App\Http\Controllers\BuktiPembayaranController;
use App\Http\Controllers\BuktiPembayaranUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('User.index', [
        'title' => 'Home',

    ]);
});
Route::get('/login', [AuthLoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/loginki', [AuthLoginController::class, 'logic']);

Route::post('/logout', [AuthLoginController::class, 'logout']);
Route::get('/register', [RegistrasiController::class, 'index']);
Route::post('/register', [RegistrasiController::class, 'store']);

Route::get('/dashboard', function () {
    // if (!auth()->guest()) {
    //     abort(403);
    // }
    return view('User.dashboard', [
        'title' => 'Dashboard',
        'users' => User::all()
    ]);
})->middleware('auth');

Route::resource('/kamars', DataKamarController::class)->middleware('admin');
Route::resource('/users', DataPenggunaController::class)->middleware('admin');

Route::get('/pesan', function () {
    return view('User.Pesanan.DataPesanan', [
        'title' => 'Pesan',
        'users' => User::all(),
        'kamars' => Kamar::all()
    ]);
})->middleware('auth');

Route::get('/pemesanan/{kamar:id}', [PemesananUserController::class, 'pesan'])->middleware('auth');

Route::post('/pemesanan/{kamar:id}', [PemesananUserController::class, 'pesanan'])->middleware('auth');

Route::get('/keranjang_pemesanan', [PemesananUserController::class, 'keranjang'])->middleware('auth');
Route::get('/detail-pesanan-user/{id}', [PemesananUserController::class, 'detailPesananuser'])->middleware('auth');
Route::get('/checkout/{id}', [PemesananUserController::class, 'checkout'])->middleware('auth');
Route::get('/tambah-keranjang', [PemesananUserController::class, 'TambahKamar'])->middleware('auth');
Route::get('/history/{id}', [PemesananUserController::class, 'history'])->middleware('auth');
Route::post('/Bukti-Pembayaran-User', [BuktiPembayaranUserController::class, 'index'])->middleware('auth');

Route::get('/cetak-pdf/{id}', [PemesananUserController::class, 'ExportPdf'])->middleware('auth');

// Route::get('/history/{id}', [HistoryPesananController::class, 'index'])->middleware('auth');

Route::get('/data-pesanan-user', [AdminDataPesananUser::class, 'index'])->middleware('admin');
