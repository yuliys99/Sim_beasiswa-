@php
    $no = 1;
@endphp

<title>Data Mahasiswa Penerima Beasiswa | SIM Penerima Beasiswa</title>

<head>
    <style type="text/css">
        .atas{
            height: 116px;
        }
        .judul{
            margin-bottom: 30px;
        }
        .tengah{
            position: absolute;
            width: 320px; 
            height: 320px;
            margin-left: 18.6%; 
            margin-top: 400px;
        }
        .mengetahui{
            
            margin-top: 50px;
            margin-right: 65px;
        }
        .garis{
            height: 1px;
            width: 100%;
            background-color: black;
        }
        .garis2{
            height: 2px;
            width: 100%;
            background-color: black;
            margin-top: 2px;
        }

    </style>
</head>


<?php
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

    <img src="{{public_path('assets/images/kop.jpg')}}" style="height: 100px; width: 100px; float: left; margin-top:18px ;margin-left: 35px; z-index: -1000;">
    <div class="atas">
        <p style=" margin-left: 24%; font-size: 18px;">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</p>
        <p style=" margin-top: -18px; margin-left: 36%; font-size: 18px;">RISET, DAN TEKNOLOGI</p>
        <p style=" margin-top: -18px; margin-left: 30%; font-size: 16px; font:bold;">POLITEKNIK NEGERI BANYUWANGI</p>
        <p style=" margin-top: -15px; margin-left: 26%; font-size: 12px;">Jl. Raya Jember kilometer 13 Labanasem, Kabat, Banyuwangi, 68461</p>
        <p style=" margin-top: -10px; margin-left: 38%; font-size: 12px;">Telepon / Faks : (0333) 636780</p>
        <p style=" margin-top: -10px; margin-left: 24%; font-size: 12px;">E-mail : <u>poliwangi@poliwangi.ac.id</u> ; Website : <u>http://www.poliwangi.ac.id</u></p>
    </div>
    <div class="garis"></div>
    <div class="garis2"></div>

<body>
    <h3 class="judul" style="text-align: center; margin-top:40px"> Data Mahasiswa Penerima Beasiswa</h3>
    <table align="center" width="95%" border="0.2" style=" border-collapse: collapse;">
        <thead style="font-size: 14px;">
            <tr>				
                <th width="5%">No</th>
                <th width="15%">Beasiswa</th>
                <th width="20%">Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>NIM</th>
                <th>IPK</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['datas'] as $a)
            <tr align="center">
                <td style="font-size: 12px;">{{$no++}}</td>
                <td style="font-size: 12px;">{{$a->nama_beasiswa}}</td>
                <td style="font-size: 12px;">{{$a->nama}}</td>
                <td style="font-size: 12px;">{{$a->nama_prodi}}</td>
                <td style="font-size: 12px;">{{$a->nim}}</td>
                <td style="font-size: 12px;">{{$a->ipk}}</td>
                <td style="font-size: 12px;">{{$a->semester}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mengetahui" align="right">
        <p>
            Mengetahui,
        </p>
    </div>

    <div style="padding-top: 100px">

        <p align="right">
            {{$data['wadir3']->nama}}
        </p>
    </div>

    <div class="tengah">
        <img class="tengah" src="{{public_path('assets/images/kop.png')}}" style="opacity: 0.1;">
    </div>
</body>