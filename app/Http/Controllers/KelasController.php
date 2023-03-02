<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pesantren;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::join('guru', 'kelas.guru_id', 'guru.id')
        ->select(
            'kelas.*',
            'guru.nama_guru'
        )
        ->get();
        return view('kelas.index', compact('data'));
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
        $guru = Guru::where('pesantren_id', $user->pesantren_id)->get();
        return view('kelas.create',compact('guru', 'user', 'pesantren'));
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

        Kelas::create($data);

        if($request){
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = Kelas::where('kelas.id', $id)
        ->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $guru = Guru::where('pesantren_id', $user->pesantren_id)->get();

        return view('kelas.edit',compact('data', 'pesantren', 'guru', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['pesantren_id','_token', '_method']);
        Kelas::where('id', $id)->update($data);

        if($request){
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::where('id', $id)->delete();
        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
