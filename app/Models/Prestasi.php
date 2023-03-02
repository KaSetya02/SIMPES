<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $primarykey = 'id';
    protected $fillable = [
        'keterangan_prestasi',
        'riwayat_prestasi',
        'tanggal_prestasi',
        'santri_id',
    ];
}
