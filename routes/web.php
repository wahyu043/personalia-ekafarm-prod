<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;

// sementara untuk test layout
Route::middleware(['auth', 'role:karyawan'])
    ->resource('/karyawan/cuti', CutiController::class)
    ->names([
        'index' => 'karyawan.cuti.index',
        'create' => 'karyawan.cuti.create',
        'store' => 'cuti.store',
    ]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user?->role === 'hr') {
        return redirect()->route('hr.dashboard');
    }

    if ($user?->role === 'karyawan') {
        return redirect()->route('karyawan.dashboard');
    }

    // fallback kalau belum login
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard Karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', function () {
        return view('karyawan.dashboard');
    })->name('karyawan.dashboard');
});

// View Cuti Karyawan
Route::get('/karyawan/cuti', [CutiController::class, 'index'])->name('karyawan.cuti.index');

// Form Cuti Karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/cuti/create', [CutiController::class, 'create'])->name('karyawan.cuti.create');
    Route::post('/karyawan/cuti/store', [CutiController::class, 'store'])->name('karyawan.cuti.store');
});

// Dashboard HR
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/hr/dashboard', function () {
        return view('hr.dashboard');
    })->name('hr.dashboard');
});

// HR Approval
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/hr/cuti', [CutiController::class, 'indexHr'])->name('hr.cuti.index');
    Route::post('/hr/cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('hr.cuti.updateStatus');
});

require __DIR__ . '/auth.php';
