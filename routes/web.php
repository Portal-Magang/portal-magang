<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index']);

/* Auth */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']) ->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

/* User */
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/pengajuan', [PengajuanController::class, 'create']);
    Route::post('/pengajuan', [PengajuanController::class, 'store']);
    Route::get('/riwayat', [PengajuanController::class, 'riwayat']);
});

/* Admin */
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index']);
        Route::get('/verifikasi', [VerifikasiController::class, 'index']);
        Route::get('/verifikasi/{id}', [VerifikasiController::class, 'detail']);
        Route::post('/verifikasi/{id}', [VerifikasiController::class, 'updateStatus']);
    });