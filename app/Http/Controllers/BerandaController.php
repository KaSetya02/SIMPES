<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\KonfirmasiPembayaranSpp;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function verifikasiPembayaran($id)
    {
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->where('jenis_pembayaran.id', $id)
        // ->where('pesantren_id',$user->pesantren_id)
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->first();

        $jenisPembayaran = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->where('jenis_pembayaran.id', $id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran'
        )
        ->get();
        return view('beranda.verifikasi-pembayaran', compact('data', 'jenisPembayaran' ,'id'));
    }

    public function saveVerifikasiPembayaran(Request $request)
    {
        $request->validate([
            'upload_bukti' => 'required|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        if ($image = $request->file('upload_bukti')) {
            $destinationPath = 'file_upload/upload_bukti/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['upload_bukti'] = "$profileImage";
        }

        KonfirmasiPembayaranSpp::create($data);

        if($request){
            return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('dashboard')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function updateVerifikasiPembayaran(Request $request)
    {
        $data = $request->except(['_token', 'id']);
        KonfirmasiPembayaranSpp::where('id', $request->id)->update($data);
        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
