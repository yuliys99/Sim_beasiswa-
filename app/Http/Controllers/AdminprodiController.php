<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beasiswa;
use App\Mahasiswa;
use App\Pendaftaran;

class AdminprodiController extends Controller
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
        $mahasiswa_baru_daftar = Pendaftaran::where('status', 1)->count();
        
        return view('role.admin_prodi.index', compact('info_beasiswa', 'jumlah_mahasiswa', 'mahasiswa_baru_daftar'));
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
    
    public function pengumuman()
    {
        $data = Pendaftaran::where('status', '<=', 3)->orderBy('id', 'DESC')->get();
        
        return view('sidebar.pengumuman.admin-index', compact('data'));
    }

    public function pengumuman_edit(Request $request ,$id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $data = [
            'status' => $request->status
        ];

        $pendaftaran->update($data);

        return back()->with('success', 'Berhasil Merubah Data');
    }

    public function pengumuman_detail($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        return view('sidebar.pengumuman.detail', compact('pendaftaran'));
    }
}
