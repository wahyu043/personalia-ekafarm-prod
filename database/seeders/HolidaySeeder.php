<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            // 2025
            ['holiday_date' => '2025-01-01', 'description' => 'Tahun Baru Masehi', 'is_national' => true],
            ['holiday_date' => '2025-01-27', 'description' => 'Isra Miraj', 'is_national' => true],
            ['holiday_date' => '2025-01-28', 'description' => 'Tahun Baru Imlek', 'is_national' => true],
            ['holiday_date' => '2025-03-29', 'description' => 'Hari Suci Nyepi', 'is_national' => true],
            ['holiday_date' => '2025-03-30', 'description' => 'Idul Fitri', 'is_national' => true],
            ['holiday_date' => '2025-03-31', 'description' => 'Idul Fitri', 'is_national' => true],
            ['holiday_date' => '2025-04-18', 'description' => 'Wafat Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2025-04-20', 'description' => 'Kebangkitan Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2025-05-01', 'description' => 'Hari Buruh Internasional', 'is_national' => true],
            ['holiday_date' => '2025-05-12', 'description' => 'Hari Raya Waisak', 'is_national' => true],
            ['holiday_date' => '2025-05-29', 'description' => 'Kenaikan Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2025-06-01', 'description' => 'Hari Lahir Pancasila', 'is_national' => true],
            ['holiday_date' => '2025-06-06', 'description' => 'Idul Adha', 'is_national' => true],
            ['holiday_date' => '2025-06-27', 'description' => 'Tahun Baru Islam', 'is_national' => true],
            ['holiday_date' => '2025-08-17', 'description' => 'Hari Kemerdekaan RI', 'is_national' => true],
            ['holiday_date' => '2025-09-05', 'description' => 'Maulid Nabi Muhammad SAW', 'is_national' => true],
            ['holiday_date' => '2025-12-25', 'description' => 'Hari Raya Natal', 'is_national' => true],
            ['holiday_date' => '2025-12-26', 'description' => 'Cuti Bersama Natal', 'is_national' => true],

            // 2026
            ['holiday_date' => '2026-01-01', 'description' => 'Tahun Baru Masehi', 'is_national' => true],
            ['holiday_date' => '2026-01-16', 'description' => 'Isra Miraj', 'is_national' => true],
            ['holiday_date' => '2026-02-17', 'description' => 'Tahun Baru Imlek', 'is_national' => true],
            ['holiday_date' => '2026-03-19', 'description' => 'Hari Suci Nyepi', 'is_national' => true],
            ['holiday_date' => '2026-03-20', 'description' => 'Idul Fitri', 'is_national' => true],
            ['holiday_date' => '2026-03-21', 'description' => 'Idul Fitri', 'is_national' => true],
            ['holiday_date' => '2026-04-03', 'description' => 'Wafat Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2026-05-01', 'description' => 'Hari Buruh Internasional', 'is_national' => true],
            ['holiday_date' => '2026-05-14', 'description' => 'Kenaikan Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2026-05-24', 'description' => 'Hari Raya Waisak', 'is_national' => true],
            ['holiday_date' => '2026-05-25', 'description' => 'Kebangkitan Yesus Kristus', 'is_national' => true],
            ['holiday_date' => '2026-06-01', 'description' => 'Hari Lahir Pancasila', 'is_national' => true],
            ['holiday_date' => '2026-05-27', 'description' => 'Idul Adha', 'is_national' => true],
            ['holiday_date' => '2026-06-16', 'description' => 'Tahun Baru Islam', 'is_national' => true],
            ['holiday_date' => '2026-08-17', 'description' => 'Hari Kemerdekaan RI', 'is_national' => true],
            ['holiday_date' => '2026-08-25', 'description' => 'Maulid Nabi Muhammad SAW', 'is_national' => true],
            ['holiday_date' => '2026-12-25', 'description' => 'Hari Raya Natal', 'is_national' => true],
        ];

        foreach ($holidays as $holiday) {
            Holiday::updateOrCreate(
                ['holiday_date' => $holiday['holiday_date']],
                $holiday
            );
        }
    }
}
