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
                        <div class="col-10 stretch-card">
                            <h3 class="font-weight-bold ml-4">Pendaftaran Beasiswa </h3>
                            {{-- <h5 class="font-weight-normal">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h5> --}}
                        </div>
                        <div class="col-2">
                            <div class="justify-content-end d-flex">
                                {{ Auth::user()->nama }}
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
    
    @error('min_ipk')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description mb-3">
                        @if($data_kurang)
                        <span class="alert alert-danger">Tolong lengkapi data anda terlebih dahulu !</span>
                        @endif
                    </p>
                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table id="dataTables" class="display expandable-table table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Nama Beasiswa</th>
                                            <th>Tahun Perolehan</th>
                                            <th>Minimal IPK</th>
                                            <th>Jenis</th>
                                            <th>Persyaratan</th>
                                            <th>Kontrak Beasiswa</th>
                                            <th>Daftar disini</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach ($beasiswa as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_beasiswa }}</td>
                                            <td>{{ $data->tahun_perolehan }}</td>
                                            <td>{{ $data->min_ipk }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>
                                                <a target="_blank" href="{{$data->ambilFile()}}">{{$data->persyaratan}}</a>    
                                            </td>
                                            <td>{{ $data->kontrak_beasiswa }}</td>
                                            <td width="15%" style="text-align: center">
                                                @if($data_kurang)
                                                <a href="javascript:;">
                                                    <div class="badge badge-warning">-</div>
                                                </a>
                                                @else
                                                <a href="javascript:;" data-toggle="modal" onclick="daftarData({{$data->id}})" data-target="#DaftarModal">
                                                    <button class="btn btn-success ti-receipt" title="Daftar beasiswa ini"></button>
                                                </a>
                                                @endif
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

    
    <div id="DaftarModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="daftarForm" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Daftar Beasiswa ini</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_user" value="{{ Auth::user()->id}}" >
                        </div>
                        <div class="form-group">
                            <label for="persyaratan">File Persyaratan <a class="text-danger">*</a></label>
                            <small class="text-danger"><br> Format : (Nama_Beasiswa.rar) </small>
                            <small class="text-danger"><br>maksimal 2 mb </small>
                            <input type="file" class="form-control" name="persyaratan" required>
                        </div>
                        <small>Untuk Persyaratan bisa dilihat dideskripsi<br></small>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        function daftarData(id) {
            var id = id;
            var url = '{{route("mahasiswa.do-pendaftaran-beasiswa", ":id") }}';
            url = url.replace(':id', id);
            $("#daftarForm").attr('action', url);
        }

        function formSubmit() {
            $("#daftarForm").submit();
        }
    </script>
@endsection

