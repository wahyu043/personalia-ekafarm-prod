<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'bukti',
        'pengganti',
        'status',
        'catatan_hr',
        'ttd_manager',
        'ttd_hr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Kamus Status

    public function statusLabel(): string
    {
        return match ($this->status) {
            'menunggu_atasan' => 'Menunggu Atasan',
            'menunggu_hr'     => 'Menunggu HR',
            'disetujui'       => 'Disetujui',
            'ditolak'         => 'Ditolak',
            default           => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    // Warna status

    public function statusColor(): string
    {
        return match ($this->status) {
            'menunggu_atasan' => 'bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-100',
            'menunggu_hr'     => 'bg-yellow-200 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100',
            'disetujui'       => 'bg-green-200 text-green-800 dark:bg-green-600 dark:text-green-100',
            'ditolak'         => 'bg-red-200 text-red-800 dark:bg-red-600 dark:text-red-100',
            default           => 'bg-gray-200 text-gray-700',
        };
    }
}
