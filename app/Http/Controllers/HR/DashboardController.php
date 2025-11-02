<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cuti;

class DashboardController extends Controller
{
    public function index()
    {
        $summary = [
            'total_karyawan' => User::where('role', 'karyawan')->count(),
            'total_cuti' => Cuti::count(),
            'menunggu' => Cuti::where('status', 'menunggu')->count(),
            'disetujui' => Cuti::where('status', 'disetujui')->count(),
            'ditolak' => Cuti::where('status', 'ditolak')->count(),
        ];

        $recent = Cuti::with('user')->latest()->take(5)->get();

        return view('hr.dashboard', compact('summary', 'recent'));
    }
}
