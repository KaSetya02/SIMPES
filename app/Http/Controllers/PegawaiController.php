<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pesantren;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = DB::table('pegawai')
        ->join("pesantren","pegawai.pesantren_id","=","pesantren.id")
        ->select(
            'pegawai.*',
            'pesantren.nama_pesantren'
        )
        ->get();

        return view('pegawai.index', ['data' => $queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datapesantren = Pesantren::all();
        return view('pegawai.create', compact('datapesantren'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'foto_pegawai' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);
        $data = new Pegawai();

        if ($image = $request->file('foto_pegawai')) {
            $destinationPath = 'image_upload/foto_pegawai/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['foto_pegawai'] = "$profileImage";
        }

        $data->nama_pegawai = $request->get('namaPegawai');
        $data->alamat_pegawai = $request->get('alamatPegawai');
        $data->kontak_pegawai = $request->get('kontakPegawai');
        $data->foto_pegawai = $data['foto_pegawai'];
        $data->tanggal_lahir_pegawai=$request->get('tanggalPegawai');
        $data->pesantren_id = $user->pesantren_id;
        $data->save();


        return redirect()->route('pegawai.index')->with('status','Data Pegawai berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $data = $pegawai;
        $datapesantren = Pesantren::all();
        return view('pegawai.edit',compact('data', 'datapesantren'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $user = auth()->user();
        $request->validate([
            'foto_pegawai' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = request()->except(['_token', '_method']);

        if ($image = $request->file('foto_pegawai')) {
            $destinationPath = 'image_upload/foto_pegawai/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['foto_pegawai'] = "$profileImage";
        }
        else{
            unset($data['foto_pegawai']);
        }

        if($request->file('foto_pegawai'))
        {
            Pegawai::where('id', $pegawai->id)->update([
                'nama_pegawai' => $request->get('namaPegawai'),
                'alamat_pegawai' => $request->get('alamatPegawai'),
                'kontak_pegawai' => $request->get('kontakPegawai'),
                'foto_pegawai' => $data['foto_pegawai'],
                'tanggal_lahir_pegawai' => $request->get('tanggalPegawai'),
                'pesantren_id' =>  $user->pesantren_id,
            ]);
        }else{
            Pegawai::where('id', $pegawai->id)->update([
                'nama_pegawai' => $request->get('namaPegawai'),
                'alamat_pegawai' => $request->get('alamatPegawai'),
                'kontak_pegawai' => $request->get('kontakPegawai'),
                'tanggal_lahir_pegawai' => $request->get('tanggalPegawai'),
                'pesantren_id' =>  $user->pesantren_id,
            ]);
        }
        return redirect()->route('pegawai.index')->with('status','Data Pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('statushapus', 'Data Pegawai berhasil dihapus');
    }
}
