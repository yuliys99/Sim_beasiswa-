@extends('layouts.admin-master')

@section('title')
    Dashboard Mahasiswa
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card position-relative">
                            <div class="card-body">
                                <h3 class="font-weight-bold">Dashboard Mahasiswa </h3>
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
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-4">Info Beasiswa</p>
                                        <p class="fs-30 mb-2">{{ $info_beasiswa }}</p>
                                        <a href="{{ route('mahasiswa.pendaftaran-beasiswa', auth()->user()->id) }}">
                                            <p style="color: white;">Klik disini untuk info lebih lanjut</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Total Mendaftar Beasiswa</p>
                                        <p class="fs-30 mb-2">{{ $pengumuman }}</p>
                                        <a href="{{ route('mahasiswa.pengumuman', auth()->user()->id) }}">
                                            <p style="color: white;">Klik disini untuk info lebih lanjut</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <p class="mb-4"></p>
                                        <p class="fs-30 mb-2">34040</p>
                                        <p>2.00% (30 days)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <p class="mb-4">Number of Clients</p>
                                        <p class="fs-30 mb-2">47033</p>
                                        <p>0.22% (30 days)</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        
@endsection