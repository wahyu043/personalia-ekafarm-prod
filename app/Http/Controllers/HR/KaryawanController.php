<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('hr.karyawan.index', compact('users'));
    }

    public function create()
    {
        return view('hr.karyawan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:karyawan,hr',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(User $karyawan)
    {
        return view('hr.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, User $karyawan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:users,nip,' . $karyawan->id,
            'email' => 'required|email|unique:users,email,' . $karyawan->id,
            'role' => 'required|in:karyawan,hr',
        ]);

        $karyawan->update($validated);

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function resetPassword($id)
    {
        $karyawan = User::findOrFail($id);

        // reset ke default, misalnya "Ekafarm123"
        $karyawan->password = Hash::make('Ekafarm123');
        $karyawan->save();

        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Password karyawan ' . $karyawan->name . ' telah direset ke "password123".');
    }

    public function destroy(User $karyawan)
    {
        $karyawan->delete();
        return redirect()
            ->route('hr.karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }
}
