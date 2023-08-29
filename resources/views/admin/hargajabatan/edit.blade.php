@extends('layouts.master')

@section('content')

<div class="col-lg-12">
    <div id="page-wrapper">
        <h4 class="pheader"><i class="fa fa-pencil fa-fw"></i> DATA HARI LIBUR NASIONAL <font color='#ff0000'></font>
        </h4>
        <div class="">
            <br>
            <form class='col-md-12' action="{{ route('hargajabatan.update', $harga_jabatan->id) }}" method='POST'>
                @csrf
                @method('PUT')
                <div class='col-md-5'>
                    <h5>ID PERINGKAT JABATAN</h5>
                    <input type="text" name='peringkat_jabatan' id="peringkat_jabatan" class="col-md-12 well1 " value="{{ $harga_jabatan->peringkat_jabatan }}" requied>
                </div>
                <div class='col-md-12'></div>
                <div class='col-md-5'>
                    <h5>HARGA JABATAN</h5>
                    <input name='harga_jabatan2' id='harga_jabatan2' class="col-md-12 well1 " value="{{ $harga_jabatan->harga_jabatan2 }}" >
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <br>
                        <input type="submit" name="submitAdd" id="submitAdd" class="btn btn-primary" value="Simpan">
                        <button class="btn btn-danger" id="cancel" onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
