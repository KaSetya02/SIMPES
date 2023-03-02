<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiPembayaranSpp extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi_pembayaran_spp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_pembayaran_id',
        'tanggal',
        'upload_bukti',
        'status_verifikasi'
      ];
}
