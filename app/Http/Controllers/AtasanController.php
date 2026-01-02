<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class AtasanController extends Controller
{
    public function dashboard()
    {
        $karyawan = Auth::user()->karyawan;

        // guard aman
        if (! $karyawan) {
            abort(403, 'Data karyawan atasan belum tersedia.');
        }

        $jumlahMenunggu = Cuti::where('status', 'menunggu_atasan')
            ->whereHas('user.karyawan', function ($q) use ($karyawan) {
                $q->where('divisi', $karyawan->divisi);
            })
            ->count();

        return view('atasan.dashboard', [
            'jumlahMenunggu' => $jumlahMenunggu,
            'divisi' => $karyawan->divisi,
        ]);
    }
}
