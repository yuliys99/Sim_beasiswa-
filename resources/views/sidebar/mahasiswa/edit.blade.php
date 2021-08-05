@extends('layouts.admin-master')

@section('title')
    Edit Data Beasiswa
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 stretch-card">
                            <h3 class="font-weight-bold ml-4">Edit Data Mahasiswa </h3>
                            {{-- <h5 class="font-weight-normal">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h5> --}}
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
    
    @error('min_ipk')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Basic form elements</h4>
                    <p class="card-description">
                        Basic form elements
                    </p> --}}
                    <form class="forms-sample" method="POST" action="{{ route('mahasiswa.update', ['mahasiswa' => $data->id]) }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="nama">Nama <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}" placeholder="Nama " required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="username" value="{{$data->user->username}}" placeholder="Username " readonly>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="nim" value="{{$data->nim}}" placeholder="NIM" required="">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="nik" value="{{$data->nik}}" maxlength="4" placeholder="NIK" required>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi <a class="text-danger">*</a></label>
                            <select class="form-control" name="prodi">
                                <option value="" selected disabled>- Prodi -</option>
                                @foreach ($prodi as $prodi)
                                    <option value="{{ $prodi->id }}"  @if($prodi->id == $data->id_prodi ) {{'selected="selected"'}} @endif>{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="kelas" value="{{$data->kelas}}" placeholder="Kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="semester" value="{{$data->semester}}" placeholder="Semester" required>
                        </div>
                        <div class="form-group">
                            <label for="ipk">IPK <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="ipk" value="{{$data->ipk}}" placeholder="IPK" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_khs">Foto KHS <a class="text-danger">*</a></label>
                            <input type="file" class="form-control" name="foto_khs" value="{{$data->foto_khs}}" placeholder="Foto KHS">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat <a class="text-danger">*</a></label>
                            <textarea class="form-control" name="alamat" rows="3">{{$data->alamat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Telepon <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="no_hp" value="{{$data->no_hp}}" placeholder="No Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="no_wa">No WhatsApp <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="no_wa" value="{{$data->no_wa}}" placeholder="No WhatsApp" required>
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" name="mahasiswa_bidikmisi" value="1" class="form-check-input">
                                Mahasiswa Bidikmisi
                                <i class="input-helper"></i></label>
                        </div>
                        <a class="btn btn-light float-right" href="{{ route('mahasiswa.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary mr-2 float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
