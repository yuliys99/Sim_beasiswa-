@extends('layouts.admin-master')

@section('title')
    Data KHS
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 stretch-card">
                            <h3 class="font-weight-bold ml-4">Data KHS </h3>
                            {{-- <h5 class="font-weight-normal">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h5> --}}
                        </div>
                        <div class="col-2">
                                <div class="justify-content-end d-flex">
                                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success btn-sm icon-plus menu-icon fa-2x float-right"
                                    title="Tambahkan disini" style="margin-left: auto;"></button>

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
    @error('ipk')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('foto_khs')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <p class="card-title">Advanced Table</p> --}}
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table id="dataTables" class="display expandable-table table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Semester</th>
                                            <th>Nilai IPK</th>
                                            <th>Bukti Foto KHS</th>
                                            <th>Aksi</th>
                                            <th style="display:none;">id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach ($data as $data)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->semester }}</td>
                                            <td>{{ $data->ipk }}</td>
                                            <td>
                                                <img height="100" id="myImg" src="{{ $data->ambilFotoKhs() }}" data-toggle="modal" data-target="#myModal"></img>
                                            </td>
                                            <td width="15%">

                                                <button class="edit btn btn-warning ti-pencil" title="Edit disini"></button>

                                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                                    <button class="btn btn-danger ti-trash" title="Hapus"></button>
                                                </a>
                                            </td>
                                            <td style="display:none;">{{$data->id}}</td>
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

    @include('sidebar.mahasiswa.data_khs.edit')
    
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

    @include('sidebar.mahasiswa.data_khs.create')
@endsection

@section('js')
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{route("datakhs-mahasiswa.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

    <!-- ============================ Edit Data ========================== -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTables').DataTable();
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#semester').val(data[1]);
                $('#ipk').val(data[2]);
                $('#editForm').attr('action', '/datakhs-mahasiswa/' + data[5]);
                $('#editModal').modal('show');
            });
        });
    </script>
    <!-- ============================ End Edit Data ===================== -->
@endsection
