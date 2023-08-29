@extends('layouts.master')
@section('content')

{{-- <h1>Tambah Data Harga Jabatan</h1>
    <form action="{{ route('harga_jabatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="peringkat_jabatan" class="form-label">Peringkat Jabatan</label>
            <input type="text" class="form-control" id="peringkat_jabatan" name="peringkat_jabatan" required>
        </div>
        <div class="mb-3">
            <label for="harga_jabatan" class="form-label">Harga Jabatan</label>
            <input type="number" class="form-control" id="harga_jabatan" name="harga_jabatan" required>
        </div>
        <div class="mb-3">
            <label for="harga_jabatan2" class="form-label">Harga Jabatan 2</label>
            <input type="number" class="form-control" id="harga_jabatan2" name="harga_jabatan2" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form> --}}

    <div class="col-lg-12">
        <div id="page-wrapper">
            <h4 class="pheader"><i class="fa fa-plus fa-fw"></i> TAMBAH DATA PERINGKAT HARGA JABATAN <font color='#ff0000'></font></h4>
            <div class="" >
            <br>
            <form class='col-md-12' action="{{ route('hargajabatan.store') }}" method='POST'>
                @csrf
                <div class='col-md-5'>
                    <h5>ID PERINGKAT JABATAN</h5>
                    <input type="text" name='peringkat_jabatan' id="peringkat_jabatan" class="col-md-12 well1 " requied>
                </div>
                <div class='col-md-12'></div>
                <div class='col-md-5'>
                    <h5>HARGA JABATAN</h5>
                    <input name='harga_jabatan2' id='harga_jabatan2' class="col-md-12 well1 " >
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        <button class="btn btn-danger" id="cancel" onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


@endsection
