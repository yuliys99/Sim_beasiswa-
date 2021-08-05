@extends('layouts.admin-master')

@section('title')
Data Beasiswa
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card position-relative">
            <div class="card-body">
                <div class="row" style="align-items: center;">
                    <div class="col-10 stretch-card">
                        <h3 class="font-weight-bold ml-4"> {{$data->nama}}
                            @if ($data->status_bidikmisi == 1)
                            <p><br>Mahasiswa Bidikmisi</p>
                            @endif
                        </h3>
                    </div>
                    <div class="col-2">
                        <div class="justify-content-end d-flex mr-5">
                            <img src="{{ $data->user->ambilFotoProfile() }}" alt="foto profile" height="80px"
                                width="80px" class="rounded-circle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form class="forms-sample" method="POST" action="{{ route('mahasiswa.update-profile', ['id' => $data->id]) }}"
    enctype="multipart/form-data">
    {{csrf_field()}}
    {{ method_field('POST') }}
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Selamat datang di halaman profile anda </h4>
                    <p class="card-description">
                        @if($data_kurang)
                        <span class="alert alert-danger">Tolong lengkapi data !</span>
                        @endif
                    </p>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$data->nama}}" placeholder="Nama "
                            required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="{{$data->user->username}}"
                            placeholder="Username " required>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select class="form-control" name="prodi">
                            <option value="" selected disabled>- Prodi -</option>
                            @foreach ($prodi as $prodi)
                            <option value="{{ $prodi->id }}" @if($prodi->id == $data->id_prodi )
                                {{'selected="selected"'}} @endif>{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{$data->kelas}}"
                            placeholder="Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" name="semester" value="{{$data->semester}}"
                            placeholder="Semester" required>
                    </div>
                    <div class="form-group">
                        <label for="ipk">IPK</label>
                        <input type="text" class="form-control" name="ipk" value="{{$data->ipk}}" placeholder="IPK"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3">{{$data->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" class="form-control" name="no_hp" value="{{$data->no_hp}}"
                            placeholder="No Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No WhatsApp</label>
                        <input type="text" class="form-control" name="no_wa" value="{{$data->no_wa}}"
                            placeholder="No WhatsApp" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" value="{{$data->user->email}}"
                            placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" value="{{$data->nim}}" placeholder="NIM"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" value="{{$data->nik}}" placeholder="NIK"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="foto_profile">Ubah Foto Profile</label>
                        <input name="foto_profile" type="file" class="form-control">
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <img src="{{$data->ambilGambarKHS()}}" style="max-height: 80%; max-width: 80%" alt="foto Khs">
                    </div>
                    <div class="form-group">
                        <label for="foto_khs">Foto KHS</label>
                        <input type="file" class="form-control" value="{{$data->foto_khs}}" name="foto_khs">
                    </div>
                    <div class="form-group">
                        <label for="password">Ubah Password</label>
                        <p class="text-danger">Isi form ini jika ingin mengganti password</p>
                        <input type="password" class="form-control" name="password" placeholder="Ubah Password">
                    </div>
                    <div class="form-check">
                            <input type="hidden" class="form-control" name="mahasiswa_bidikmisi" value="{{$data->status_bidikmisi}}"
                                value="option4">
                    </div>
                    <a class="btn btn-light float-right" href="{{ route('mahasiswa.dashboard') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary mr-2 float-right">Update</button>

                </div>
            </div>
        </div>
    </div>
</form>

@endsection
