<?php

// use Illuminate\Routing\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SkpController;
// use App\Http\Controllers\IzinController;
// use App\Http\Controllers\TukinController;
// use App\Http\Controllers\FilterController;
// use App\Http\Controllers\PegawaiController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\LiburlokalController;
// use App\Http\Controllers\PermintaanController;
// use App\Http\Controllers\HargajabatanController;
// use App\Http\Controllers\HariliburnasController;
// use App\Http\Controllers\HarikerjapuasaController;
// use App\Http\Controllers\ImportKehadiranController;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('auth.login');
// });

// Auth::routes();

// // Route yang memerlukan autentikasi di sini
// Route::middleware('auth.route')->group(function () {
//     // route filter
//     Route::post('/Pegawai', [FilterController::class, 'filterPegawai'])->name('pegawai.filter');
//     Route::post('/izin', [FilterController::class, 'filterIzin'])->name('izin.filter');
//     Route::post('/liburlokal', [FilterController::class, 'filterLiburlokal'])->name('liburlokal.filter');
//     Route::post('/konfirmasi', [FilterController::class, 'filterPermintaan'])->name('konfirmasi.filter');
//     Route::post('/skp', [FilterController::class, 'filterSkp'])->name('skp.filter');

//     // route DashboardController
//     Route::get('/home', [DashboardController::class, 'index']);
//     Route::get('/chart-data', [DashboardController::class, 'chartData']);

//     // route LiburnasController
//     Route::resource('libur', HariliburnasController::class);

//     // route PegawaiController
//     Route::resource('pegawai', PegawaiController::class);
//     Route::get('/get-satker_p/{direktoratId}', [PegawaiController::class, 'getSatkerByDirektorat']);
//     Route::get('/get-ppk/{direktoratId}', [PegawaiController::class, 'getPpkByDirektorat']);

//     // route HarikerjapuasaController
//     Route::resource('harikerjapuasa', HarikerjapuasaController::class);

//     // route HargajabatanController
//     Route::resource('hargajabatan', HargajabatanController::class);

//     // route SkpController
//     Route::resource('skp', SkpController::class);
//     Route::get('/get-satker/{direktoratId}', [SkpController::class, 'getSatker']);

//     // route TukinController
//     Route::resource('tukin', TukinController::class);
//     Route::get('/get-satker/{direktoratId}', [TukinController::class, 'getSatker']);
//     Route::post('/tukin', [TukinController::class, 'filter'])->name('tukin.filter');

//     //route hariliburlokal
//     Route::resource('liburlokal', LiburlokalController::class);
//     Route::get('/get-satker/{direktoratId}', [LiburlokalController::class, 'getSatker']);
//     Route::get('/liburlokal/{id}/edit', [LiburlokalController::class, 'edit'])->name('liburlokal.edit');
//     Route::post('/simpan-liburlokal', [LiburlokalController::class, 'store'])->name('liburlokal.store');

//     //route izin
//     Route::resource('izin', IzinController::class);
//     Route::post('/simpan-izin', [IzinController::class, 'store'])->name('izin.store');

//     // route konfirmasi
//     Route::resource('konfirmasi', PermintaanController::class);
//     Route::get('/get-satker/{direktoratId}', [PermintaanController::class, 'getSatker']);
//     Route::get('/get-notifications', [PermintaanController::class, 'getKonfirmasiNotification'])->name('get.notifications');

