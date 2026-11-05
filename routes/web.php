<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporBanjirController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Pelaporan Banjir (LaporBanjir) BPBD Kab. Bandung
| Modul 6: Generate Data Otomatis & Authentication
|--------------------------------------------------------------------------
*/

// --- Halaman Publik (Warga Melapor Tanpa Perlu Login) ---
Route::get('/', [LaporBanjirController::class, 'form'])->name('lapor.create');
Route::get('/form', [LaporBanjirController::class, 'form']);
Route::post('/simpan', [LaporBanjirController::class, 'simpan'])->name('lapor.store');

// --- Rute Autentikasi Manual (Register & Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// --- Rute Logout (Wajib Menggunakan Method POST & Login) ---
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// --- Rute Terproteksi Middleware Auth (Khusus Petugas BPBD) ---
Route::middleware('auth')->group(function () {
    // Halaman Pengelolaan dan Monitoring Laporan Banjir
    Route::get('/daftar-laporan', [LaporBanjirController::class, 'daftar'])->name('lapor.daftar');
    Route::get('/laporan', [LaporBanjirController::class, 'daftar'])->name('lapor.index');

    // Dashboard dan Profil Petugas
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
});
