@extends('layouts.master')

@section('content')

<div class="container">
    <div id="page-wrapper">
        <h4 class="pheader"><i class="fa fa-list fa-fw"></i> DATA HARI LIBUR LOKAL <font color='#ff0000'></font>
        </h4>
        <div class="">
            <br>
        <form action="{{ route('liburlokal.update', $liburlokal->kdliburlokal) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-md-12">
                <div class='col-md-5'>
                    <h5>Tanggal</h5>
                    <input type="text" name='tanggal' id="tanggal" class="col-md-12 well1 datepicker" value="{{ $liburlokal->tanggal }}" requied>
                </div>
            <div class='col-md-12'></div>
            <div class="col-md-5">
                <h5>Direktorat</h5>
                <select name="direktorat" id="direktorat" class="form-control" required>
                    <option value="">-- Pilih Direktorat --</option>
                    @foreach ($direktorats as $direktorat)
                        <option value="{{ $direktorat->direktorat_id }}">{{ $direktorat->direktorat }}</option>
                    @endforeach
                </select>
            </div>
            <div class='col-md-12'></div>
            <div class="col-md-5">
                <h5>Satker / Unit Kerja</h5>
                <div id="isisatker">
                    <select name="kdunitkerja" id="satker" class="form-control">
                        <!-- Opsi satker akan diisi melalui JavaScript -->
                    </select>
                </div>
            </div>
            <div class='col-md-5'>
                <h5>Keterangan</h5>
                <textarea    name='keterangan' id='keterangan' class="col-md-12 well2 " rows='5' > {{ $liburlokal->keterangan }}</textarea>
            </div>
            <div class='col-md-12'></div>
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <input type="submit" name="submitAdd" id="submitAdd" class="btn btn-primary" value="Simpan">
                <button class="btn btn-danger" id="cancel" onclick="window.history.go(-1); return false;">Cancel</button>
        </form>
    </div>
</div>
@endsection
