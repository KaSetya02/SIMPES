<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyPermission(['admin','super-admin'])) {
            $data = Santri::all();
        }else{
            $data = Santri::join('walisantri', 'santri.id', 'walisantri.santri_id')
            ->where('walisantri.id', Auth::user()->walisantri_id)
            ->select(
                'santri.*',
                'walisantri.id as walisantri_id'
            )
            ->get();
        }
        return view('santri.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('santri.create');
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
            'foto_santri' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);
        $data = new Santri();

        if ($image = $request->file('foto_santri')) {
            $destinationPath = 'image_upload/foto_santri/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['foto_santri'] = "$profileImage";
        }


        $data->nis = $request->get('nisSantri');
        $data->pesantren_id = $user->pesantren_id;
        $data->nama_santri = $request->get('namaSantri');
        $data->tanggal_lahir_santri = $request->get('tanggalSantri');
        $data->alamat_santri = $request->get('alamatSantri');
        $data->foto_santri = $data['foto_santri'];
        $data->nama_ayah = $request->get('namaAyah');
        $data->nama_ibu = $request->get('namaIbu');
        $data->kamar_santri = $request->get('kamar');
        $data->asrama_santri = $request->get('asrama');
        $data->nominal_spp_perbulan = $request->get('nominal_spp_perbulan');
        $data->status_aktif = $request->get('statusAktif');
        $data->save();

        return redirect()->route('santri.index')->with('status','Data Santri berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        // $data = $santri->all();
        // $data['nama_santri'] = Str::slug($request->nama_santri);
        // // $data['foto']
        // Santri::create($data);

        //return redirect()->route('home')->with('status', 'Data Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        $data = $santri;

        return view('santri.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'foto_santri' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = request()->except(['_token', '_method']);

        if ($image = $request->file('foto_santri')) {
            $destinationPath = 'image_upload/foto_santri/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['foto_santri'] = "$profileImage";
        }
        else{
            unset($data['foto_santri']);
        }

        if($request->file('foto_santri'))
        {
            Santri::where('id', $santri->id)->update([
                'nis' => $request->get('nisSantri'),
                'nama_santri' => $request->get('namaSantri'),
                'tanggal_lahir_santri' => $request->get('tanggalSantri'),
                'alamat_santri' => $request->get('alamatSantri'),
                'foto_santri'=>$data['foto_santri'],
                'nama_ayah' => $request->get('namaAyah'),
                'nama_ibu' => $request->get('namaIbu'),
                'kamar_santri' => $request->get('kamar'),
                'asrama_santri' => $request->get('asrama'),
                'nominal_spp_perbulan' => $request->get('nominal_spp_perbulan'),
                'status_aktif' => $request->get('statusAktif'),
            ]);
        }else{
            Santri::where('id', $santri->id)->update([
                'nis' => $request->get('nisSantri'),
                'nama_santri' => $request->get('namaSantri'),
                'tanggal_lahir_santri' => $request->get('tanggalSantri'),
                'alamat_santri' => $request->get('alamatSantri'),
                'nama_ayah' => $request->get('namaAyah'),
                'nama_ibu' => $request->get('namaIbu'),
                'kamar_santri' => $request->get('kamar'),
                'asrama_santri' => $request->get('asrama'),
                'nominal_spp_perbulan' => $request->get('nominal_spp_perbulan'),
                'status_aktif' => $request->get('statusAktif'),
            ]);
        }

        return redirect()->route('santri.index')->with('status','Data Santri berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        $santri->delete();
        return redirect()->route('santri.index')->with('statushapus', 'Data Santri berhasil dihapus');
    }
}
