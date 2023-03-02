<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'walisantri_id',
        'email_username',
        'judul_pemberitahuan',
        'detail_pemberitahuan',
        'tanggal_pemberitahuan',
        'status_terbaca'
      ];
}
