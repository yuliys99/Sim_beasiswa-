@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="background-color: white">
<div class="text-right mt-4 font-weight-light">
            <a href="{{ route('login')}}" class="text-white">
                <button class="btn btn-primary">Log in</button>
            </a>
        </div>

    <div class="row justify-content-center mt-5">
        
        <div class="col-md-8 stretch-card grid-margin">
            <div class="card data-icon-card-primary">
                <div class="card-body">
                    <p class="card-title text-white">Data Beasiswa</p>
                    <div class="row">
                        <div class="col-8 text-white">
                            <h3 class="pl-3">{{ $data->count() }}</h3>
                            <p class="text-white font-weight-500 mb-0">Jumlah total Beasiswa saat ini. dihitung sebagai jumlah.</p>
                        </div>
                        <div class="col-4 background-icon">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="display expandable-table table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Nama Beasiswa</th>
                                            <th>Tahun Perolehan</th>
                                            <th>Minimal IPK</th>
                                            <th>Jenis</th>
                                            <th>Kontrak Beasiswa</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_beasiswa }}</td>
                                            <td>{{ $data->tahun_perolehan }}</td>
                                            <td>{{ $data->min_ipk }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ $data->kontrak_beasiswa }}</td>
                                            <td width="20%">
                                                <a href="javascript:;" data-toggle="modal" onclick="daftarData({{$data->id}})" data-target="#DaftarModal">
                                                    <button class="btn btn-success btn-sm btn-icon-text">
                                                        <i class="ti-file btn-icon-prepend"></i>
                                                        <span class="d-inline-block text-left">
                                                            <small class="font-weight-light d-block">Daftar</small>
                                                            Beasiswa
                                                        </span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->

<div id="DaftarModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Beasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Silahkan Login Terlebih dahulu untuk Mendaftar Beasiswa ini ?</p>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <a href="{{ route('login') }}">
                        <button type="submit" name="" class="btn btn-success float-right mr-2">Login</button>
                    </a>
                </div>
            </div>
    </div>
</div>
<!-- partial:partials/_footer.html -->
<footer class="footer" style="bottom: 0; position: fixed; width:100%">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a
                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
            All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                class="ti-heart text-danger ml-1"></i></span>
    </div>
</footer>
<!-- partial -->
@endsection
