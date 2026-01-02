<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke master data karyawan (via NIP)
     */
    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'nip', 'nip');
    }

    /**
     * Relasi Cuti
     */
    public function cuti(): HasMany
    {
        return $this->hasMany(Cuti::class, 'user_id');
    }

    /**
     * helper cuti
     */
    public function cutiTerpakai(): int
    {
        return $this->cuti()
            ->where('status', 'disetujui')
            ->count();
    }

    /**
     * sisa cuti (bridge ke Karyawan)
     */

    public function sisaCuti(): int
    {
        if (! $this->karyawan || ! $this->karyawan->isEligibleCuti()) {
            return 0;
        }

        return max(
            $this->karyawan->hakCutiTahunan() - $this->cutiTerpakai(),
            0
        );
    }
}
