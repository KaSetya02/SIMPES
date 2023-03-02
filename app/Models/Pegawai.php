<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primarykey = 'id';
    public function pesantren() {
        return $this->belongsTo("App\Pesantren","pesantren_id");
    }

}
