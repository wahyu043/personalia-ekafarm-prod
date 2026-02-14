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
        $karyawan = $user->karyawan;

        $isEligibleCuti = $karyawan
            ? $karyawan->isEligibleCuti()
            : false;

        $totalDisetujui = $user->cutiTerpakai();
        $totalDitolak   = 0;
        $totalMenunggu  = 0;
        $sisaCuti       = $user->sisaCuti();
        $riwayatCuti    = collect();

        if ($karyawan && $isEligibleCuti) {

            $totalDisetujui = Cuti::where('user_id', $user->id)
                ->where('status', 'disetujui')
                ->sum('jumlah_hari');

            $totalDitolak = Cuti::where('user_id', $user->id)
                ->where('status', 'ditolak')
                ->count();

            $totalMenunggu = Cuti::where('user_id', $user->id)
                ->whereIn('status', ['menunggu_atasan', 'menunggu_hr'])
                ->count();

            $jatahTahunan = $karyawan->hakCutiTahunan();
            $sisaCuti = max(0, $karyawan->hakCutiTahunan() - $totalDisetujui);

            $riwayatCuti = Cuti::where('user_id', $user->id)
                ->orderByDesc('tanggal_pengajuan')
                ->take(5)
                ->get();
        }

        return view('karyawan.dashboard', compact(
            'isEligibleCuti',
            'sisaCuti',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak',
            'riwayatCuti'
        ));
    }
}
