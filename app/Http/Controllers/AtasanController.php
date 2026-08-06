<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class AtasanController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $divisi = match ($user->nip) {
            'SPV-PROD' => 'Produksi',
            'SPV-KEU'  => 'Keuangan',
            'SPV-MKT'  => 'Marketing',
            'SPV-GUD'  => 'Gudang',
            default    => abort(403, 'Role atasan tidak valid.'),
        };

        $jumlahMenunggu = Cuti::where('status', 'menunggu_atasan')
            ->whereHas('user.karyawan', function ($q) use ($divisi) {
                $q->where('divisi', $divisi);
            })
            ->count();

        $jumlahDisetujui = Cuti::where('status', 'disetujui')
            ->whereHas('user.karyawan', function ($q) use ($divisi) {
                $q->where('divisi', $divisi);
            })
            ->count();

        $jumlahDitolak = Cuti::where('status', 'ditolak')
            ->whereHas('user.karyawan', function ($q) use ($divisi) {
                $q->where('divisi', $divisi);
            })
            ->count();

        return view('atasan.dashboard', [
            'jumlahMenunggu' => $jumlahMenunggu,
            'jumlahDisetujui' => $jumlahDisetujui,
            'jumlahDitolak' => $jumlahDitolak,
            'divisi' => $divisi,
        ]);
    }
}
