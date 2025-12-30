<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class UserFromKaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $karyawanList = Karyawan::all();

        foreach ($karyawanList as $karyawan) {
            User::updateOrCreate(
                ['nip' => $karyawan->nip],
                [
                    'name' => $karyawan->nama_lengkap,
                    'email' => $karyawan->nip . '@internal.local',
                    'password' => Hash::make('password123'),
                    'role' => 'staff',
                ]
            );
        }
    }
}
