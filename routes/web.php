
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaSayaController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DokumenPesertaController;
use App\Http\Controllers\VerifikasiDokumenController;
use App\Models\SkemaSertifikasi;
use App\Models\Peserta;


// ============ LANDING PAGE ============
Route::get('/', function () {
    return view('FrontView', [
        'totalSkema'   => SkemaSertifikasi::count(),
        'totalPeserta' => Peserta::count(),
    ]);
})->name('home');


// ============ GUEST / BELUM LOGIN ============
Route::middleware('guest')->group(function () {

    // Halaman login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    // Proses login
    Route::post('/login', [AuthController::class, 'login']);

    // Halaman registrasi
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    // Proses registrasi
    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');
});


// ============ USER YANG SUDAH LOGIN ============
Route::middleware('auth')->group(function () {

    // Dashboard: controller membedakan admin dan user biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');



    // ============ KHUSUS ADMIN ============
    Route::middleware('role:admin')->group(function () {
        Route::get('/verifikasi-dokumen', [
            VerifikasiDokumenController::class,
            'index'
        ])->name('admin.dokumen.index');

        Route::patch('/verifikasi-dokumen/{dokumen}/status', [
            VerifikasiDokumenController::class,
            'updateStatus'
        ])->name('admin.dokumen.status');
        Route::get('/verifikasi-dokumen/{dokumen}/file/{jenis}', [
            VerifikasiDokumenController::class,
            'lihatFile'
        ])->name('admin.dokumen.file');


        // CRUD skema sertifikasi
        Route::resource('skema', SkemaController::class)
            ->names([
                'index'   => 'skema.index',
                'create'  => 'skema.create',
                'store'   => 'skema.store',
                'show'    => 'skema.show',
                'edit'    => 'skema.edit',
                'update'  => 'skema.update',
                'destroy' => 'skema.destroy',
            ]);

        // CRUD peserta
        Route::resource('peserta', PesertaController::class)
            ->names([
                'index'   => 'peserta.index',
                'create'  => 'peserta.create',
                'store'   => 'peserta.store',
                'show'    => 'peserta.show',
                'edit'    => 'peserta.edit',
                'update'  => 'peserta.update',
                'destroy' => 'peserta.destroy',
            ]);
    });

    // Upload dokumen: semua user yang sudah login
    Route::post('/peserta-saya/dokumen', [
        DokumenPesertaController::class,
        'store'
    ])->name('peserta-saya.dokumen.store');

    // ============ KHUSUS USER BIASA ============

    Route::get('/peserta-saya', [PesertaSayaController::class, 'index'])
        ->name('peserta-saya.index');

    Route::post('/peserta-saya', [PesertaSayaController::class, 'store'])
        ->name('peserta-saya.store');


    // ============ LOGOUT ============
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
