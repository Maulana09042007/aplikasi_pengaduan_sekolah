<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AspirasiController;

Route::get('/', [AspirasiController::class, 'create'])->name('aspirasi.create');
Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/search', [AspirasiController::class, 'search'])->name('aspirasi.search');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/siswa/tambah', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{id}/update', [SiswaController::class, 'edit'])->name('admin.siswa.update');
    Route::post('/admin/siswa/{id}/update', [SiswaController::class, 'update'])->name('admin.siswa.update.post');

    Route::get('/admin/status', [AspirasiController::class, 'statusIndex'])->name('admin.status.index');
    Route::post('/admin/status/{id}/update', [AspirasiController::class, 'updateStatus'])->name('admin.status.update');

    Route::post('/admin/feedback/{id}', [AspirasiController::class, 'updateFeedbackAdmin']);
    Route::post('/admin/status/{id}/update', [AspirasiController::class, 'updateStatus']);

    Route::get('admin/kategori',[AspirasiController::class,'tambahKategori'])->name('admin.kategori');
});
