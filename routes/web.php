<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\RiwayatSuratController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/pengajuan', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/riwayat-surat', [RiwayatSuratController::class, 'index'])->name('user.riwayat.index');
    Route::get('/riwayat-surat/{id}', [RiwayatSuratController::class, 'detail'])->name('user.riwayat.detail');
    Route::get('/profil', [ProfilController::class, 'index'])->name('user.profil.index');
    Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('user.profil.password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pengajuan/{id}/surat/preview', [PengajuanController::class, 'previewSurat'])->name('pengajuan.surat.preview');
    Route::get('/pengajuan/{id}/surat', [PengajuanController::class, 'downloadSurat'])->name('pengajuan.surat');
});


Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index']);
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('admin.verifikasi.index');
        Route::get('/verifikasi/{id}', [VerifikasiController::class, 'detail'])->name('admin.verifikasi.detail');
        Route::post('/verifikasi/{id}', [VerifikasiController::class, 'updateStatus'])->name('admin.verifikasi.update');
        Route::get('/pengajuan/{id}/surat/download', [PengajuanController::class, 'downloadSurat'])->name('admin.pengajuan.surat.download');
        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');
        Route::get('/riwayat/{id}', [RiwayatController::class, 'detail'])->name('admin.riwayat.detail');
    });