<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $data = Perizinan::join("santri","perizinan.santri_id","=","santri.id")
            ->select(
                'perizinan.*',
                'santri.nama_santri'
            )
            ->get();
            return view('perizinan.index',compact('data'));
        }else{
            $data = Perizinan::join("santri","perizinan.santri_id","=","santri.id")
            ->join("walisantri","santri.id", "walisantri.santri_id")
            ->where('walisantri.id', Auth::user()->walisantri_id)
            ->select(
                'perizinan.*',
                'santri.nama_santri'
            )
            ->get();
            return view('perizinan.walisantri',compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datasantri = Santri::all();
        return view('perizinan.create', compact('datasantri'));
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
        Perizinan::create($data);

        if($request){
            return redirect()->route('perizinan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('perizinan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function show(Perizinan $perizinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perizinan $perizinan)
    {
        $data = $perizinan;
        $datasantri = Santri::all();

        return view('perizinan.edit',compact('data', 'datasantri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perizinan $perizinan)
    {
        $data = request()->except(['_token', '_method']);
        Perizinan::where('id', $perizinan->id)->update($data);

        if($request){
            return redirect()->route('perizinan.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('perizinan.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perizinan $perizinan)
    {
        $perizinan->delete();
        return redirect()->route('perizinan.index')->with('success', 'Data Santri berhasil dihapus');
    }
}
