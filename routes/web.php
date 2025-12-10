<?php

use App\Http\Controllers\ProkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KeuanganController;

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

Route::get('/laravel', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('pages.dashboard');
// });
Route::get('/data-inventaris', function () {
    return view('pages.inventaris.main');
});
// Route::get('/data-keuangan', function () {
//     return view('pages.keuangan.main');
// });
// Route::get('/tambah-anggota', function () {
//     return view('pages.anggota.tambah');
// });
Route::get('/', [AnggotaController::class, 'dashboard'])->name('dashboard');

Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('anggota');
Route::get('/tambah-anggota', [AnggotaController::class, 'create']);
Route::post('/tambah-anggota', [AnggotaController::class, 'store'])->name('anggota.simpan');
Route::post('/anggota/edit/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::get('/anggota/{id}', [AnggotaController::class, 'show'])->name('anggota.show');

Route::get('surat/masuk', [SuratController::class, 'index'])->name('surat.masuk');
Route::get('surat/keluar', [SuratController::class, 'index'])->name('surat.keluar');
Route::get('surat-masuk/tambah', [SuratController::class, 'create'])->name('surat.masuk.tambah');
Route::post('surat/simpan', [SuratController::class, 'store'])->name('surat.store');
Route::post('surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
Route::get('surat-keluar/tambah', [SuratController::class, 'create'])->name('surat.keluar.tambah');
Route::post('surat-masuk/update-status/{id}', [SuratController::class, 'updateStatus'])->name('surat.masuk.updateStatus');

// Route::get('/surat/cetak', [SuratController::class, 'cetakPdf'])->name('surat.cetak');
// Route::get('/surat/{id}/cetak', [SuratController::class, 'cetakPdfPerItem'])->name('surat.cetak.item');
// // ...existing code...

Route::get('/data-inventaris', [InventarisController::class, 'index'])->name('inventaris');
Route::get('/tambah-inventaris', [InventarisController::class, 'create']);
Route::post('/simpan-inventaris', [InventarisController::class, 'store'])->name('inventaris.simpan');
Route::post('/inventaris/{id}', [InventarisController::class, 'hapusInventaris'])->name('inventaris.hapus');
Route::get('/inventaris/cetak', [InventarisController::class, 'cetakPdf'])->name('inventaris.cetak');

Route::get('/data-proker', [ProkerController::class, 'index'])->name('proker');
Route::get('/data-proker/{id}', [ProkerController::class, 'edit'])->name('proker.edit');
Route::post('/proker/store', [ProkerController::class, 'store'])->name('proker.store');
Route::post('/proker/update', [ProkerController::class, 'update'])->name('proker.update');
Route::post('/proker/{id}/belum-terlaksana', [ProkerController::class, 'tandaiBelumTerlaksana'])->name('proker.belumTerlaksana');
Route::post('/proker/{id}/terlaksana', [ProkerController::class, 'tandaiTerlaksana'])->name('proker.terlaksana');
Route::post('/proker/{id}', [ProkerController::class, 'hapusProker'])->name('proker.hapus');
Route::get('/getProkerFiles/{id}', [ProkerController::class, 'getFiles'])->name('proker.getFiles');

Route::get('/data-keuangan', [KeuanganController::class, 'index'])->name('keuangan');
