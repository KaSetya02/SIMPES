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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SppController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $term = 'Spp';
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        // ->where('pesantren_id',$user->pesantren_id)
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();

        return view('spp.index', compact('data','pesantren'));
    }

    public function indexWalisantri()
    {
        $user = auth()->user();
        $term = 'Spp';
        $walisantri = WaliSantri::where('id', $user->walisantri_id)->first();
        // dd($walisantri->santri_id);
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->where('jenis_pembayaran.santri_id', $walisantri->santri_id)
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri'
        )
        ->get();
        // dd($data);
        // dd(Carbon::parse($data[0]->tanggal_pembayaran)->format('m'));
        return view('spp.walisantri', compact('data', 'pesantren'));
    }

    function getAjaxNominalFromSantri($id){
        $nominal = DB::table('santri')
        ->where('id', $id)
        ->select(
            'nominal_spp_perbulan',
        )
        ->first();
        return response()->json($nominal);
    }

    public function create()
    {
        $user = auth()->user();
        $term = 'Spp';
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $pembayaran = Pembayaran::where('pegawai_id', $user->pegawai_id)
        ->where('nama_pembayaran','LIKE','%'.$term.'%')
        ->get();
        $santri = Santri::get();

        return view('spp.create',compact('pesantren', 'pegawai', 'pembayaran', 'santri'));
    }

    public function store(Request $request)
    {
        if(!$request->notifikasi){
            JenisPembayaran::create($request->except(['notifikasi']));
        }else{
            $walisantri = WaliSantri::where('santri_id', $request->santri_id)->first();
            $createnotif = Notifikasi::create([
                'walisantri_id' => $walisantri->id,
                'email_username' => $walisantri->email_walisantri,
                'judul_pemberitahuan' => 'Tagihan Pembayaran SPP',
                'detail_pemberitahuan' => "Tagihan Pembayaran SPP, Atas nama Santri ".$walisantri->nama_walisantri." Sebesar Rp. ".number_format($request->debet_pembayaran ,2,',','.')." pada Tanggal ".date("d-m-Y", strtotime($request->tanggal_pembayaran)),
                'tanggal_pemberitahuan' => $request->tanggal_pembayaran,
                'status_terbaca' => 0
            ]);


            $user = User::whereHas('roles', function ($query) {
                $query->where('id', 2);
            })->get();

            Notification::send($user, new NewSppNotification($createnotif));
            JenisPembayaran::create($request->except(['notifikasi']));
        }

        if($request){
            return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('spp.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $user = auth()->user();
        $data = JenisPembayaran::where('id', $id)->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();

        return view('spp.edit',compact('data', 'pesantren', 'pegawai', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method', 'pesantren_id']);
        JenisPembayaran::where('id', $id)->update($data);

        if($request){
            return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('spp.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy(JenisPembayaran $pembayaran)
    {
        JenisPembayaran::where('id', $pembayaran)->delete();
        return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
