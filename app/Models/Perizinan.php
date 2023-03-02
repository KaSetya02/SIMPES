<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';

    protected $primarykey = 'id';

    protected $fillable = [
        'riwayat_perizinan',
        'keterangan_perizinan',
        'tanggal_mulai',
        'tanggal_selesai',
        'santri_id '
      ];
}
