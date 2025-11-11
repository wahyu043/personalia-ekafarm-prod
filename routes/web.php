<?php

use Illuminate\Support\Facades\Route;

// 🔹 Controller Imports
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HR\DashboardController as HRDashboardController;
use App\Http\Controllers\HR\KaryawanController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\CutiPdfController;

// ======================================================
// 🌐 ROUTE UTAMA (Guest & Redirect)
// ======================================================

Route::redirect('/', '/login');

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
    Route::get('/karyawan/dashboard', [KaryawanDashboardController::class, 'index'])
        ->name('karyawan.dashboard');

    // Pengajuan & Daftar Cuti
    Route::get('/karyawan/cuti', [CutiController::class, 'index'])->name('karyawan.cuti.index');
    Route::get('/karyawan/cuti/create', [CutiController::class, 'create'])->name('karyawan.cuti.create');
    Route::post('/karyawan/cuti/store', [CutiController::class, 'store'])->name('karyawan.cuti.store');
    Route::get('/cuti/{id}', [CutiController::class, 'show'])->name('cuti.show');
    
});


// ======================================================
// 🧑‍💼 HR AREA
// ======================================================

Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/hr/dashboard', [HRDashboardController::class, 'index'])
        ->name('hr.dashboard');
    Route::get('/hr/cuti', [CutiController::class, 'indexHr'])->name('hr.cuti.index');
    Route::post('/hr/cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('hr.cuti.updateStatus');
    Route::resource('hr/karyawan', KaryawanController::class)->names('hr.karyawan');
    Route::post('/hr/karyawan/{id}/reset-password', [KaryawanController::class, 'resetPassword'])
        ->name('hr.karyawan.resetPassword');
    Route::get('/hr/cuti/{cuti}/pdf', [CutiPdfController::class, 'export'])->name('hr.cuti.pdf');
});


// ======================================================
// 🪪 AUTH ROUTES (Laravel Breeze)
// ======================================================

require __DIR__ . '/auth.php';
