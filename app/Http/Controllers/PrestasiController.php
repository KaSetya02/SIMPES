<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $queryBuilder = DB::table('prestasi')
            ->join('santri',"prestasi.santri_id","santri.id")
            ->select(
                'prestasi.*',
                'santri.nama_santri'
            )
            ->get();
            return view('prestasi.index', ['data' => $queryBuilder]);

        }else{
            $queryBuilder = DB::table('prestasi')
            ->join('santri',"prestasi.santri_id","santri.id")
            ->join("walisantri","santri.id", "walisantri.santri_id")
            ->where('walisantri.id', Auth::user()->walisantri_id)
            ->select(
                'prestasi.*',
                'santri.nama_santri'
            )
            ->get();

            return view('prestasi.walisantri', ['data' => $queryBuilder]);
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
        return view('prestasi.create', compact('datasantri'));
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
            'keteranganP' => 'required',
            'riwayatP' => 'required',
            'tanggalPrestasi' => 'required',
            'namaSantri' => 'required',
        ], [
            'keteranganP.required' => 'Keterangan Prestasi santri tidak boleh kosong',
            'riwayatP.required' => 'Riwayat Prestasi Santri tidak boleh kosong',
            'tanggalPrestasi.required'  => 'Tanggal Prestasi Santri wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);
        $data = new Prestasi();
        $data->keterangan_prestasi = $request->get('keteranganP');
        $data->riwayat_prestasi = $request->get('riwayatP');
        $data->tanggal_prestasi = $request->get('tanggalPrestasi');
        $data->santri_id = $request->get('namaSantri');
        $data->save();
        return redirect()->route('prestasi.index')->with('status','Data Prestasi Santri berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestasi $prestasi)
    {
        $data = $prestasi;
        $datasantri = Santri::all();
        return view('prestasi.edit',compact('data', 'datasantri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'keteranganP' => 'required',
            'riwayatP' => 'required',
            'tanggalPrestasi' => 'required',
            'namaSantri' => 'required',
        ], [
            'keteranganP.required' => 'Keterangan Prestasi santri tidak boleh kosong',
            'riwayatP.required' => 'Riwayat Prestasi Santri tidak boleh kosong',
            'tanggalPrestasi.required'  => 'Tanggal Prestasi Santri wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);

        $prestasi = Prestasi::findOrFail($prestasi->id);

        $prestasi->update([
            'keterangan_prestasi' => $request->get('keteranganP'),
            'riwayat_prestasi' => $request->get('riwayatP'),
            'tanggal_prestasi' => $request->get('tanggalPrestasi'),
            'santri_id' => $request->get('namaSantri')
        ]);

        return redirect()->route('prestasi.index')->with('status','Data Prestasi Santri berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('prestasi.index')->with('statushapus', 'Data prestasi santri berhasil dihapus');
    }
}
