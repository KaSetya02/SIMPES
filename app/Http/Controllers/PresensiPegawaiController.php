<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pesantren;
use App\Models\PresensiPegawai;
use Illuminate\Http\Request;

class PresensiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();
        $data = PresensiPegawai::join('pegawai', 'presensi_pegawai.pegawai_id', 'pegawai.id')
        ->join('pesantren', 'presensi_pegawai.pesantren_id', 'pesantren.id')
        ->select(
            'presensi_pegawai.*',
            'pegawai.nama_pegawai',
            'pesantren.nama_pesantren'
        )
        ->get();

        return view('presensi-pegawai.index', compact('data','pegawai'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate   = $request->toDate;
        $pegawai_id    = $request->pegawai_id;

        $user = auth()->user();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();

        $data = PresensiPegawai::join('pegawai', 'presensi_pegawai.pegawai_id', 'pegawai.id')
        ->join('pesantren', 'presensi_pegawai.pesantren_id', 'pesantren.id')
        ->where('tanggal_presensi', '>=', $fromDate)
        ->where('tanggal_presensi', '<=', $toDate)
        ->where('pegawai_id', 'LIKE','%' .$pegawai_id.'%')
        ->select(
            'presensi_pegawai.*',
            'pegawai.nama_pegawai',
            'pesantren.nama_pesantren'
        )
        ->get();

        return view('presensi-pegawai.search', compact('data','pegawai'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        return view('presensi-pegawai.create',compact('pesantren', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        PresensiPegawai::create($data);

        if($request){
            return redirect()->route('presensi-pegawai.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('presensi-pegawai.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiPegawai  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiPegawai $presensiSantriKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiPegawai  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = PresensiPegawai::where('id', $id)->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $pegawai = Pegawai::where('pesantren_id', $user->pesantren_id)->get();

        return view('presensi-pegawai.edit',compact('data', 'pesantren', 'pegawai', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiPegawai  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method', 'pesantren_id']);
        PresensiPegawai::where('id', $id)->update($data);

        if($request){
            return redirect()->route('presensi-pegawai.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('presensi-pegawai.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiPegawai  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PresensiPegawai::where('id', $id)->delete();
        return redirect()->route('presensi-pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
