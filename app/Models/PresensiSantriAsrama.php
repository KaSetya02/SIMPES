<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSantriAsrama extends Model
{
    use HasFactory;
    protected $table = 'presensi_santri_pada_asrama';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'santri_id',
        'pesantren_id',
        'tanggal_presensi',
        'keterangan'
      ];
}
