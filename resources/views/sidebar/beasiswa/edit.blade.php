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
                            <h3 class="font-weight-bold ml-4">Edit Data Beasiswa </h3>
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
                    @if (auth()->user()->id_role == 2)
                        <form class="forms-sample" method="POST" action="{{ route('akademik-beasiswa.update', ['akademik_beasiswa' => $data->id]) }}" enctype="multipart/form-data">
                    @elseif (auth()->user()->id_role == 3)
                        <form class="forms-sample" method="POST" action="{{ route('beasiswa.update', ['beasiswa' => $data->id]) }}" enctype="multipart/form-data">
                    @endif
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="nama_beasiswa">Nama Beasiswa <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="nama_beasiswa" value="{{$data->nama_beasiswa}}" placeholder="Nama Beasiswa" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun_perolehan">Tahun Perolehan <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="tahun_perolehan" value="{{$data->tahun_perolehan}}" placeholder="Tahun Perolehan" required="">
                        </div>
                        <div class="form-group">
                            <label for="min_ipk">Minimal IPK <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="min_ipk" value="{{$data->min_ipk}}" maxlength="4" placeholder="Minimal IPK" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="jenis" value="{{$data->jenis}}" placeholder="Jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="kontrak_beasiswa">Kontrak Beasiswa <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" name="kontrak_beasiswa" value="{{$data->kontrak_beasiswa}}" placeholder="Kontrak Beasiswa" required>
                        </div>
                        <div class="form-group">
                            <label for="persyaratan">Persyaratan</label>
                            <input type="file" class="form-control" name="persyaratan">
                        </div>
                        <a class="btn btn-light float-right" href="{{ route('beasiswa.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary mr-2 float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
