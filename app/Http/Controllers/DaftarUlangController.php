<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\Notifikasi;
use App\Models\Pegawai;
use App\Models\Pembayaran;
use App\Models\Pesantren;
use App\Models\Santri;
use App\Models\User;
use App\Models\WaliSantri;
use App\Notifications\NewSppNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Ramsey\Uuid\Uuid;

class DaftarUlangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $term = 'Daftar Ulang';
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        // ->where('pembayaran_id', 1)
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        // ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();

        return view('daftar-ulang.index', compact('data','pesantren'));
    }

    public function indexWalisantri(){
        $user = auth()->user();
        $term = 'Daftar Ulang';
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        // ->where('pembayaran_id', 1)
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        // ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();

        return view('daftar-ulang.walisantri', compact('data','pesantren'));

    }

    public function create()
    {
        $user = auth()->user();
        $term = 'Daftar Ulang';
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $pembayaran = Pembayaran::where('pegawai_id', $user->pegawai_id)
        ->where('nama_pembayaran','LIKE','%'.$term.'%')
        ->get();
        $santri = Santri::get();

        return view('daftar-ulang.create',compact('pesantren', 'pegawai', 'pembayaran', 'santri'));
    }

    public function store(Request $request)
    {
        if(!$request->notifikasi){
            JenisPembayaran::create($request->except(['notifikasi']));
        }else{
            $walisantri = WaliSantri::where('santri_id', $request->santri_id)->first();
            $user = User::where('walisantri_id', $walisantri->id)->get();
            $param = [
                'walisantri_id' => $walisantri->id,
                'email_username' => $walisantri->email_walisantri,
                'judul_pemberitahuan' => 'Tagihan Pembayaran Daftar Ulang',
                'detail_pemberitahuan' => "Tagihan Pembayaran Daftar Ulang, Atas nama Santri ".$walisantri->nama_walisantri." Sebesar Rp. ".number_format($request->debet_pembayaran ,2,',','.')." pada Tanggal ".date("d-m-Y", strtotime($request->tanggal_pembayaran)),
                'tanggal_pemberitahuan' => $request->tanggal_pembayaran,
            ];
            $dataParam = response()->json( $param );
            Notification::send($user, new NewSppNotification($param));
            JenisPembayaran::create($request->except(['notifikasi']));
        }


        if($request){
            return redirect()->route('daftar-ulang.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('daftar-ulang.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $user = auth()->user();
        $data = JenisPembayaran::where('id', $id)->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();

        return view('daftar-ulang.edit',compact('data', 'pesantren', 'pegawai', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method', 'pesantren_id']);
        JenisPembayaran::where('id', $id)->update($data);

        if($request){
            return redirect()->route('daftar-ulang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('daftar-ulang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy(JenisPembayaran $pembayaran)
    {
        JenisPembayaran::where('id', $pembayaran)->delete();
        return redirect()->route('daftar-ulang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
