<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $cutiHariIni = Cuti::whereDate('tanggal_mulai', '<=', Carbon::today())
            ->whereDate('tanggal_selesai', '>=', Carbon::today())
            ->where('status', 'Disetujui')
            ->get();

        return view('public.index', compact('cutiHariIni'));
    }
}
