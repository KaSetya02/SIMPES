<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $queryBuilder = DB::table('pelanggaran')
            ->join("santri","pelanggaran.santri_id","=","santri.id")
            ->select(
                'pelanggaran.*',
                'santri.nama_santri'
            )
            ->get();

            return view('pelanggaran.index', ['data' => $queryBuilder]);
        }else{
            $queryBuilder = DB::table('pelanggaran')
            ->join("santri","pelanggaran.santri_id","=","santri.id")
            ->join("walisantri","santri.id", "walisantri.santri_id")
            ->where('walisantri.id', Auth::user()->walisantri_id)
            ->select(
                'pelanggaran.*',
                'santri.nama_santri'
            )
            ->get();
            return view('pelanggaran.walisantri', ['data' => $queryBuilder]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $datasantri = Santri::all();
        }else{
            $datasantri = Santri::join("walisantri","santri.id", "walisantri.santri_id")
            ->where('walisantri.id', Auth::user()->walisantri_id)->get();
        }
        return view('pelanggaran.create', compact('datasantri'));
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
            'tanggalPelanggaran' => 'required',
            'namaSantri' => 'required',
        ], [
            'keterangan.required' => 'Keterangan Pelanggaran santri tidak boleh kosong',
            'riwayat.required' => 'Riwayat Pelanggaran Santri tidak boleh kosong',
            'tanggalPelanggaran.required'  => 'Tanggal Pelanggaran Santri wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);
        $data = new Pelanggaran();
        $data->keterangan_pelanggaran = $request->get('keterangan');
        $data->riwayat_pelanggaran = $request->get('riwayat');
        $data->tanggal_pelanggaran = $request->get('tanggalPelanggaran');
        $data->santri_id = $request->get('namaSantri');
        $data->save();
        return redirect()->route('pelanggaran.index')->with('status','Data Pelanggaran Santri berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggaran $pelanggaran)
    {
        $data = $pelanggaran;
        $datasantri = Santri::all();
        return view('pelanggaran.edit',compact('data', 'datasantri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'keterangan' => 'required',
            'riwayat' => 'required',
            'tanggalPelanggaran' => 'required',
            'namaSantri' => 'required',
        ], [
            'keterangan.required' => 'Keterangan Pelanggaran santri tidak boleh kosong',
            'riwayat.required' => 'Riwayat Pelanggaran Santri tidak boleh kosong',
            'tanggalPelanggaran.required'  => 'Tanggal Pelanggaran Santri wajib diisi',
            'namaSantri.required' => 'Nama santri harus dipilih',
        ]);

        $pelanggaran->keterangan_pelanggaran = $request->get('keterangan');
        $pelanggaran->riwayat_pelanggaran = $request->get('riwayat');
        $pelanggaran->tanggal_pelanggaran = $request->get('tanggalPelanggaran');
        $pelanggaran->santri_id = $request->get('namaSantri');
        $pelanggaran->save();
        return redirect()->route('pelanggaran.index')->with('status','Data Pelanggaran Santri berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return redirect()->route('pelanggaran.index')->with('statushapus', 'Data pelanggaran berhasil dihapus');
    }
}
