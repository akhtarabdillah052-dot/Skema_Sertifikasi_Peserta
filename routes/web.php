<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;   // ✅ tambah
use App\Http\Controllers\PesertaSayaController; // ✅ tambah
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;
use App\Models\SkemaSertifikasi;
use App\Models\Peserta;

// ============ LANDING PAGE ============
Route::get('/', function () {
    return view('FrontView', [
        'totalSkema'   => SkemaSertifikasi::count(),
        'totalPeserta' => Peserta::count(),
    ]);
})->name('home');

// ============ GUEST (belum login) ============
Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// ============ AUTH (sudah login) ============
Route::middleware(['auth'])->group(function () {

    // Dashboard — logic role check ada di DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman khusus user biasa — form/data peserta milik sendiri
    Route::get('/peserta-saya', [PesertaSayaController::class, 'index'])->name('peserta-saya.index');
    Route::post('/peserta-saya', [PesertaSayaController::class, 'store'])->name('peserta-saya.store');

    // ============ KHUSUS ADMIN ============
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('skema', SkemaController::class)->names([
            'index'   => 'skema.index',
            'create'  => 'skema.create',
            'store'   => 'skema.store',
            'show'    => 'skema.show',
            'edit'    => 'skema.edit',
            'update'  => 'skema.update',
            'destroy' => 'skema.destroy',
        ]);

        Route::resource('peserta', PesertaController::class)->names([
            'index'   => 'peserta.index',
            'create'  => 'peserta.create',
            'store'   => 'peserta.store',
            'show'    => 'peserta.show',
            'edit'    => 'peserta.edit',
            'update'  => 'peserta.update',
            'destroy' => 'peserta.destroy',
        ]);
    });
});
