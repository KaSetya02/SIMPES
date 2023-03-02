<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama_pembayaran',
        'jenis_pembayaran',
        'nominal_pembayaran',
        'pegawai_id'
    ];
}
