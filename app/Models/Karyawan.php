<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jabatan',
        'divisi',
        'tanggal_masuk',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    /**
     * Hitung masa kerja (tahun penuh)
     */
    public function masaKerjaTahun(): int
    {
        return (int) Carbon::parse($this->tanggal_masuk)->diffInYears(now());
    }

    /**
     * Cek apakah sudah berhak cuti
     */
    public function isEligibleCuti(): bool
    {
        return $this->masaKerjaTahun() >= 1;
    }

    /**
     * Hak cuti tahunan
     */
    public function hakCutiTahunan(): int
    {
        $masa = $this->masaKerjaTahun();

        return match (true) {
            $masa >= 3 => 14,
            $masa >= 1 => 12,
            default    => 0,
        };
    }

    /**
     * Hitung hari kerja (exclude sabtu, minggu, libur nasional)
     */
    public static function hitungHariKerja(string $mulai, string $selesai): int
    {
        $start  = \Carbon\Carbon::parse($mulai);
        $end    = \Carbon\Carbon::parse($selesai);

        // Ambil semua tanggal libur nasional dalam range
        $liburNasional = \App\Models\Holiday::whereBetween('holiday_date', [$start, $end])
            ->pluck('holiday_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->toDateString())
            ->toArray();

        $hariKerja = 0;
        $current = $start->copy();

        while ($current->lte($end)) {
            $isWeekend = $current->isSaturday() || $current->isSunday();
            $isLibur   = in_array($current->toDateString(), $liburNasional);

            if (! $isWeekend && ! $isLibur) {
                $hariKerja++;
            }

            $current->addDay();
        }

        return $hariKerja;
    }

    /**
     * Relasi ke User via NIP
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'nip', 'nip');
    }
}
