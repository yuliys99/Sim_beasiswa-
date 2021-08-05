@extends('layouts.admin-master')

@section('title')
Detail Data Pendaftar
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card position-relative">
            <div class="card-body">
                <div class="row">
                    <div class="col-10 stretch-card">
                        <h3 class="font-weight-bold ml-4">Detail Pendaftar </h3>
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
                <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <h4 class="p-2">Nama Mahasiswa : {{ $pendaftaran->mahasiswa->nama }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">NIM : {{ $pendaftaran->mahasiswa->nim }}</h4>
                                    <h4 class="p-2">NIK : {{ $pendaftaran->mahasiswa->nik }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Prodi : {{ $pendaftaran->mahasiswa->prodi->nama_prodi }}</h4>
                                    <h4 class="p-2">Kelas : {{ $pendaftaran->mahasiswa->kelas }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Semester : {{ $pendaftaran->mahasiswa->semester }}</h4>
                                    <h4 class="p-2">Alamat : {{ $pendaftaran->mahasiswa->alamat }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="p-2">IPK : <mark class="bg-warning text-white">{{ $pendaftaran->mahasiswa->ipk }}</mark></h4>
                                    <h4 class="p-2 bg-dark text-white ">Foto KHS : </h4>
                                    <img class="mb-3" src="{{$pendaftaran->mahasiswa->ambilGambarKHS()}}" style="max-height:750px ;max-width:100%;"  alt="foto Khs">
                                    <h4 class="p-2">No WhatsApp : {{ $pendaftaran->mahasiswa->no_wa }}</h4>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <h4 class="p-2 bg-dark text-white ">Nama Ayah : {{ $pendaftaran->data_keluarga->nama_ayah }}</h4>
                                    <h4 class="p-2">Pekerjaan Ayah : {{ $pendaftaran->data_keluarga->pekerjaan_ayah }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Penghasilan Ayah : {{ $pendaftaran->data_keluarga->penghasilan_ayah }}</h4>
                                    <h4 class="p-2">Tanggungan Keluarga : {{ $pendaftaran->data_keluarga->tanggungan_keluarga }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Nomer Hp Orang Tua : {{ $pendaftaran->data_keluarga->nohp_ortu }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="p-2 bg-dark text-white ">Nama Ibu : {{ $pendaftaran->data_keluarga->nama_ibu }}</h4>
                                    <h4 class="p-2">Pekerjaan Ibu : {{ $pendaftaran->data_keluarga->pekerjaan_ibu }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Penghasilan Ibu : {{ $pendaftaran->data_keluarga->penghasilan_ibu }}</h4>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <h4 class="p-2">Kepemilikan Rumah : {{ $pendaftaran->data_rumah->kepemilikan_rumah }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Tahun Perolehan : {{ $pendaftaran->data_rumah->thn_perolehan }}</h4>
                                    <h4 class="p-2">Luas Tanah Bangunan : {{ $pendaftaran->data_rumah->luas_tanah_bangunan }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Daya Listrik : {{ $pendaftaran->data_rumah->daya_listrik }}</h4>
                                    <h4 class="p-2">Aset Keluarga : {{ $pendaftaran->data_rumah->aset_keluarga }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Prestasi : {{ $pendaftaran->data_rumah->prestasi }}</h4>
                                </div>
                                <div class="col-md-6">
                                    {{-- <h4 class="p-2">IPK : <mark class="bg-warning text-white">{{ $pendaftaran->mahasiswa->ipk }}</mark></h4> --}}
                                    <h4 class="p-2">Foto Rumah : </h4>
                                    <img class="mb-3" src="{{$pendaftaran->data_rumah->ambilGambarRumah()}}" style="max-height:350px ;max-width:100%;" alt="foto Khs">
                                    <h4 class="p-2 bg-dark text-white ">Bahan Atap : {{ $pendaftaran->data_rumah->bahan_atap }}</h4>
                                    <h4 class="p-2">Bahan Lantai : {{ $pendaftaran->data_rumah->bahan_lantai }}</h4>
                                    <h4 class="p-2 bg-dark text-white ">Bahan Tembok : {{ $pendaftaran->data_rumah->bahan_tembok }}</h4>
                                    
                                </div>
                                
                            </div>

                            <a class="btn btn-primary float-right" href="{{ url()->previous() }}">Kembali</a>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
