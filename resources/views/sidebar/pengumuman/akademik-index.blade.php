@extends('layouts.admin-master')

@section('title')
    Data Pengumuman Beasiswa
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card position-relative">
                            <div class="card-body">
                                <h3 class="font-weight-bold">Halaman Rekomendasi Mahasiswa Dari Prodi</h3>
                                {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                        class="text-primary">3 unread alerts!</span></h6> --}}
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table id="dataTables" class="display expandable-table table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>IPK</th>
                                            <th>Nama Beasiswa</th>
                                            <th>File Persyaratan</th>
                                            <th>Tanggal Mendaftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach ($data as $data)
                                        <tr>
                                            <td style="text-align:center">{{ $no++ }}</td>
                                            <td>{{ $data->mahasiswa->nama }}</td>
                                            <td>{{ $data->mahasiswa->nim }}</td>
                                            <td>{{ $data->mahasiswa->ipk }}</td>
                                            <td>{{ $data->beasiswa->nama_beasiswa }}</td>
                                            <td>
                                                <a target="_blank" href="{{$data->ambilFilePersyaratan()}}">{{$data->persyaratan}}</a>    
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                            <td style="text-align:center">
                                                @if ($data->status == 1)
                                                    <div class="badge badge-warning" style="color: white">Diperiksa</div>
                                                @elseif ($data->status == 2)
                                                    <div class="badge badge-danger">Gagal</div>
                                                @elseif ($data->status == 3)
                                                    <div class="badge badge-success">Direkomendasikan</div>
                                                @elseif ($data->status == 5)
                                                    <div class="badge badge-success">Diterima</div>
                                                @endif
                                            </td>
                                            <td style="width:20%; text-align:center">
                                                <a href="{{ route('akademik.calon_penerima_beasiswa-detail', $data->id) }}">
                                                    <button class="btn btn-warning ti-eye"
                                                        title="Detail"></button>
                                                </a>
                                                <a href="javascript:;" data-toggle="modal" onclick="TerimaData({{$data->id}})" data-target="#TerimaModal">
                                                    <button class="btn btn-success ti-check-box" title="Terima"></button>
                                                </a>
                                                <a href="javascript:;" data-toggle="modal" onclick="TolakData({{$data->id}})" data-target="#TolakModal">
                                                    <button class="btn btn-danger ti-close" title="Tolak"></button>
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

    <div id="TerimaModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="terimaForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terima Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="status" value="5">
                        </div>
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin Menerima Mahasiswa ini sebagai penerima Beasiswa ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmitterima()">Terima</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="TolakModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="tolakForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="status" value="4">
                        </div>
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin Menolak Mahasiswa ini untuk tidak menerima Beasiswa ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmittolak()">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection

@section('js')
    <script type="text/javascript">
        function TerimaData(id) {
            var id = id;
            var url = '{{route("akademik.calon_penerima_beasiswa-edit", ":id") }}';
            url = url.replace(':id', id);
            $("#terimaForm").attr('action', url);
        }

        function formSubmitterima() {
            $("#terimaForm").submit();
        }
    </script>
    <script type="text/javascript">
        function TolakData(id) {
            var id = id;
            var url = '{{route("akademik.calon_penerima_beasiswa-edit", ":id") }}';
            url = url.replace(':id', id);
            $("#tolakForm").attr('action', url);
        }

        function formSubmittolak() {
            $("#tolakForm").submit();
        }
    </script>
@endsection