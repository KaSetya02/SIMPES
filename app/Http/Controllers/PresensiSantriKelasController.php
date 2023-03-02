<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pesantren;
use App\Models\PresensiSantriKelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiSantriKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $kelas = Kelas::get();
        $data = PresensiSantriKelas::join('santri', 'presensi_santri_pada_kelas.santri_id', 'santri.id')
        ->join('kelas', 'presensi_santri_pada_kelas.kelas_id', 'kelas.id')
        ->select(
            'presensi_santri_pada_kelas.*',
            'santri.nama_santri',
            'kelas.nama_kelas'
        )
        ->get();

        return view('presensi-santri-kelas.index', compact('data','santri', 'kelas'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate   = $request->toDate;
        $santri_id    = $request->santri_id;
        $kelas_id    = $request->kelas_id;

        $user = auth()->user();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $kelas = Kelas::get();

        $data = PresensiSantriKelas::join('santri', 'presensi_santri_pada_kelas.santri_id', 'santri.id')
        ->join('kelas', 'presensi_santri_pada_kelas.kelas_id', 'kelas.id')
        ->where('tanggal_presensi', '>=', $fromDate)
        ->where('tanggal_presensi', '<=', $toDate)
        ->where('santri_id', 'LIKE','%' .$santri_id.'%')
        ->orWhere('kelas_id', 'LIKE','%' .$kelas_id.'%')
        ->select(
            'presensi_santri_pada_kelas.*',
            'santri.nama_santri',
            'kelas.nama_kelas'
        )
        ->get();

        return view('presensi-santri-kelas.index',compact('data','santri', 'kelas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $kelas = Kelas::get();
        return view('presensi-santri-kelas.create',compact('kelas', 'pesantren', 'santri'));
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

        PresensiSantriKelas::create($data);

        if($request){
            return redirect()->route('presensi-santri-kelas.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('presensi-santri-kelas.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiSantriKelas  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiSantriKelas $presensiSantriKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiSantriKelas  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = PresensiSantriKelas::where('id', $id)->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $kelas = Kelas::get();

        return view('presensi-santri-kelas.edit',compact('data', 'pesantren', 'santri', 'id', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiSantriKelas  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method', 'pesantren_id']);
        PresensiSantriKelas::where('id', $id)->update($data);

        if($request){
            return redirect()->route('presensi-santri-kelas.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('presensi-santri-kelas.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiSantriKelas  $presensiSantriKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PresensiSantriKelas::where('id', $id)->delete();
        return redirect()->route('presensi-santri-kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
