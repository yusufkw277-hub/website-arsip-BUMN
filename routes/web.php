<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['cek.login'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get('/arsip', function () {
        return view('arsip');
    })->name('arsip');

    Route::get('/data-arsip', [ArsipController::class, 'index'])
        ->name('arsip.data');
    Route::get('/data-arsip/{id}', [ArsipController::class, 'edit'])
        ->name('arsip.edit');
    Route::post('/data-arsip/{id}', [ArsipController::class, 'update'])
        ->name('arsip.update');

    Route::post('/data-arsip/import', [ArsipController::class, 'import'])
        ->name('arsip.import');

    Route::get('/arsip/search', [ArsipController::class, 'search'])
        ->name('arsip.search');
    Route::post('/arsip/export-to-excel', [ArsipController::class, 'exportArsipToExcel'])->name('exportArsipToExcel');
});
