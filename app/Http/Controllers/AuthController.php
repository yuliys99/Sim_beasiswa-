<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Mahasiswa;
use App\DataRumah;
use App\DataKeluarga;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('username', $request->email)->orWhere('email', $request->email)->first();

        if(Auth::attempt($login)){
            
            if(auth()->user()->id_role == 4){
                return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil login, Selamat datang '. $user->nama);
            }
            elseif (auth()->user()->id_role == 3) {
                return redirect()->route('admin-prodi.index')->with('success', 'Berhasil login, Selamat datang');
            }
            elseif (auth()->user()->id_role == 2){
                return redirect()->route('akademik.index')->with('success', 'Berhasil login, Selamat datang');
            }
            elseif (auth()->user()->id_role == 1){
                return redirect()->route('wadir3.index')->with('success', 'Berhasil login, Selamat datang');
            }
        }
        return redirect()->route('login')->with('error', 'Username atau password salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $cekemail = User::where('email', $request->email)->first();
        $ceknim = Mahasiswa::where('nim', $request->nim)->first();

        if ($cekemail) {
            return back()->with('error', 'Email yang anda gunakan sudah terdaftar');
        } elseif ($ceknim) {
            return back()->with('error', 'Nim yang anda gunakan sudah terdaftar');
        } elseif ($request->password) {
            $this->validate($request, [
                'password'  => 'min:6 | required',
                ]);
        }
        
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'id_role' => '4',
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $lastid = User::create($data)->id;

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->id_user = $lastid;
        $mahasiswa->save();

        DataRumah::create(['id_mahasiswa' => $mahasiswa->id]);
        DataKeluarga::create(['id_mahasiswa' => $mahasiswa->id]);

        return redirect()->route('login')->with('success', 'Selamat Berhasil Membuat Akun, Silahkan Login disini');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
