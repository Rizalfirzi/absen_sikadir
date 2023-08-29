@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-12">
                    <h4><i class="fa fa-list fa-fw"></i> MASTER PERINGKAT HARGA JABATAN<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 alert">
                        <a href="{{ route('hargajabatan.create') }}"><input type='button' class='well1 btn btn-success'
                                id='tambah' value='Tambah Baru' style='float:right;right:5%;'></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="example2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Peringkat Jabatan</th>
                <th>Harga Jabatan Lama</th>
                <th>Harga Jabatan Baru</th>
                <th>
                    <center>Action</center>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($harga_jabatan as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->peringkat_jabatan }}</td>
                    <td>{{ number_format($data->harga_jabatan, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->harga_jabatan2, 0, ',', '.') }}</td>
                    <td>
                        <center>
                            <a href="{{ route('hargajabatan.edit', $data->id) }}" class="btn btn-warning">Edit</a> |
                            <form action="{{ route('hargajabatan.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </center>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
