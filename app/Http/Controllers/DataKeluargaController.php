<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use App\DataKeluarga;
use App\DataRumah;

class DataKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $data = DataKeluarga::where('id_mahasiswa', $mahasiswa->id)->first();

        $data_kurang = DataKeluarga::where('id_mahasiswa', $mahasiswa->id)->whereNull('nama_ayah')->first();
        
        $id = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $beep_datarumah = DataRumah::where('id_mahasiswa', $mahasiswa->id)->whereNull('kepemilikan_rumah')->first();
        $beep_datakeluarga = DataKeluarga::where('id_mahasiswa', $mahasiswa->id)->whereNull('nama_ayah')->first();

        $data_fotokhs = Mahasiswa::where('id_user', $id)->whereNull('foto_khs')->get();
        $data_ipk = Mahasiswa::where('id_user', $id)->whereNull('ipk')->get();
        $data_user = User::where('id', $id)->whereNull('email')->get();

        $beep_profile = collect();
        $beep_profile->push($data_fotokhs, $data_ipk, $data_user);
        $beep_profile = $beep_profile->collapse()->all();

        return view('sidebar.data_keluarga.index', compact(
            'data', 'data_kurang','beep_profile', 'beep_datarumah', 'beep_datakeluarga'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data_keluarga = DataKeluarga::find($id);

        $data = [
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'tanggungan_keluarga' => $request->tanggungan_keluarga,
            'nohp_ortu' => $request->nohp_ortu,
        ];

        $data_keluarga->update($data);

        return back()->with('success', 'Berhasil Merperbarui Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
