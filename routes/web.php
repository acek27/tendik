<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tendik\SekolahController;
use App\Http\Controllers\Tendik\PengajarController;
use App\Http\Controllers\Sekolah\GuruController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('tendik')->group(function () {
    Route::get('/sekolah/data', [SekolahController::class, 'anyData'])->name('sekolah.data');
    Route::get('/sekolah/detail/{id}', [SekolahController::class, 'detail'])->name('sekolah.detail');
    Route::get('/sekolah/tunjangan/{id}', [SekolahController::class, 'tunjangan'])->name('sekolah.tunjangan');
//    Route::get('/generate', [SekolahController::class, 'generate'])->name('generate');
    Route::resource('sekolah', SekolahController::class);
    Route::get('/pengajar/data', [PengajarController::class, 'anyData'])->name('pengajar.data');
    Route::resource('pengajar', PengajarController::class);
});

Route::put('/tunjangan/{id}', [GuruController::class, 'tunjangan_update'])->name('tunjangan.update');
Route::get('/file_pernyataan/{id}', [GuruController::class, 'file'])->name('file.pernyataan');
Route::get('/guru/tunjangan/{id}', [GuruController::class, 'tunjangan'])->name('guru.tunjangan');
Route::get('/guru/data', [GuruController::class, 'anyData'])->name('guru.data');
Route::resource('guru', GuruController::class);

Route::put('/reset/update/{id}', [GuruController::class, 'reset_update'])->name('reset.update');
Route::get('/reset/password', [GuruController::class, 'reset'])->name('reset.password');

Route::get('/export/data', [PengajarController::class, 'export_data'])->name('export.data');
require __DIR__ . '/auth.php';

