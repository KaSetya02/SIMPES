<?php

namespace App\Http\Controllers;

use App\Models\Pesantren;
use Illuminate\Http\Request;

class PesantrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pesantren.index',['data'=>Pesantren::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pesantren.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaPesantren' => 'required',
            'alamatPesantren' => 'required',
        ], [
            'namaPesantren.required' => 'Nama Pesantren tidak boleh kosong',
            'alamatPesantren.required' => 'Alamat Pesantren tidak boleh kosong',
        ]);


        $data = new Pesantren();


        $data->nama_pesantren = $request->get('namaPesantren');
        $data->alamat_pesantren = $request->get('alamatPesantren');

        $data->save();

        return redirect()->route('pesantren.index')->with('status','Data Pesantren berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pesantren  $pesantren
     * @return \Illuminate\Http\Response
     */
    public function show(Pesantren $pesantren)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pesantren  $pesantren
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesantren $pesantren)
    {
        $data = $pesantren;

        return view('pesantren.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesantren  $pesantren
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesantren $pesantren)
    {
        $request->validate([
            'namaPesantren' => 'required',
            'alamatPesantren' => 'required',
        ], [
            'namaPesantren.required' => 'Nama Pesantren tidak boleh kosong',
            'alamatPesantren.required' => 'Alamat Pesantren tidak boleh kosong',
        ]);


        $pesantren->nama_pesantren = $request->get('namaPesantren');
        $pesantren->alamat_pesantren = $request->get('alamatPesantren');

        $pesantren->save();

        return redirect()->route('pesantren.index')->with('status','Data Pesantren berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pesantren  $pesantren
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesantren $pesantren)
    {
        $pesantren->delete();
        return redirect()->route('pesantren.index')->with('statushapus', 'Data Pesantren berhasil dihapus');
    }
}
