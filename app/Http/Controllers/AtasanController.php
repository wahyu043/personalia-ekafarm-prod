<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class AtasanController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Tentukan divisi dari NIP login atasan
        $divisi = match ($user->nip) {
            'SPV-PROD' => 'Produksi',
            'SPV-KEU'  => 'Keuangan',
            'SPV-MKT'  => 'Marketing',
            default    => abort(403, 'Role atasan tidak valid.'),
        };

        $jumlahMenunggu = Cuti::where('status', 'menunggu_atasan')
            ->whereHas('user.karyawan', function ($q) use ($divisi) {
                $q->where('divisi', $divisi);
            })
            ->count();

        return view('atasan.dashboard', [
            'jumlahMenunggu' => $jumlahMenunggu,
            'divisi' => $divisi,
        ]);
    }
}
