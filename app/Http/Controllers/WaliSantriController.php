<?php

namespace App\Http\Controllers;

use App\Models\Pesantren;
use App\Models\Santri;
use App\Models\WaliSantri;
use Illuminate\Http\Request;

class WaliSantriController extends Controller
{
    public function index()
    {
        $data = WaliSantri::join('santri', 'walisantri.santri_id', 'santri.id')
        ->select(
            'walisantri.*',
            'santri.nama_santri'
        )
        ->get();
        return view('walisantri.index', compact('data'));
    }

    public function create()
    {
        $user = auth()->user();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        // $guru = Guru::where('pesantren_id', $user->pesantren_id)->get();
        return view('walisantri.create',compact('pesantren', 'user', 'santri'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        WaliSantri::create($data);

        if($request){
            return redirect()->route('walisantri.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('walisantri.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        $data = WaliSantri::where('walisantri.id', $id)
        ->first();
        $pesantren = Pesantren::where('id', $user->pesantren_id)->first();
        $santri = Santri::where('pesantren_id', $user->pesantren_id)->get();
        // $guru = Guru::where('pesantren_id', $user->pesantren_id)->get();

        return view('walisantri.edit',compact('data', 'pesantren', 'santri', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = request()->except(['pesantren_id','_token', '_method']);
        WaliSantri::where('id', $id)->update($data);

        if($request){
            return redirect()->route('walisantri.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('walisantri.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        WaliSantri::where('id', $id)->delete();
        return redirect()->route('walisantri.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
