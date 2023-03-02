<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Pesantren;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $data = MataPelajaran::join('pesantren', 'mata_pelajaran.pesantren_id', 'pesantren.id')
        ->where('pesantren_id', $user->pesantren_id)
        ->select(
            'mata_pelajaran.*',
            'pesantren.nama_pesantren'
        )
        ->get();
        return view('mata-pelajaran.index', compact('data'));
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
        return view('mata-pelajaran.create',compact('user', 'pesantren'));
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

        MataPelajaran::create($data);

        if($request){
            return redirect()->route('mata-pelajaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('mata-pelajaran.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(MataPelajaran $matapelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data = MataPelajaran::where('id', $id)
        ->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();

        return view('mata-pelajaran.edit',compact('data', 'pesantren', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataPelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['pesantren_id','_token', '_method']);
        MataPelajaran::where('id', $id)->update($data);

        if($request){
            return redirect()->route('mata-pelajaran.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('mata-pelajaran.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataPelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MataPelajaran::where('id', $id)->delete();
        return redirect()->route('mata-pelajaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
