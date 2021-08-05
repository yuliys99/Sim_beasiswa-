<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Beasiswa;
use App\Pendaftaran;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data = Beasiswa::orderBy('id', 'DESC')->get();

        return view('sidebar.beasiswa.index', compact('data'));
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
            'min_ipk' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);
        $data = [
            'nama_beasiswa' => $request->nama_beasiswa,
            'tahun_perolehan' => $request->tahun_perolehan,
            'min_ipk' => $request->min_ipk,
            'jenis' => $request->jenis,
            'kontrak_beasiswa' => $request->kontrak_beasiswa,
        ]; 

        if ($file = $request->file('persyaratan')) {
            $nama_file = 'Persayaratan_'. time() . $file->getClientOriginalName();
            $file->move(public_path() . '/File/Beasiswa/Persyaratan/', $nama_file);  
            $data['persyaratan'] = $nama_file;
        }

        Beasiswa::create($data);
        
        return redirect()->route('beasiswa.index')->with('success', 'Data Beasiswa '. $request->nama_beasiswa .' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Beasiswa::find($id);
        return view('sidebar.beasiswa.edit', compact('data'));
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
        $this->validate($request, [
            'min_ipk' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);

        $beasiswa = Beasiswa::find($id);

        $data = [
            'nama_beasiswa' => $request->nama_beasiswa,
            'tahun_perolehan' => $request->tahun_perolehan,
            'min_ipk' => $request->min_ipk,
            'jenis' => $request->jenis,
            'kontrak_beasiswa' => $request->kontrak_beasiswa,
        ];

        if ($file = $request->persyaratan){

            if ($beasiswa->persyaratan) {
                File::delete('File/Beasiswa/Persyaratan/' . $beasiswa->persyaratan);
            }

            $nama_file = 'Persyaratan_' . time() . $file->getClientOriginalName();
            $file->move(public_path() . '/File/Beasiswa/Persyaratan/', $nama_file);  
            $data['persyaratan'] = $nama_file;
        }

        $beasiswa->update($data);

        return redirect()->back()->with('success', 'Berhasil Merubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beasiswa = Beasiswa::find($id);

        $pendaftaran = Pendaftaran::where('id_beasiswa', $id)->first();
        if($pendaftaran){

            return redirect()->back()->with('error', 'Tidak dapat menghapus data karena sudah ada mahasiswa yang mendaftar beasiswa ini');
        }
        $beasiswa->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
