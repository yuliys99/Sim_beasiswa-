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
                        <h3 class="font-weight-bold ml-4">Data Rumah </h3>
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


<form class="forms-sample" method="POST" action="{{ route('datarumah-mahasiswa.update', $data->id) }}"
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
                        <label for="kepemilikan_rumah">Kepemilikan Rumah <a class="text-danger">*</a></label>
                        <select class="form-control" name="kepemilikan_rumah" required>
                            <option value="" selected disabled>- Pilih Kepemilikan Rumah -</option>
                            <option value="Milik Orang Tua" @if("Milik Orang Tua"==$data->kepemilikan_rumah )
                                {{'selected="selected"'}} @endif>Milik Orang Tua</option>
                            <option value="Milik Sendiri" @if("Milik Sendiri"==$data->kepemilikan_rumah )
                                {{'selected="selected"'}} @endif>Milik Sendiri</option>
                            <option value="Sewa/Kos" @if("Sewa/Kos"==$data->kepemilikan_rumah )
                                {{'selected="selected"'}} @endif>Sewa/Kos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="thn_perolehan">Tahun Perolehan <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="thn_perolehan" value="{{$data->thn_perolehan}}"
                            placeholder="Tahun Perolehan " required>
                    </div>
                    <div class="form-group">
                        <label for="luas_tanah_bangunan">Luas Tanah Bangunan <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="luas_tanah_bangunan"
                            value="{{$data->luas_tanah_bangunan}}" placeholder="Luas Tanah Bangunan " required>
                    </div>
                    <div class="form-group">
                        <label for="daya_listrik">Daya Listrik <a class="text-danger">*</a></label>
                        <select class="form-control" name="daya_listrik">
                            <option value="" selected disabled>- Daya Listrik -</option>
                            <option value="daya 900 VA, Rp 1.352 per kWh" @if("daya 900 VA, Rp 1.352 per kWh"==$data->daya_listrik )
                                {{'selected="selected"'}} @endif>daya 900 VA, Rp 1.352 per kWh</option>
                            <option value="daya 1.300 VA, Rp 1.444,70 per kWh" @if("daya 1.300 VA, Rp 1.444,70 per kWh"==$data->daya_listrik )
                                {{'selected="selected"'}} @endif>daya 1.300 VA, Rp 1.444,70 per kWh</option>
                            <option value="daya 2.200 VA, Rp 1.444,70 per kWh" @if("daya 2.200 VA, Rp 1.444,70 per kWh"==$data->daya_listrik )
                                {{'selected="selected"'}} @endif>daya 2.200 VA, Rp 1.444,70 per kWh</option>
                            <option value="daya 3.500-5.500 VA, Rp 1.444,70 per kWh" @if("daya 3.500-5.500 VA, Rp 1.444,70 per kWh"==$data->daya_listrik )
                                {{'selected="selected"'}} @endif>daya 3.500-5.500 VA, Rp 1.444,70 per kWh</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aset_keluarga">Aset Keluarga <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="aset_keluarga" value="{{$data->aset_keluarga}}"
                            placeholder="Aset Keluarga " required>
                    </div>
                    <div class="form-group">
                        <label for="prestasi">Prestasi <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="prestasi" value="{{$data->prestasi}}"
                            placeholder="Prestasi " required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="form-group" style="text-align: center;">
                        <img src="{{$data->ambilGambarRumah()}}"  style="max-height:350px ;max-width:100%;"  alt="foto rumah">
                    </div>
                    <div class="form-group">
                        <label for="foto_rumah">Foto Rumah <a class="text-danger">*</a></label>
                        <input type="file" class="form-control" value="{{$data->foto_rumah}}" name="foto_rumah">
                    </div>
                    <div class="form-group">
                        <label for="bahan_atap">Bahan Atap <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="bahan_atap" value="{{$data->bahan_atap}}"
                            placeholder="Bahan Atap" required>
                    </div>
                    <div class="form-group">
                        <label for="bahan_lantai">Bahan Lantai <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="bahan_lantai" value="{{$data->bahan_lantai}}"
                            placeholder="Bahan Lantai" required>
                    </div>
                    <div class="form-group">
                        <label for="bahan_tembok">Bahan Tembok <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" name="bahan_tembok" value="{{$data->bahan_tembok}}"
                            placeholder="Bahan Tembok" required>
                    </div>
                    {{-- <a class="btn btn-light float-right" href="{{ route('datarumah-mahasiswa.index') }}">Kembali</a> --}}
                    <button type="submit" class="btn btn-primary mr-2 float-right">Update</button>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
