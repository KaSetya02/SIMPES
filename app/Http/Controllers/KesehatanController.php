<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $queryBuilder = DB::table('kesehatan')
            ->join("santri","kesehatan.santri_id", "santri.id")
            ->select(
                'kesehatan.*',
                'santri.nama_santri'
            )
            ->get();
            return view('kesehatan.index', ['data' => $queryBuilder]);

        }else{
            $queryBuilder = DB::table('kesehatan')
            ->join("santri","kesehatan.santri_id", "santri.id")
            ->join("walisantri","santri.id", "walisantri.santri_id")
            ->where('walisantri.id', Auth::user()->walisantri_id)
            ->select(
                'kesehatan.*',
                'santri.nama_santri'
            )
            ->get();
            return view('kesehatan.walisantri', ['data' => $queryBuilder]);
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
        return view('kesehatan.create', compact('datasantri'));
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
            'keterangan' => 'required',
            'riwayat' => 'required',
            'tanggalKeluhan' => 'required',
            'namaSantri' => 'required',
        ], [
            'keterangan.required' => 'Keterangan Penyakit santri tidak boleh kosong',
            'riwayat.required' => 'Riwayat Kesehatan Santri tidak boleh kosong',
            'tanggalKeluhan.required'  => 'Tanggal Keluhan Penyakit wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);
        $data = new Kesehatan();
        $data->keterangan_kesehatan = $request->get('keterangan');
        $data->riwayat_kesehatan = $request->get('riwayat');
        $data->tanggal_riwayat_santri = $request->get('tanggalKeluhan');
        $data->santri_id = $request->get('namaSantri');
        $data->save();
        return redirect()->route('kesehatan.index')->with('status','Data Kesehatan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kesehatan $kesehatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kesehatan $kesehatan)
    {
        $data = $kesehatan;
        $datasantri = Santri::all();
        return view('kesehatan.edit',compact('data', 'datasantri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kesehatan $kesehatan)
    {
        $request->validate([
            'keterangan' => 'required',
            'riwayat' => 'required',
            'tanggalKeluhan' => 'required',
            'namaSantri' => 'required',
        ], [
            'keterangan.required' => 'Keterangan Penyakit santri tidak boleh kosong',
            'riwayat.required' => 'Riwayat Kesehatan Santri tidak boleh kosong',
            'tanggalKeluhan.required'  => 'Tanggal Keluhan Penyakit wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);
        $kesehatan->keterangan_kesehatan = $request->get('keterangan');
        $kesehatan->riwayat_kesehatan = $request->get('riwayat');
        $kesehatan->tanggal_riwayat_santri = $request->get('tanggalKeluhan');
        $kesehatan->santri_id = $request->get('namaSantri');
        $kesehatan->save();
        return redirect()->route('kesehatan.index')->with('status','Data Kesehatan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kesehatan $kesehatan)
    {
        $kesehatan->delete();
        return redirect()->route('kesehatan.index')->with('statushapus', 'Data kesehatan berhasil dihapus');
    }
}
