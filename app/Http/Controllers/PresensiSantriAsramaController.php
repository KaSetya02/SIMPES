<?php

namespace App\Http\Controllers;

use App\Models\Pesantren;
use App\Models\PresensiSantriAsrama;
use App\Models\Santri;
use Illuminate\Http\Request;

class PresensiSantriAsramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $data = PresensiSantriAsrama::join('santri', 'presensi_santri_pada_asrama.santri_id', 'santri.id')
        ->join('pesantren', 'presensi_santri_pada_asrama.pesantren_id', 'pesantren.id')
        ->select(
            'presensi_santri_pada_asrama.*',
            'santri.nama_santri',
            'pesantren.nama_pesantren'
        )
        ->get();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();

        return view('presensi-santri-asrama.index', compact('data', 'santri'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate   = $request->toDate;
        $santri_id    = $request->santri_id;

        $user = auth()->user();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();

        $data = PresensiSantriAsrama::join('santri', 'presensi_santri_pada_asrama.santri_id', 'santri.id')
        ->join('pesantren', 'presensi_santri_pada_asrama.pesantren_id', 'pesantren.id')
        ->where('tanggal_presensi', '>=', $fromDate)
        ->where('tanggal_presensi', '<=', $toDate)
        ->where('santri_id', 'LIKE','%' .$santri_id.'%')
        ->select(
            'presensi_santri_pada_asrama.*',
            'santri.nama_santri',
            'pesantren.nama_pesantren'
        )
        ->get();

        return view('presensi-santri-asrama.search',compact('data','santri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        return view('presensi-santri-asrama.create',compact('santri', 'pesantren'));
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

        PresensiSantriAsrama::create($data);

        if($request){
            return redirect()->route('presensi-santri-asrama.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('presensi-santri-asrama.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiSantriAsrama  $presensiSantriAsrama
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiSantriAsrama $presensiSantriAsrama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiSantriAsrama  $presensiSantriAsrama
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = PresensiSantriAsrama::where('id', $id)->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();

        return view('presensi-santri-asrama.edit',compact('data', 'pesantren', 'santri', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiSantriAsrama  $presensiSantriAsrama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        PresensiSantriAsrama::where('id', $id)->update($data);

        if($request){
            return redirect()->route('presensi-santri-asrama.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('presensi-santri-asrama.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiSantriAsrama  $presensiSantriAsrama
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PresensiSantriAsrama::where('id', $id)->delete();
        return redirect()->route('presensi-santri-asrama.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
