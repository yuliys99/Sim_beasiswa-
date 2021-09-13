<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beasiswa;
use App\Mahasiswa;
use PDF;
use App\Pendaftaran;
use DB;

class Wadir3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find('1');
        $info_beasiswa = Beasiswa::all()->count();
        $jumlah_mahasiswa = Mahasiswa::all()->count();
        $mahasiswa_penerima_beasiswa = Pendaftaran::where('status', 5)->count();
        
        return view('role.wadir3.index', compact('user', 'info_beasiswa', 'jumlah_mahasiswa', 'mahasiswa_penerima_beasiswa'));
    }

    public function laporan()
    {
        $data = DB::table('pendaftaran')
            ->join('mahasiswa', 'pendaftaran.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('beasiswa', 'pendaftaran.id_beasiswa', '=', 'beasiswa.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->select('pendaftaran.*', 'prodi.nama_prodi', 'beasiswa.nama_beasiswa', 'mahasiswa.nama', 'mahasiswa.ipk', 'mahasiswa.semester', 'mahasiswa.nim')
            ->orderBy('pendaftaran.id', 'DESC')->get();
        
        
        $beasiswa = Beasiswa::all();
        $bea = null;
        
        return view('sidebar.laporan.index', compact('data', 'bea', 'beasiswa')); 
    }

    public function filter_laporan(Request $request)
    {
        $data = Pendaftaran::where('status', 5)->where('id_beasiswa', 'like', '%' . $request->id_beasiswa . '%')->orderBy('id', 'DESC')->get();
        $beasiswa = Beasiswa::all();
        $bea = $request->id_beasiswa;
        
        if($request->input('cetakPdf')){

            view()->share('data',$data);
            $pdf = PDF::loadView('sidebar/laporan/cetak_pdf', $data)->setPaper('a4');
            // $canvas = getCanvas();
            // $canvas->page_script('
            //     $pdf->set_opacity(.5);
            //     $pdf->image(public_path());
            // ');
            // download PDF file with download method
            return $pdf->stream('sidebar/laporan/cetak_pdf', array('Attachment' => 0));
        }

        return view('sidebar.laporan.index', compact('data', 'beasiswa', 'bea')); 
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        $user = User::find('1');

        $user->update([
            'nama' => $request->nama
        ]);

        return back()->with('success', 'Berhasil merubah data');
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
