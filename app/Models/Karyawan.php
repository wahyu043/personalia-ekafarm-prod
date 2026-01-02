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
        return Carbon::parse($this->tanggal_masuk)->diffInYears(now());
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
        return $this->isEligibleCuti() ? 12 : 0;
    }

    
}
