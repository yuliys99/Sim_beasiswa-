<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beasiswa;
use App\Mahasiswa;
use App\Pendaftaran;
use PDF;

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $info_beasiswa = Beasiswa::all()->count();
        $jumlah_mahasiswa = Mahasiswa::all()->count();
        $mahasiswa_rekomendasi = Pendaftaran::where('status', 3)->count();
        $mahasiswa_penerima_beasiswa = Pendaftaran::where('status', 5)->count();
        
        return view('role.akademik.index', compact(
            'info_beasiswa', 'mahasiswa_penerima_beasiswa',
            'jumlah_mahasiswa', 
            'mahasiswa_rekomendasi'
        ));
    }

    public function calon_penerima_beasiswa()
    {
        $data = Pendaftaran::where('status', 3)->get();

        return view('sidebar.pengumuman.akademik-index', compact('data'));
    }

    

    public function calon_penerima_beasiswa_edit(Request $request ,$id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $data = [
            'status' => $request->status
        ];

        $pendaftaran->update($data);

        return back()->with('success', 'Berhasil Merubah Data');
    }

    public function calon_penerima_beasiswa_detail($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        return view('sidebar.pengumuman.detail', compact('pendaftaran'));
    }

    public function laporan()
    {
        $data = Pendaftaran::where('status', 5)->orderBy('id', 'DESC')->get();
        $beasiswa = Beasiswa::all();
        $bea = null;
        return view('sidebar.laporan.index', compact('data', 'beasiswa', 'bea')); 
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
    public function update(Request $request, $id)
    {
        //
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
