<?php

use App\Models\JenisPembayaran;
use App\Models\KonfirmasiPembayaranSpp;
use Carbon\Carbon;

if (! function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}

if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (! function_exists('verifikasiPembayaranSpp')) {
    function verifikasiPembayaranSpp()
    {
        $data = KonfirmasiPembayaranSpp::join('jenis_pembayaran', 'konfirmasi_pembayaran_spp.jenis_pembayaran_id', 'jenis_pembayaran.id')
        ->join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        // ->where('pembayaran_id', 1)
        // ->where('pesantren_id',$user->pesantren_id)
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->select(
            'konfirmasi_pembayaran_spp.*',
            'jenis_pembayaran.kredit_pembayaran',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();
        // dd($data);

        return $data;
    }
}

if (! function_exists('jenisPembayaran')) {
    function jenisPembayaran()
    {
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        // ->where('pembayaran_id', 1)
        // ->where('pesantren_id',$user->pesantren_id)
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();

        return $data;
    }

    if (! function_exists('notifications')) {
        function notifications()
        {
            $user = App\Models\User::find(auth()->user()->id);

            $notifications = [];
            foreach ($user->unreadNotifications as $notification) {
                $notifications[] = $notification;
            }

            return $notifications;
            // $notifications = auth()->user()->unreadNotifications;

            // return $notifications;
        }
    }
}

