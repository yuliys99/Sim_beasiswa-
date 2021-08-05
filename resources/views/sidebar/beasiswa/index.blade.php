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
                            <h3 class="font-weight-bold ml-4">Data Beasiswa </h3>
                            {{-- <h5 class="font-weight-normal">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h5> --}}
                        </div>
                        <div class="col-2">
                            @if(auth()->user()->id_role == 3 || auth()->user()->id_role == 2)
                                <div class="justify-content-end d-flex">
                                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success btn-sm icon-plus menu-icon fa-2x float-right"
                                    title="Tambahkan disini" style="margin-left: auto;"></button>

                                </div>
                            @endif
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
                    {{-- <p class="card-title">Advanced Table</p> --}}
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
                                            @if(auth()->user()->id_role == 3 || auth()->user()->id_role == 2)
                                                <th>Status</th>
                                            @endif
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
                                            <td>
                                                <a target="_blank" href="{{$data->ambilFile()}}">{{$data->persyaratan}}</a>    
                                            </td>
                                            <td>{{ $data->kontrak_beasiswa }}</td>
                                            @if(auth()->user()->id_role == 2)
                                                <td width="15%">
                                                    <a href="{{ route('akademik-beasiswa.edit', ['akademik_beasiswa' => $data->id]) }}">
                                                        <button class="btn btn-warning ti-pencil-alt"
                                                            title="Edit"></button>    
                                                    </a>
                                                    <a href="javascript:;" data-toggle="modal" onclick="deleteDataAkademik({{$data->id}})" data-target="#DeleteModal">
                                                        <button class="btn btn-danger ti-trash" title="Hapus"></button>
                                                    </a>
                                                </td>
                                            @endif
                                            @if(auth()->user()->id_role == 3)
                                                <td width="15%">
                                                    <a href="{{ route('beasiswa.edit', ['beasiswa' => $data->id]) }}">
                                                        <button class="btn btn-warning ti-pencil-alt"
                                                            title="Edit"></button>    
                                                    </a>
                                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                                        <button class="btn btn-danger ti-trash" title="Hapus"></button>
                                                    </a>
                                                </td>
                                            @endif
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

    
    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p>Apakah anda yakin ingin menghapus Beasiswa ini ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('sidebar.beasiswa.create')
@endsection

@section('js')
    <script type="text/javascript">
        function deleteDataAkademik(id) {
            var id = id;
            var url = '{{route("akademik-beasiswa.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        
        }
        function deleteData(id) {
            var id = id;
            var url = '{{route("beasiswa.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
