<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;
use App\Models\SkemaSertifikasi; // ✅ sesuai nama model Anda
use App\Models\Peserta;


Route::get('/', function () {
    return view('FrontView', [
        'totalSkema'   => SkemaSertifikasi::count(), // ✅ sudah disesuaikan
        'totalPeserta' => Peserta::count(),
    ]);
})->name('home');

// ============ GUEST (belum login) ============
Route::middleware(['guest'])->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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