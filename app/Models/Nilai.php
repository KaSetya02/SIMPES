<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'santri_id',
        'kelas_id',
        'matapelajaran_id',
      ];
}
