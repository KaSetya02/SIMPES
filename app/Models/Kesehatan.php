<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kesehatan extends Model
{
    protected $table = 'kesehatan';

    protected $primarykey = 'id';
    public function santri() {
        return $this->belongsToMany("App\Santri","santri_id");
    }
    public $timestamps = false;
}
