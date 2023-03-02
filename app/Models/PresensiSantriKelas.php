<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSantriKelas extends Model
{
    use HasFactory;
    protected $table = 'presensi_santri_pada_kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'santri_id',
        'kelas_id',
        'tanggal_presensi',
        'keterangan'
      ];
}
