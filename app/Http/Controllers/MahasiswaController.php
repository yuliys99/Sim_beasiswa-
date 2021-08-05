<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Mahasiswa;
use App\Beasiswa;
use App\User;
use App\Prodi;
use App\DataRumah;
use App\DataKeluarga;
use App\Pendaftaran;

class MahasiswaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function dashboard()
    {
        $mahasiswa = Mahasiswa::where('id_user', auth()->user()->id)->first();
        $info_beasiswa = Beasiswa::all()->count();
        $pengumuman = Pendaftaran::where('id_mahasiswa', $mahasiswa->id)->count();

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

        return view('role.mahasiswa.index', compact(
            'info_beasiswa', 'pengumuman', 'mahasiswa',
            'beep_profile', 'beep_datarumah', 'beep_datakeluarga'
        ));
    }

    public function profile($id)
    {
        $data = Mahasiswa::where('id_user', $id)->first();
        $prodi = Prodi::orderBy('nama_prodi', 'ASC')->get();

        $data_fotokhs = Mahasiswa::where('id_user', $id)->whereNull('foto_khs')->get();
        $data_ipk = Mahasiswa::where('id_user', $id)->whereNull('ipk')->get();

        $data_user = User::where('id', $id)->whereNull('email')->get();
        $data_kurang = collect();
        $data_kurang->push($data_fotokhs, $data_ipk, $data_user);
        $data_kurang = $data_kurang->collapse()->all();

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

        return view('sidebar.mahasiswa.profile', compact(
            'data','data_kurang', 'prodi',
            'beep_profile', 'beep_datarumah', 'beep_datakeluarga'
        ));
    }

    public function index()
    {
        $data = Mahasiswa::orderBy('id', 'DESC')->get();
        $prodi = Prodi::orderBy('nama_prodi', 'ASC')->get();
        return view('sidebar.mahasiswa.index', compact('data', 'prodi'));
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
        $cekUsername = User::where('username', $request->username)->first();

        if ($cekUsername) {
            return back()->with('error', 'Username yang anda gunakan sudah terdaftar');
        }

        $this->validate($request, [
            'ipk' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);

        $data_user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->nim),
            'id_role' => 4,
        ];

        $last_id = User::create($data_user)->id;

        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'kelas' => $request->kelas,
            'ipk' => $request->ipk,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_wa' => $request->no_wa,
            'id_prodi' => $request->prodi,
            'id_user' => $last_id,
            'status_bidikmisi' => $request->mahasiswa_bidikmisi
        ];

        
        if ($file = $request->file('foto_khs')) {
            $nama_file = "Foto_khs_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Mahasiswa/KHS/', $nama_file);  
            $data['foto_khs'] = $nama_file;
        }

        $last_id = Mahasiswa::create($data)->id;
        DataRumah::create(['id_mahasiswa' => $last_id]);
        DataKeluarga::create(['id_mahasiswa' => $last_id]);

        return back()->with('success', 'Berhasil tambah data dengan password sesuai NIM (' .$request->nim. ')');
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
        $data = Mahasiswa::find($id);
        $prodi = Prodi::orderBy('nama_prodi', 'ASC')->get();

        return view('sidebar.mahasiswa.edit', compact('data', 'prodi'));
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
        $mahasiswa = Mahasiswa::find($id);
        $user = User::find($mahasiswa->id_user);
        
        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'kelas' => $request->kelas,
            'ipk' => $request->ipk,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_wa' => $request->no_wa,
            'id_prodi' => $request->prodi,
            'status_bidikmisi' => $request->mahasiswa_bidikmisi
        ];

        $data_user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if($request->password != null){
            $data_user['password'] = bcrypt($request->password);
        }

        if ($file = $request->foto_profile){

            if ($user->foto_profile) {
                File::delete('Images/Profile/' . $user->foto_profile);
            }

            $nama_file = "Foto_Profile_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Profile/', $nama_file);  
            $data_user['foto'] = $nama_file;
        }

        
        if ($file = $request->foto_khs){

            if ($mahasiswa->foto_khs) {
                File::delete('Images/Mahasiswa/KHS/' . $mahasiswa->foto_khs);
            }

            $nama_file = "Foto_khs_".time(). ".jpeg";
            $file->move(public_path() . '/Images/Mahasiswa/KHS/', $nama_file);  
            $data['foto_khs'] = $nama_file;
        }

        $user->update($data_user);
        $mahasiswa->update($data);

        return back()->with('success', 'Berhasil Edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::find($mahasiswa->id_user);

        $mahasiswa->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

    public function pendaftaran_beasiswa($id)
    {
        $beasiswa = Beasiswa::orderBy('nama_beasiswa', 'ASC')->get();
        
        $data_mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $data_fotokhs = Mahasiswa::where('id_user', $id)->whereNull('foto_khs')->get();
        $data_ipk = Mahasiswa::where('id_user', $id)->whereNull('ipk')->get();

        $data_user = User::where('id', $id)->whereNull('email')->get();
        $data_kurang = collect();
        $data_kurang->push($data_fotokhs, $data_ipk, $data_user);
        $data_kurang = $data_kurang->collapse()->all();

        $data_rumah = DataRumah::where('id_mahasiswa', $data_mahasiswa->id)->first();
        $data_keluarga = DataKeluarga::where('id_mahasiswa', $data_mahasiswa->id)->first();

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

        return view('sidebar.pendaftaran_beasiswa.index', compact(
            'beasiswa', 'data_kurang',
            'beep_profile', 'beep_datarumah', 'beep_datakeluarga'
        ));
    }

    public function do_pendaftaran_beasiswa(Request $request, $id)
    {
        $beasiswa = Beasiswa::find($id);
        $mahasiswa = Mahasiswa::where('id_user', $request->id_user)->first();
        $pendaftaran = Pendaftaran::where('id_beasiswa', $id)->where('id_mahasiswa', $mahasiswa->id)->first();
        $mahasiswa_bidikmisi = Mahasiswa::where('id_user', $request->id_user)->where('status_bidikmisi', 1)->first();

        if ($mahasiswa->ipk <= $beasiswa->min_ipk) {
            return back()->with('error', 'Mohon maaf, Ipk mu tidak memenuhi syarat untuk mendaftar beasiswa ini');
        } elseif ($pendaftaran) {
            return back()->with('error', 'Kamu sudah mendaftar beasiswa ini');
        } elseif ($mahasiswa_bidikmisi) {
            return back()->with('error', 'Kamu Mahasiswa Bidikmisi');
        } else{

            $data_rumah = DataRumah::where('id_mahasiswa', $mahasiswa->id)->first();
            $data_keluarga = DataKeluarga::where('id_mahasiswa', $mahasiswa->id)->first();
            
            $data = [
                'id_mahasiswa' => $mahasiswa->id,
                'id_data_keluarga' => $data_keluarga->id,
                'id_data_rumah' => $data_rumah->id,
                'id_beasiswa' => $id,
                'status' => 1
            ];
            
            if ($file = $request->file('persyaratan')) {
                $nama_file = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/File/Mahasiswa/Persyaratan/', $nama_file);  
                $data['persyaratan'] = $nama_file;
            }

            Pendaftaran::create($data);
            
            return redirect()->route('mahasiswa.pengumuman', $request->id_user)->with('success', 'Berhasil Mendaftar Beasiswa');
        }
    }

    public function pengumuman($id)
    {
        $mahasiswa = Mahasiswa::where('id_user', $id)->first();
        $data = Pendaftaran::where('id_mahasiswa', $mahasiswa->id)->orderBy('id', 'DESC')->get();
        
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

        return view('sidebar.pengumuman.index', compact(
            'data','beep_profile', 'beep_datarumah', 'beep_datakeluarga'
        ));
    }
}
