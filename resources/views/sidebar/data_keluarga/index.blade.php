@extends('layouts.admin-master')

@section('title')
Data Beasiswa
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card position-relative">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 stretch-card">
                        <h3 class="font-weight-bold ml-4">Data Keluarga </h3>
                        {{-- <h5 class="font-weight-normal">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h5> --}}
                    </div>
                    <div class="col-5">
                        <div class="justify-content-end d-flex">
                            {{$data->mahasiswa->nama}}
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


<form class="forms-sample" method="POST" action="{{ route('datakeluarga-mahasiswa.update', $data->id) }}"
    enctype="multipart/form-data">
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Silahkan isi data dibawah ini ! </h4>
                    <p class="card-description">
                        @if($data_kurang)
                        <span class="alert alert-danger">Tolong lengkapi data !</span>
                        @endif
                    </p>
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="nama_ayah"
                            value="{{$data->nama_ayah}}" placeholder="Nama Ayah " required>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="pekerjaan_ayah" value="{{$data->pekerjaan_ayah}}"
                            placeholder="Pekerjaan Ayah " required>
                    </div>
                    <div class="form-group">
                        <label for="penghasilan_ayah">Penghasilan Ayah <a class="text-danger">*</a></label>
                        <select class="form-control" name="penghasilan_ayah">
                            <option value="" selected disabled>- Penghasilan Ayah -</option>
                            <option value="- > 1.000.000" @if("- > 1.000.000" == $data->penghasilan_ayah )
                                {{'selected="selected"'}} @endif>- > 500.000</option>
                            <option value="1.000.000 > 2.000.000" @if("1.000.000 > 2.000.000"==$data->penghasilan_ayah )
                                {{'selected="selected"'}} @endif>1.000.000 > 2.000.000</option>
                            <option value="2.000.000 > 3.000.000" @if("2.000.000 > 3.000.000"==$data->penghasilan_ayah )
                                {{'selected="selected"'}} @endif>2.000.000 > 3.000.000</option>
                            <option value="3.000.000 > -" @if("3.000.000 > -"==$data->penghasilan_ayah )
                                {{'selected="selected"'}} @endif>3.000.000 > -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggungan_keluarga">Tanggungan Keluarga <a class="text-danger">*</a></label>
                        <input type="number" class="form-control" name="tanggungan_keluarga" value="{{$data->tanggungan_keluarga}}"
                            placeholder="Tanggungan Keluarga " required>
                    </div>
                    <div class="form-group">
                        <label for="nohp_ortu">No Hp Orang Tua <a class="text-danger">*</a></label>
                        <input type="number" class="form-control" name="nohp_ortu" value="{{$data->nohp_ortu}}"
                            placeholder="No Hp Orang Tua " required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="nama_ibu"
                            value="{{$data->nama_ibu}}" placeholder="Nama Ibu " required>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="pekerjaan_ibu" value="{{$data->pekerjaan_ibu}}"
                            placeholder="Pekerjaan Ibu " required>
                    </div>
                    <div class="form-group">
                        <label for="penghasilan_ibu">Penghasilan Ibu <a class="text-danger">*</a></label>
                        <select class="form-control" name="penghasilan_ibu">
                            <option value="" selected disabled>- Penghasilan Ibu -</option>
                            <option value="- > 1.000.000" @if("- > 1.000.000" == $data->penghasilan_ibu )
                                {{'selected="selected"'}} @endif>- > 500.000</option>
                            <option value="1.000.000 > 2.000.000" @if("1.000.000 > 2.000.000"==$data->penghasilan_ibu )
                                {{'selected="selected"'}} @endif>1.000.000 > 2.000.000</option>
                            <option value="2.000.000 > 3.000.000" @if("2.000.000 > 3.000.000"==$data->penghasilan_ibu )
                                {{'selected="selected"'}} @endif>2.000.000 > 3.000.000</option>
                            <option value="3.000.000 > -" @if("3.000.000 > -"==$data->penghasilan_ibu )
                                {{'selected="selected"'}} @endif>3.000.000 > -</option>
                        </select>
                    </div>
                    {{-- <a class="btn btn-light float-right" href="{{ route('datarumah-mahasiswa.index') }}">Kembali</a> --}}
                    <button type="submit" class="btn btn-primary mr-2 float-right">Update</button>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
