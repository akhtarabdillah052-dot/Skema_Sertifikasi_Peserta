<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('skema', SkemaController::class, ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])->names([
        'index' => 'skema.index',
        'create' => 'skema.create',
        'store' => 'skema.store',
        'show' => 'skema.show',
        'edit' => 'skema.edit',
        'update' => 'skema.update',
        'destroy' => 'skema.destroy',
    ]);
    Route::resource('peserta', PesertaController::class, ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])->names([
        'index' => 'peserta.index',
        'create' => 'peserta.create',
        'store' => 'peserta.store',
        'show' => 'peserta.show',
        'edit' => 'peserta.edit',
        'update' => 'peserta.update',
        'destroy' => 'peserta.destroy',
    ]);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});