<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Dashboard HR
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/hr/dashboard', function () {
        return view('hr.dashboard');
    })->name('hr.dashboard');
});

require __DIR__ . '/auth.php';
