<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\RiwayatSuratController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/force-logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/')->with('success', 'Berhasil logout.');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    return request()->user()->role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/pengajuan');
})->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/pengajuan', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    Route::get('/riwayat-surat', [RiwayatSuratController::class, 'index'])->name('user.riwayat.index');
    Route::get('/riwayat-surat/{id}', [RiwayatSuratController::class, 'detail'])->name('user.riwayat.detail');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pengajuan/{id}/surat/preview', [PengajuanController::class, 'previewSurat'])->name('pengajuan.surat.preview');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index']);

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::get('/verifikasi/{id}', [VerifikasiController::class, 'detail'])->name('admin.verifikasi.detail');
    Route::post('/verifikasi/{id}', [VerifikasiController::class, 'updateStatus'])->name('admin.verifikasi.update');

    Route::get('/pengajuan/{id}/surat/download', [PengajuanController::class, 'downloadSurat'])
        ->name('admin.pengajuan.surat.download');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'detail'])->name('admin.riwayat.detail');
});

require __DIR__.'/auth.php';