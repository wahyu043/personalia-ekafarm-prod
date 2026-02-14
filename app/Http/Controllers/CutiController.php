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
        if (! $karyawan->isEligibleCuti()) {

            return back()->withErrors([
                'cuti' => 'Hak cuti aktif setelah minimal 12 bulan masa kerja.'
            ]);
        }

        // ===============================
        // VALIDASI FORM
        // ===============================
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pengganti' => 'nullable|string',
        ]);

        // hitung jumlah hari cuti
        $jumlahHari = \Carbon\Carbon::parse($request->tanggal_mulai)
            ->diffInDays(
                \Carbon\Carbon::parse($request->tanggal_selesai)
            ) + 1;

        // Validasi sisa cuti
        if (auth()->user()->sisaCuti() < $jumlahHari) {
            return back()->withErrors([
                'cuti' => 'Sisa cuti Anda tidak mencukupi.'
            ]);
        }

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
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'bukti' => $buktiPath,
            'pengganti' => $request->pengganti,
            'status' => 'menunggu_atasan',
        ]);

        return redirect()
            ->route('karyawan.dashboard')
            ->with('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan atasan Anda.');
    }

    // Status Cuti di HR
    public function indexHr()
    {
        $base = Cuti::with(['user.karyawan']);

        $countMenunggu = (clone $base)->where('status', 'menunggu_hr')->count();
        $countDisetujui = (clone $base)->where('status', 'disetujui')->count();
        $countDitolak = (clone $base)->where('status', 'ditolak')->count();

        $cuti = Cuti::with(['user.karyawan'])
            ->where('status', 'menunggu_hr')
            ->latest()
            ->get();

        return view('hr.cuti.index', compact('cuti', 'countMenunggu', 'countDisetujui', 'countDitolak'));
    }


    // tampilkan status pengajuan cuti approval atasan dan hr

    public function indexAtasan()
    {
        $user = auth()->user();

        // Tentukan divisi atasan dari NIP login
        $divisiAtasan = match ($user->nip) {
            'SPV-PROD' => 'Produksi',
            'SPV-KEU'  => 'Keuangan',
            'SPV-MKT'  => 'Marketing',
            default    => abort(403, 'Role atasan tidak valid.'),
        };

        $cuti = Cuti::with(['user.karyawan'])
            ->where('status', 'menunggu_atasan')
            ->whereHas('user.karyawan', function ($q) use ($divisiAtasan) {
                $q->where('divisi', $divisiAtasan);
            })
            ->latest()
            ->get();

        return view('atasan.cuti.index', compact('cuti'));
    }

    // Melihat status pengajuan 

    public function approveAtasan($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'status' => 'menunggu_hr',
        ]);

        return back()->with('success', 'Pengajuan diteruskan ke HR.');
    }

    // Approve by HR

    public function approveHr($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'status' => 'disetujui',
            'approved_by_hr' => auth()->id(),
            'approved_at_hr' => now(),
        ]);

        return back()->with('success', 'Pengajuan cuti disetujui.');
    }

    // Reject by HR
    public function rejectHr($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->update(['status' => 'ditolak']);

        return back()->with('success', 'Pengajuan cuti ditolak.');
    }
}
