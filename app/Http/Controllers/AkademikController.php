<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beasiswa;
use App\Mahasiswa;
use App\Pendaftaran;
use App\DataKHS;
use App\Prodi;
use App\Semester;
use PDF;
use DB;

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
        $data = Pendaftaran::where('status', '>=', 3)->get();
        $kuota = Beasiswa::all();

        return view('sidebar.pengumuman.akademik-index', compact('data', 'kuota'));
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

        $data_khs = DataKHS::where('id_mahasiswa', $pendaftaran->id_mahasiswa)->orderBy('semester', 'ASC')->get();

        return view('sidebar.pengumuman.detail', compact('pendaftaran', 'data_khs'));
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
        $prodi = Prodi::all();
        $semester = Semester::all();
        $bea = null;
        $prod = null;
        $smstr = null;

        return view('sidebar.laporan.index', compact('data', 'beasiswa', 
                        'bea', 'prodi', 'semester', 'prod', 'smstr')); 
    }

    public function filter_laporan(Request $request)
    {
        if ($request->id_beasiswa == null) {
            $request->id_beasiswa = "";
        }
        if ($request->id_prodi == null) {
            $request->id_prodi = "";
        }
        if ($request->semester == null) {
            $request->semester = "";
        }

        $data = DB::table('pendaftaran')
            ->join('mahasiswa', 'pendaftaran.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('beasiswa', 'pendaftaran.id_beasiswa', '=', 'beasiswa.id')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id')
            ->where('id_beasiswa', 'like', '%' . $request->id_beasiswa . '%')
            ->where('mahasiswa.id_prodi', 'like', '%' . $request->id_prodi . '%')
            ->where('mahasiswa.semester', 'like', '%' . $request->semester . '%')
            ->select('pendaftaran.*', 'prodi.nama_prodi', 'beasiswa.nama_beasiswa', 'mahasiswa.nama', 'mahasiswa.ipk', 'mahasiswa.semester', 'mahasiswa.nim')
            ->orderBy('pendaftaran.id', 'DESC')->get();

        $beasiswa = Beasiswa::all();
        $prodi = Prodi::all();
        $semester = Semester::all();
        $wadir3 = User::find(1);
        $bea = $request->id_beasiswa;
        $prod = $request->id_prodi;
        $smstr = $request->semester;
        $data = [
            'datas' => $data,
            'wadir3' => $wadir3
        ];

        // return $data['data'];

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

        return view('sidebar.laporan.index', compact('data', 'beasiswa', 'bea', 'prodi',
                            'prod', 'semester', 'smstr')); 
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
