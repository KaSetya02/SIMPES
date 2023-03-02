<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiPegawai extends Model
{
    use HasFactory;
    protected $table = 'presensi_pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'pegawai_id',
        'pesantren_id',
        'tanggal_presensi',
        'keterangan'
      ];
}
