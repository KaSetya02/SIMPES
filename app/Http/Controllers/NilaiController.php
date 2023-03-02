<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Pesantren;
use App\Models\Santri;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $data = Nilai::join('mata_pelajaran', 'nilai.matapelajaran_id', 'mata_pelajaran.id')
        ->join('santri', 'nilai.santri_id', 'santri.id')
        ->join('kelas', 'nilai.kelas_id', 'kelas.id')
        ->where('santri.pesantren_id', $user->pesantren_id)
        ->select(
            'nilai.*',
            'mata_pelajaran.nama_mata_pelajaran',
            'santri.nama_santri',
            'kelas.nama_kelas'
        )
        ->get();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $kelas = Kelas::get();
        return view('nilai.index', compact('data', 'santri', 'kelas'));
    }

    public function search(Request $request)
    {
        $santri_id    = $request->santri_id;
        $kelas_id    = $request->kelas_id;

        $user = auth()->user();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $kelas = Kelas::get();

        $data = Nilai::join('mata_pelajaran', 'nilai.matapelajaran_id', 'mata_pelajaran.id')
        ->join('santri', 'nilai.santri_id', 'santri.id')
        ->join('kelas', 'nilai.kelas_id', 'kelas.id')
        ->where('santri.pesantren_id', $user->pesantren_id)
        ->where('nilai.santri_id', 'LIKE','%' .$santri_id.'%')
        ->orWhere('nilai.kelas_id', 'LIKE','%' .$kelas_id.'%')
        ->select(
            'nilai.*',
            'mata_pelajaran.nama_mata_pelajaran',
            'santri.nama_santri',
            'kelas.nama_kelas'
        )
        ->get();

        return view('nilai.search',compact('data','santri', 'kelas'));
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
        $mata_pelajaran = MataPelajaran::get();
        return view('nilai.create',compact('pesantren', 'santri', 'kelas', 'mata_pelajaran'));
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

        Nilai::create($data);

        if($request){
            return redirect()->route('nilai.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('nilai.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $matapelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = Nilai::where('id', $id)
        ->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $kelas = Kelas::get();
        $mata_pelajaran = MataPelajaran::get();

        return view('nilai.edit',compact('data', 'pesantren', 'id', 'santri', 'kelas', 'mata_pelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['pesantren_id','_token', '_method']);
        Nilai::where('id', $id)->update($data);

        if($request){
            return redirect()->route('nilai.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('nilai.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nilai::where('id', $id)->delete();
        return redirect()->route('nilai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
