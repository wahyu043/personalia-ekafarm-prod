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
        $karyawan = $user->karyawan; // relasi user -> karyawan

        // 🔑 status hak cuti
        $isEligibleCuti = false;
        if ($karyawan) {
            $isEligibleCuti = $karyawan->isEligibleCuti();
        }

        // default aman
        $totalDisetujui = 0;
        $totalDitolak   = 0;
        $totalMenunggu  = 0;
        $sisaCuti       = 0;
        $riwayatCuti    = collect();

        if ($karyawan && $karyawan->isEligibleCuti()) {

            $totalDisetujui = Cuti::where('user_id', $user->id)
                ->where('status', 'disetujui')
                ->count();

            $totalDitolak = Cuti::where('user_id', $user->id)
                ->where('status', 'ditolak')
                ->count();

            $totalMenunggu = Cuti::where('user_id', $user->id)
                ->where('status', 'menunggu')
                ->count();

            // jatah cuti tahunan
            $jatahTahunan = 12;
            $sisaCuti = max(0, $jatahTahunan - $totalDisetujui);

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
