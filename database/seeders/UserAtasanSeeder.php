<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAtasanSeeder extends Seeder
{
    public function run(): void
    {
        $atasan = [
            [
                'name' => 'SPV Produksi',
                'nip' => 'SPV-PROD',
                'email' => 'produksi@ekafarm.local',
            ],
            [
                'name' => 'SPV Keuangan',
                'nip' => 'SPV-KEU',
                'email' => 'keuangan@ekafarm.local',
            ],
            [
                'name' => 'SPV Marketing',
                'nip' => 'SPV-MKT',
                'email' => 'marketing@ekafarm.local',
            ],
        ];

        foreach ($atasan as $user) {
            User::create([
                'name' => $user['name'],
                'nip' => $user['nip'],
                'email' => $user['email'],
                'password' => Hash::make('ekafarm123'),
                'role' => 'atasan',
            ]);
        }
    }
}
