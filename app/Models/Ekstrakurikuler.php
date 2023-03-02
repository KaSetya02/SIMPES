<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';

    protected $primarykey = 'id';
    public function santri() {
        return $this->belongsTo("App\Santri","santri_id");
    }
    public $timestamps = false;
}
