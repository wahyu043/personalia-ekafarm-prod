<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Helper: cek hak cuti (>= 12 bulan)
     */
    public function isEligibleCuti(): bool
    {
        return $this->tanggal_masuk
            ->copy()
            ->addYear()
            ->isPast();
    }
}
