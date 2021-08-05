@extends('layouts.admin-master')

@section('title')
    Laporan Penerima Beasiswa
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card position-relative">
                            <div class="card-body">
                                <h3 class="font-weight-bold">Halaman Laporan Penerima Beasiswa</h3>
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
                            @if(auth()->user()->id_role == 1)
                            <form action="{{route('wadir.filterLaporan')}}" method="get">
                            @endif
                            @if(auth()->user()->id_role == 2)
                            <form action="{{route('akademik.filterLaporan')}}" method="get">
                            @endif
                            
                                <div class="form-group ml-3" style="display:inline-block">
                                    <div class="input-group-sm rounded">
                                        <select name="id_beasiswa" id="id_beasiswa" type="text" class="form-control">
                                            <option value="" selected disabled>- Beasiswa -</option>
                                            <option value="">Semua</option>
                                            @foreach($beasiswa as $datas)
                                            <option value="{{$datas->id}}" @if($datas->id == $bea) {{'selected="selected"'}} @endif >{{$datas->nama_beasiswa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button id="button" type="submit" class="btn btn-primary btn-sm ml-3" title="Filter">
                                    Filter
                                    <i class="ti-filter btn-icon-append"></i>  
                                </button>
                                
                                <button id="button" type="submit" class="btn btn-danger btn-sm ml-3" target="_blank" name="cetakPdf" value="cetakPdf" title="Print">
                                    Print
                                    <i class="ti-printer btn-icon-append"></i>  
                                </button>

                            </form>

                            <div class="table-responsive">
                                <table id="dataTables" class="display expandable-table table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Beasiswa</th>
                                            <th>IPK</th>
                                            <th>Semester</th>
                                            <th>File Persyaratan</th>
                                            <th>Tanggal Mendaftar</th>
                                            {{-- <th>Tanggal Diperiksa</th> --}}
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach ($data as $data)
                                        <tr>
                                            <td style="text-align:center">{{ $no++ }}</td>
                                            <td>{{ $data->mahasiswa->nama }}</td>
                                            <td>{{ $data->beasiswa->nama_beasiswa }}</td>
                                            <td>{{ $data->mahasiswa->ipk }}</td>
                                            <td>{{ $data->mahasiswa->semester }}</td>
                                            <td>
                                                <a target="_blank" href="{{$data->ambilFilePersyaratan()}}">{{$data->persyaratan}}</a>    
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                            {{-- <td>{{ $data->updated_at->diffForHumans() }}</td> --}}
                                            <td style="text-align:center">
                                                @if ($data->status == 1)
                                                    <div class="badge badge-warning" style="color: white">Diperiksa</div>
                                                @elseif ($data->status == 2)
                                                    <div class="badge badge-danger">Gagal</div>
                                                @elseif ($data->status == 3)
                                                    <div class="badge badge-success">Direkomendasikan</div>
                                                @elseif ($data->status == 4)
                                                    <div class="badge badge-danger">Gagal</div>
                                                @elseif ($data->status == 5)
                                                    <div class="badge badge-success">Diterima</div>
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
@endsection