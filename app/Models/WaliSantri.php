<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSantri extends Model
{
    use HasFactory;

    protected $table = 'walisantri';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_walisantri',
        'kontak_walisantri',
        'email_walisantri',
        'santri_id'
      ];
}
