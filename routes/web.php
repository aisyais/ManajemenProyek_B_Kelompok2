<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller yang dipakai
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminTanggapanController;
use App\Http\Controllers\MahasiswaLaporanController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

// Halaman Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses Login & Logout
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 2. ROUTE SETELAH LOGIN (Perlu Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ==========================================
    // GROUP MAHASISWA
    // ==========================================
    
    // Dashboard Mahasiswa (Form Lapor)
    // Menggunakan Controller 'create' untuk menampilkan form
    Route::get('/mahasiswa/dashboard', [MahasiswaLaporanController::class, 'create'])->name('mahasiswa.dashboard');

    // Proses Kirim Laporan
    Route::post('/mahasiswa/lapor', [MahasiswaLaporanController::class, 'store'])->name('lapor.store');

    // Halaman Riwayat Laporan (Semua Laporan Saya)
    // Pastikan di MahasiswaLaporanController ada function 'index'
    Route::get('/mahasiswa/semua-laporan', [MahasiswaLaporanController::class, 'index'])->name('mahasiswa.riwayat');


    // ==========================================
    // GROUP ADMIN
    // ==========================================

    // Dashboard Admin (Menampilkan Tabel Laporan)
    // Menggunakan Controller 'index' agar data tabel muncul
    Route::get('/admin/dashboard', [AdminLaporanController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/laporan', [AdminLaporanController::class, 'laporan'])->name('admin.laporan');

    // Update Status Laporan
    Route::post('/admin/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('status.update');

    // Hapus Laporan
    Route::get('/admin/laporan/{id}/hapus', [AdminLaporanController::class, 'destroy'])->name('laporan.hapus');

    // Halaman Balas Laporan
    Route::get('/admin/balas/{id}', [AdminTanggapanController::class, 'formBalas'])->name('admin.balas');

    // Proses Kirim Balasan
    Route::post('/admin/balas/{id}', [AdminTanggapanController::class, 'kirimBalasan'])->name('admin.balas.store');
});