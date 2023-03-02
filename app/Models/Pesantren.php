<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesantren extends Model
{
    protected $table = 'pesantren';

    protected $primarykey = 'id';

    public function pegawai() {
        return $this->hasMany("App\Pegawai","pesantren_id","id");
    }
    public $timestamps = false;
}
