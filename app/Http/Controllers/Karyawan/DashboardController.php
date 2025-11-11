<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // hitung statistik cuti
        $totalDisetujui = Cuti::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->count();

        $totalDitolak = Cuti::where('user_id', $user->id)
            ->where('status', 'ditolak')
            ->count();

        $totalMenunggu = Cuti::where('user_id', $user->id)
            ->where('status', 'menunggu')
            ->count();

        // misal jatah cuti default = 12
        $sisaCuti = 12 - $totalDisetujui;

        // ambil riwayat pengajuan terakhir
        $riwayatCuti = Cuti::where('user_id', $user->id)
            ->orderByDesc('tanggal_pengajuan')
            ->take(5)
            ->get();

        // kirim semua variabel ke view
        return view('karyawan.dashboard', compact(
            'sisaCuti',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak',
            'riwayatCuti'
        ));
    }
}