//     // route import pegawai
//     Route::resource('import', ImportKehadiranController::class);
// });


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiNonPns;
use App\Http\Controllers\SkpController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\TukinController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipTukinController;
use App\Http\Controllers\LiburlokalController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HargajabatanController;
use App\Http\Controllers\HariliburnasController;
use App\Http\Controllers\HarikerjapuasaController;
use App\Http\Controllers\ImportKehadiranController;
use App\Http\Controllers\PegawaiBukanNonPnsController;

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
Route::middleware(['auth', 'web'])->group(function () {

    // // route satker
    // Route::get('/get-satker_skp/{direktoratId}', [SatkerController::class, 'getSatker']);
    // Route::get('/get-satker_p/{direktoratId}', [SatkerController::class, 'getSatkerByDirektorat']);
    // Route::get('/get-ppk/{direktoratId}', [SatkerController::class, 'getPpkByDirektorat']);

    // route pegawai bukan non pns/ki
    Route::resource('karyawan_bukan_non_pns', PegawaiBukanNonPnsController::class);
    Route::get('/get-satker/{direktoratId}', [PegawaiBukanNonPnsController::class, 'getSatker']);

    // route pegawai non pns
    Route::resource('karyawan_non_pns', PegawaiNonPns::class);
    Route::get('/get-satker/{direktoratId}', [PegawaiNonPns::class, 'getSatker']);

    // route filter
    Route::post('/pegawai_filter', [FilterController::class, 'filterPegawai'])->name('pegawai.filter');
    Route::post('/karyawan_bukan_non_pns_filter', [FilterController::class, 'filterPegawaiBukanNonPns'])->name('karyawan_bukan_non_pns.filter');
    Route::post('/karyawan_non_pns_filter', [FilterController::class, 'filterPegawaiNonPns'])->name('karyawan_non_pns.filter');
    Route::post('/izin_filter', [FilterController::class, 'filterIzin'])->name('izin.filter');
    Route::post('/liburlokal_filter', [FilterController::class, 'filterLiburlokal'])->name('liburlokal.filter');
    Route::post('/konfirmasi_filter', [FilterController::class, 'filterPermintaan'])->name('konfirmasi.filter');
    Route::post('/skp_filter', [FilterController::class, 'filterSkp'])->name('skp.filter');
    Route::post('/tukin_filter', [FilterController::class, 'filterTukin'])->name('tukin.filter');
    Route::post('/arsiptukin_filter', [FilterController::class, 'filterArsipTukin'])->name('arsiptukin.filter');

    // route DashboardController
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('/chart-data', [DashboardController::class, 'chartData']);

    // route LiburnasController
    Route::resource('libur', HariliburnasController::class);

    // route PegawaiController
    Route::resource('pegawai', PegawaiController::class);
    Route::get('/get-satker_p/{direktoratId}', [PegawaiController::class, 'getSatkerByDirektorat']);
    Route::get('/get-ppk/{direktoratId}', [PegawaiController::class, 'getPpkByDirektorat']);

    // route HarikerjapuasaController
    Route::resource('harikerjapuasa', HarikerjapuasaController::class);

    // route HargajabatanController
    Route::resource('hargajabatan', HargajabatanController::class);

    // route SkpController
    Route::resource('skp', SkpController::class);
    Route::get('/get-satker/{direktoratId}', [SkpController::class, 'getSatker']);

    // route TukinController
    Route::resource('tukin', TukinController::class);
    Route::get('/get-satker/{direktoratId}', [TukinController::class, 'getSatker']);

    // route ArsipTukinController
    Route::resource('arsiptukin', ArsipTukinController::class);
    Route::get('/get-satker/{direktoratId}', [ArsipTukinController::class, 'getSatker']);

    //route hariliburlokal
    Route::resource('liburlokal', LiburlokalController::class);
    Route::get('/get-satker/{direktoratId}', [LiburlokalController::class, 'getSatker']);

    //route izin
    Route::resource('izin', IzinController::class);
    Route::get('/izin/{nosurat}', [IzinController::class, 'show'])->name('izin.show');
    Route::post('/izin/delete/{nik}/{nosurat}', [IzinController::class, 'delete'])->name('izin.delete');

    // route konfirmasi
    Route::resource('konfirmasi', PermintaanController::class);
    Route::get('Konfirmasi_izin/{id}/edit',[PermintaanController::class,'edit_izin'])->name('konfir.edit');
    Route::post('Konfirmasi_izin/{id}/edit_proses',[PermintaanController::class,'edit_izin_proses'])->name('konfir.edit_proses');
    Route::get('/get-satker/{direktoratId}', [PermintaanController::class, 'getSatker']);
    Route::get('/get-notifications', [PermintaanController::class, 'getKonfirmasiNotification'])->name('get.notifications');
    Route::post('/konfirmasi/delete/{nik}/{nosurat}', [PermintaanController::class, 'delete'])->name('konfir.delete');
    Route::post('/konfirmasi/{nik}/{nosurat}/confirm', [PermintaanController::class, 'konfirmasi'])->name('konfir.confirm');
    Route::get('/konfirmasi/{nosurat}', [PermintaanController::class, 'show'])->name('konfir.show');


    // route import pegawai
    Route::resource('import', ImportKehadiranController::class);
    Route::post('/store', [ImportKehadiranController::class, 'store'])->name('import.store');

    // route arsip tukin
    Route::resource('arsiptukin', ArsipTukinController::class);
    Route::get('/get-satker/{direktoratId}', [ArsipTukinController::class, 'getSatker']);
});
