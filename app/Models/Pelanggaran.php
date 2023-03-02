<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $primarykey = 'id';
    public function santri() {
        return $this->belongsTo("App\Santri","santri_id");
    }
    public $timestamps = false;
}
