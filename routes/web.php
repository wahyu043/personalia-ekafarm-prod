<?php

use Illuminate\Support\Facades\Route;

// 🔹 Controller Imports
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HR\DashboardController;
use App\Http\Controllers\HR\KaryawanController; // (disiapkan untuk v0.4.5 tahap 2)

// ======================================================
// 🌐 ROUTE UTAMA (Guest & Redirect)
// ======================================================

Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard sesuai role login
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user?->role === 'hr') {
        return redirect()->route('hr.dashboard');
    }

    if ($user?->role === 'karyawan') {
        return redirect()->route('karyawan.dashboard');
    }

    // fallback jika belum login
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');


// ======================================================
// 👤 KARYAWAN AREA
// ======================================================

Route::middleware(['auth', 'role:karyawan'])->group(function () {

    // Dashboard Karyawan
    Route::get('/karyawan/dashboard', function () {
        return view('karyawan.dashboard');
    })->name('karyawan.dashboard');

    // Pengajuan & Daftar Cuti
    Route::get('/karyawan/cuti', [CutiController::class, 'index'])->name('karyawan.cuti.index');
    Route::get('/karyawan/cuti/create', [CutiController::class, 'create'])->name('karyawan.cuti.create');
    Route::post('/karyawan/cuti/store', [CutiController::class, 'store'])->name('karyawan.cuti.store');
});

// ======================================================
// 🧑‍💼 HR AREA
// ======================================================

Route::middleware(['auth', 'role:hr'])->group(function () {

    // Dashboard HR
    Route::get('/hr/dashboard', [DashboardController::class, 'index'])->name('hr.dashboard');

    // Approval Pengajuan Cuti
    Route::get('/hr/cuti', [CutiController::class, 'indexHr'])->name('hr.cuti.index');
    Route::post('/hr/cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('hr.cuti.updateStatus');

    // (Next v0.4.5) Data Karyawan Management
    // Route::get('/hr/karyawan', [KaryawanController::class, 'index'])->name('hr.karyawan.index');
});

// ======================================================
// 🪪 AUTH ROUTES (Laravel Breeze)
// ======================================================

require __DIR__ . '/auth.php';
