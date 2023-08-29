@extends('layouts.master')

@section('content')

<div class="col-lg-12">
    <div id="page-wrapper">
        <h4 class="pheader"><i class="fa fa-list fa-fw"></i> DATA HARI LIBUR NASIONAL <font color='#ff0000'></font>
        </h4>
        <div class="">
            <br>
            <form class='col-md-12' action="{{ route('libur.update', $liburnas->kdharilibur) }}" method='POST'>
                @csrf
                @method('PUT')
                <div class='col-md-5'>
                    <h5>Tanggal</h5>
                    <input type="text" name='tanggal' id="tanggal" class="col-md-12 well1 datepicker" value="{{ $liburnas->tanggal }}" requied>
                </div>
                <div class='col-md-12'></div>
                <div class='col-md-5'>
                    <h5>Keterangan</h5>
                    <textarea    name='keterangan' id='keterangan' class="col-md-12 well2 " rows='5' > {{ $liburnas->keterangan }}</textarea>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <input type="submit" name="submitAdd" id="submitAdd" class="btn btn-primary" value="Simpan">
                        <button class="btn btn-danger" id="cancel" onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
