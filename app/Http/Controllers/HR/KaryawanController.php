<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with('user')->orderBy('tanggal_masuk')->paginate(15);
        return view('hr.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('hr.karyawan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nip'           => 'required|string|max:50|unique:karyawan,nip',
            'jabatan'       => 'required|string|max:100',
            'divisi'        => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
            'role'          => 'required|in:staff,atasan,hr',
        ]);

        // Simpan ke tabel karyawan
        $karyawan = Karyawan::create([
            'nama_lengkap'  => $validated['nama_lengkap'],
            'nip'           => $validated['nip'],
            'jabatan'       => $validated['jabatan'],
            'divisi'        => $validated['divisi'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
        ]);

        // Auto-generate akun users
        $namapertama = strtolower(explode(' ', $karyawan->nama_lengkap)[0]);

        User::create([
            'name'     => $karyawan->nama_lengkap,
            'nip'      => $karyawan->nip,
            'email'    => $namapertama . '.staff@ekafarm.local',
            'role'     => $validated['role'],
            'password' => Hash::make('Ekafarm123'),
        ]);

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Karyawan ' . $karyawan->nama_lengkap . ' berhasil ditambahkan. Akun login otomatis dibuat.');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = User::where('nip', $karyawan->nip)->first(); // null kalau belum punya akun
        return view('hr.karyawan.edit', compact('karyawan', 'user'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = User::where('nip', $karyawan->nip)->first();

        // Validasi tabel karyawan
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nip'           => 'required|string|max:50|unique:karyawan,nip,' . $karyawan->id,
            'jabatan'       => 'required|string|max:100',
            'divisi'        => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
        ]);

        $karyawan->update($validated);

        // Update tabel users hanya kalau punya akun
        if ($user) {
            $userValidated = $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
            $user->update($userValidated);
        }

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Data karyawan ' . $karyawan->nama_lengkap . ' berhasil diperbarui.');
    }

    public function resetPassword($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = User::where('nip', $karyawan->nip)->firstOrFail();

        $user->password = Hash::make('Ekafarm123');
        $user->save();

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Password ' . $karyawan->nama_lengkap . ' telah direset ke "Ekafarm123".');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Data karyawan ' . $karyawan->nama_lengkap . ' berhasil dihapus.');
    }
}
