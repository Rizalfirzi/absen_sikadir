<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkpController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\TukinController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LiburlokalController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HargajabatanController;
use App\Http\Controllers\HariliburnasController;
use App\Http\Controllers\HarikerjapuasaController;
use App\Http\Controllers\ImportKehadiranController;

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
    return view('auth.login');
});

Auth::routes();

// Route yang memerlukan autentikasi di sini
Route::middleware('auth.route')->group(function () {
    // route DashboardController
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('/chart-data', [DashboardController::class, 'chartData']);

    // route LiburnasController
    Route::resource('libur', HariliburnasController::class);

    // route PegawaiController
    Route::resource('pegawai', PegawaiController::class);
    Route::get('/get-satker_p/{direktoratId}', [PegawaiController::class, 'getSatkerByDirektorat']);
    Route::get('/get-ppk/{direktoratId}', [PegawaiController::class, 'getPpkByDirektorat']);
    Route::post('/Pegawai', [PegawaiController::class, 'filter'])->name('pegawai.filter');

    // route HarikerjapuasaController
    Route::resource('harikerjapuasa', HarikerjapuasaController::class);

    // route HargajabatanController
    Route::resource('hargajabatan', HargajabatanController::class);

    // route SkpController
    Route::resource('skp', SkpController::class);
    Route::get('/get-satker/{direktoratId}', [SkpController::class, 'getSatker']);
    Route::post('/skp', [SkpController::class, 'filter'])->name('skp.filter');

    // route TukinController
    Route::resource('tukin', TukinController::class);
    Route::get('/get-satker/{direktoratId}', [TukinController::class, 'getSatker']);
    Route::post('/tukin', [TukinController::class, 'filter'])->name('tukin.filter');

    //route hariliburlokal
    Route::resource('liburlokal', LiburlokalController::class);
    Route::get('/get-satker/{direktoratId}', [LiburlokalController::class, 'getSatker']);
    Route::get('/liburlokal/{id}/edit', [LiburlokalController::class, 'edit'])->name('liburlokal.edit');
    Route::post('/liburlokal', [LiburlokalController::class, 'filter'])->name('liburlokal.filter');
    Route::post('/simpan-liburlokal', [LiburlokalController::class, 'store'])->name('liburlokal.store');

    //route izin
    Route::resource('izin', IzinController::class);
    Route::post('/izin', [IzinController::class, 'filter'])->name('izin.filter');
    Route::post('/simpan-izin', [IzinController::class, 'store'])->name('izin.store');

    // route konfirmasi
    Route::resource('konfirmasi', PermintaanController::class);
    Route::post('/konfirmasi', [PermintaanController::class, 'filter'])->name('konfirmasi.filter');
    Route::get('/get-satker/{direktoratId}', [PermintaanController::class, 'getSatker']);
    Route::get('/get-notifications', [PermintaanController::class, 'getKonfirmasiNotification'])->name('get.notifications');

     // route import pegawai
    Route::resource('import', ImportKehadiranController::class);
});
