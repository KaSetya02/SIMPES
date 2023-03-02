<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_guru',
        'alamat_guru',
        'tanggal_lahir_guru',
        'foto_guru',
        'nomor_guru',
        'pendidikan_guru',
        'walikelas',
        'pesantren_id',
        'kategori_guru'
      ];

    public function pesantren() {
        return $this->belongsTo("App\Models\Pesantren","pesantren_id");
    }
}
