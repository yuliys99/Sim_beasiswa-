<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\DataKHS;
use App\Mahasiswa;
use App\User;
use App\DataRumah;
use App\DataKeluarga;

class DataKhsController extends Controller
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
        $this->validate($request, [
            'foto_khs'=> ['required','mimes:jpg,png','max:2024'],
            'ipk' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);

        $mahasiswa = Mahasiswa::where('id_user', auth()->user()->id )->first();

        $data = [
            'id_mahasiswa' => $mahasiswa->id,
            'ipk' => $request->ipk,
            'semester' => $request->semester,
        ];

        if ($file = $request->file('foto_khs')) {
            $nama_file = "Foto_khs_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Mahasiswa/KHS/', $nama_file);  
            $data['foto_khs'] = $nama_file;
        }

        $last_id = DataKHS::create($data)->id;

        return back()->with('success', 'Berhasil menambahkan data');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Request $request, $id)
    {
        
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $data_khs = DataKHS::where('id_mahasiswa', $mahasiswa->id)->orderBy('semester', 'DESC')->first();
        
        if ($data_khs) {
            $mahasiswa->update([
                'ipk' => $data_khs->ipk,
                'semester' => $data_khs->semester,
            ]);
        }

        $data = DataKHS::where('id_mahasiswa', $mahasiswa->id)->orderBy('semester', 'ASC')->get();

        $id = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $beep_datarumah = DataRumah::where('id_mahasiswa', $mahasiswa->id)->whereNull('kepemilikan_rumah')->first();
        $beep_datakeluarga = DataKeluarga::where('id_mahasiswa', $mahasiswa->id)->whereNull('nama_ayah')->first();

        // $data_fotokhs = Mahasiswa::where('id_user', $id)->whereNull('foto_khs')->get();
        $data_ipk = Mahasiswa::where('id_user', $id)->whereNull('ipk')->get();
        $data_user = User::where('id', $id)->whereNull('email')->get();

        $beep_profile = collect();
        $beep_profile->push( $data_ipk, $data_user);
        $beep_profile = $beep_profile->collapse()->all();

        return view('sidebar.mahasiswa.data_khs.index', compact(
                    'data','beep_profile', 'beep_datarumah', 'beep_datakeluarga'
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
        $data_khs = DataKHS::find($id);

        $data = [
            'semester' => $request->semester,
            'ipk' => $request->ipk,
        ];

        if ($file = $request->foto_khs){

            if ($mahasiswa->foto_khs) {
                File::delete('Images/Mahasiswa/KHS/' . $mahasiswa->foto_khs);
            }

            $nama_file = "Foto_khs_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Mahasiswa/KHS/', $nama_file);  
            $data['foto_khs'] = $nama_file;
        }

        $data_khs->update($data);

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
        
        $data_khs = DataKHS::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
