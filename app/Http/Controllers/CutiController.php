<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    // Cuti Karyawan
    public function index()
    {
        // hanya menampilkan data milik user login
        $cuti = \App\Models\Cuti::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('karyawan.cuti.index', compact('cuti'));
    }

    public function create()
    {
        return view('karyawan.cuti.create');
    }

    public function store(Request $request)
    {
        // 🔒 VALIDASI MASA KERJA (WAJIB)
        $karyawan = auth()->user()->karyawan;

        if (! $karyawan) {
            abort(403, 'Data karyawan tidak ditemukan.');
        }

        // belum 12 bulan → tolak sistem
        if ($karyawan->tanggal_masuk->addYear()->isFuture()) {
            return back()->withErrors([
                'cuti' => 'Hak cuti aktif setelah minimal 12 bulan masa kerja.'
            ]);
        }

        // ===============================
        // VALIDASI FORM (SUDAH ADA, AMAN)
        // ===============================
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pengganti' => 'nullable|string',
        ]);

        // upload bukti (jika ada)
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_cuti', 'public');
        }

        // simpan cuti
        Cuti::create([
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => now(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'bukti' => $buktiPath,
            'pengganti' => $request->pengganti,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('karyawan.dashboard')
            ->with('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan HR.');
    }

    // Status Cuti di HR
    public function indexHr()
    {
        // tampilkan semua pengajuan cuti (untuk HR)
        $cuti = \App\Models\Cuti::with('user')->latest()->get();


        return view('hr.cuti.index', compact('cuti'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);

        $cuti = \App\Models\Cuti::findOrFail($id);
        $cuti->update([
            'status' => $request->status,
        ]);

        return redirect()->route('hr.cuti.index')->with('success', 'Status pengajuan cuti telah diperbarui.');
    }
}
