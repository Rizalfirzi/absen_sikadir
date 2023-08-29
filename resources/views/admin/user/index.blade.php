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
<table id="data_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>USERNAME</th>
            <th>NAMA</th>
            <th>DIREKTORAT</th>
            <th>SATKER</th>
            <th>ROLE</th>
            <th>Keterangan</th>
           <th><center>Action</center></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

@endsection
