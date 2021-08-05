<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use App\DataRumah;
use App\DataKeluarga;
use File;


class DataRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $data = DataRumah::where('id_mahasiswa', $mahasiswa->id)->first();

        $data_kurang = DataRumah::where('id_mahasiswa', $mahasiswa->id)->whereNull('kepemilikan_rumah')->first();

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

        return view('sidebar.data_rumah.index', compact(
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
        $data_rumah = DataRumah::find($id);

        $data = [
            'kepemilikan_rumah' => $request->kepemilikan_rumah,
            'thn_perolehan' => $request->thn_perolehan,
            'daya_listrik' => $request->daya_listrik,
            'luas_tanah_bangunan' => $request->luas_tanah_bangunan,
            'bahan_atap' => $request->bahan_atap,
            'bahan_lantai' => $request->bahan_lantai,
            'bahan_tembok' => $request->bahan_tembok,
            'aset_keluarga' => $request->aset_keluarga,
            'prestasi' => $request->prestasi,
        ];

        if ($file = $request->foto_rumah){

            if ($data_rumah->foto_rumah) {
                File::delete('Images/Mahasiswa/Foto_Rumah/' . $data_rumah->foto_rumah);
            }

            $nama_file = "Foto_rumah_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Mahasiswa/Foto_Rumah/', $nama_file);  
            $data['foto_rumah'] = $nama_file;
        }

        $data_rumah->update($data);

        return back()->with('success', 'Berhasil Memperbarui Data');
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
