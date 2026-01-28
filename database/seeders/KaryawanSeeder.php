<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nip' => '11201001',
                'nama_lengkap' => 'Hasnil Afrizal Muttaqien',
                'jabatan' => 'CEO',
                'divisi' => null,
                'tanggal_masuk' => '2012-01-01',
            ],
            [
                'nip' => '51201002',
                'nama_lengkap' => 'Desi Rachmawati',
                'jabatan' => 'Manajer Keuangan',
                'divisi' => 'Keuangan',
                'tanggal_masuk' => '2012-01-01',
            ],
            [
                'nip' => '11501003',
                'nama_lengkap' => 'Bagus Tri Ajie',
                'jabatan' => 'Direktur Utama',
                'divisi' => null,
                'tanggal_masuk' => '2015-01-01',
            ],
            [
                'nip' => '12201013',
                'nama_lengkap' => 'Rayanda Utomo Abdianto',
                'jabatan' => 'Manajer Produksi',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2022-01-01',
            ],
            [
                'nip' => '11702005',
                'nama_lengkap' => 'Eko Prasetyo',
                'jabatan' => 'SPV Produksi',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2017-02-10',
            ],
            [
                'nip' => '12003010',
                'nama_lengkap' => 'Dediyanto',
                'jabatan' => 'SPV Gudang',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2020-03-26',
            ],
            [
                'nip' => '12002008',
                'nama_lengkap' => 'Mohammad Zamzuri',
                'jabatan' => 'Operator Produksi',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2020-02-24',
            ],
            [
                'nip' => '12206014',
                'nama_lengkap' => 'Rian Nur Avianto',
                'jabatan' => 'Operator Packing',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2022-06-03',
            ],
            [
                'nip' => '11711004',
                'nama_lengkap' => 'Fajar Wahyu Anggorojati',
                'jabatan' => 'Operator Produksi',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2016-11-16',
            ],
            [
                'nip' => '11803006',
                'nama_lengkap' => 'Adipati Mas Soewondo',
                'jabatan' => 'Delivery',
                'divisi' => 'Produksi',
                'tanggal_masuk' => '2018-03-22',
            ],
            [
                'nip' => '12002009',
                'nama_lengkap' => 'Candra Ma\'ruf Nur Salim',
                'jabatan' => 'SPV Marketing',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2020-02-24',
            ],
            [
                'nip' => '12308019',
                'nama_lengkap' => 'Wahyu Mahmudiyanto',
                'jabatan' => 'SEO',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2023-11-01',
            ],
            [
                'nip' => '52209015',
                'nama_lengkap' => 'Ananda Elzaniar Parapat',
                'jabatan' => 'Sales Executive',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2022-09-22',
            ],
            [
                'nip' => '51808007',
                'nama_lengkap' => 'Aprilya Hariyani',
                'jabatan' => 'Staff Keuangan',
                'divisi' => 'Keuangan',
                'tanggal_masuk' => '2018-08-08',
            ],
            [
                'nip' => '52106012',
                'nama_lengkap' => 'Tri Agustina',
                'jabatan' => 'Admin Keuangan',
                'divisi' => 'Keuangan',
                'tanggal_masuk' => '2021-07-21',
            ],
            [
                'nip' => '50411027',
                'nama_lengkap' => 'Belvana Yasashi Hernanda',
                'jabatan' => 'Staff Konten Kreator',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2025-08-04',
            ],
            [
                'nip' => '52001028',
                'nama_lengkap' => 'Nabilla Raisya Adisty Insira Putri',
                'jabatan' => 'Sales',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2025-10-31',
            ],
            [
                'nip' => '9001',
                'nama_lengkap' => 'Novi Dwi Astuti Candradewi',
                'jabatan' => 'Sales',
                'divisi' => 'Marketing',
                'tanggal_masuk' => '2026-01-26',
            ],
        ];

        foreach ($data as $row) {
            Karyawan::create($row);
        }
    }
}