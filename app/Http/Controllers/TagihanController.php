<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\WaliSantri;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $walisantri = WaliSantri::where('id', $user->walisantri_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->leftjoin('walisantri', 'santri.id', 'walisantri.santri_id')
        ->where('jenis_pembayaran.santri_id', optional($walisantri)->id)
        ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri',
            'walisantri.nama_walisantri'
        )
        ->get();

        return view('tagihan.index', compact('data'));
    }

    public function daftarUlang()
    {
        $user = auth()->user();
        $term = 'Daftar Ulang';
        $walisantri = WaliSantri::where('id', $user->walisantri_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->leftjoin('walisantri', 'santri.id', 'walisantri.santri_id')
        ->where('jenis_pembayaran.santri_id', $walisantri->id)
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri',
            'walisantri.nama_walisantri'
        )
        ->get();

        return view('tagihan.index', compact('data'));
    }

    public function spp()
    {
        $user = auth()->user();
        $term = 'SPP';
        $walisantri = WaliSantri::where('id', $user->walisantri_id)->first();
        $data = JenisPembayaran::join('pembayaran', 'jenis_pembayaran.pembayaran_id', 'pembayaran.id')
        ->leftjoin('santri', 'jenis_pembayaran.santri_id', 'santri.id')
        ->leftjoin('walisantri', 'santri.id', 'walisantri.santri_id')
        ->where('jenis_pembayaran.santri_id', $walisantri->id)
        ->where('pembayaran.nama_pembayaran','LIKE','%'.$term.'%')
        ->where('pesantren_id',$user->pesantren_id)
        ->select(
            'jenis_pembayaran.*',
            'pembayaran.nama_pembayaran',
            'santri.nama_santri',
            'walisantri.nama_walisantri'
        )
        ->get();

        return view('tagihan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
