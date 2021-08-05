@extends('layouts.admin-master')

@section('title')
    Dashboard Wadir III
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card position-relative">
                        <div class="card-body">
                            <h3 class="font-weight-bold">Dashboard Wadir III </h3>
                            <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                    class="text-primary">3 unread alerts!</span></h6>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin transparent">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Info Beasiswa</p>
                                    <p class="fs-30 mb-2">{{ $info_beasiswa }}</p>
                                    <a href="{{ route('wadir3-beasiswa.index') }}">
                                        <p style="color: white;">Klik disini untuk info lebih lanjut</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Jumlah Mahasiswa</p>
                                    <p class="fs-30 mb-2">{{ $jumlah_mahasiswa }}</p>
                                    <a href="#">
                                        <p style="color: white;">Klik disini untuk info lebih lanjut</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Mahasiswa Penerima Beasiswa</p>
                                    <p class="fs-30 mb-2">{{ $mahasiswa_penerima_beasiswa }}</p>
                                    <a href="{{ route('wadir3.laporan') }}">
                                        <p style="color: white;">Klik disini untuk info lebih lanjut</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection