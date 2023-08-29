@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <!-- Kolom lg-5 -->
        <div class="col-lg-5 d-flex align-items-stretch">
            <div class="col-lg-10">
                <h4><i class="fa fa-list fa-fw"></i> LIBUR NASIONAL<font color='#ff0000'></font></h4>
            </div>
        </div>
        <hr>
        <!-- Kolom lg-12 -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 alert">
                    <a href='{{ route('libur.create') }}'><input type='button' class='well1 btn btn-success' id='tambah' value='Tambah Baru' style='float:right;right:5%;'></a>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="example2" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
           <th><center>Action</center></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($liburnas as $index => $libur)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $libur->tanggal }}</td>
                    <td>{{ $libur->keterangan }}</td>
                    <td>
                        <form action="{{ route('libur.destroy', $libur->kdharilibur) }}" method="POST">

                            <center>
                            <a href="{{ route('libur.edit', $libur->kdharilibur) }}" class="btn btn-sm btn-primary">
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
