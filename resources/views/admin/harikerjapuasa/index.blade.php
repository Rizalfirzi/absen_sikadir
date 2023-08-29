@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <!-- Kolom lg-5 -->
        <div class="col-lg-5 d-flex align-items-stretch">
            <div class="col-lg-12">
                <h4><i class="fa fa-list fa-fw"></i> DATA HARI KERJA BULAN PUASA<font color='#ff0000'></font></h4>
            </div>
        </div>
        <hr>
        <!-- Kolom lg-12 -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 alert">
                    <a href='{{route('harikerjapuasa.create')}}'><input type='button' class='well1 btn btn-success' id='tambah' value='Tambah Baru' style='float:right;right:5%;'></a>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="example2" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>HARI</th>
            <th>TANGGAL MULAI</th>
            <th>TANGGAL AKHIR</th>
            <th>JAM MASUK</th>
            <th>JAM PULANG</th>
            <th>KETERANGAN</th>
           <th><center>Action</center></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($harikerjapuasa as $index => $hkp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $hkp->hari }}</td>
                    <td>{{ $hkp->tgl_awal }}</td>
                    <td>{{ $hkp->tgl_akhir }}</td>
                    <td>{{ $hkp->jam_masuk }}</td>
                    <td>{{ $hkp->jam_keluar }}</td>
                    <td>{{ $hkp->ket }}</td>
                    <td>
                        <form action="" method="POST">

                            <center>
                            <a href="{{ route('harikerjapuasa.edit', $hkp->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda Yakin?')">Delete
                            </button>
                        </center>
                        </form>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>

@endsection
