<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Karyawan extends Model
{
    protected $table = 'karyawans'; // plural
    protected $fillable = ['nama', 'nip', 'email', 'divisi', 'jabatan'];
}
