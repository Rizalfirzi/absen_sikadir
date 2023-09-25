@extends('layouts.master')
@section('content')

<div class="container">
    <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-12">
                    <h4><i class="fa fa-list fa-fw"></i>UPLOAD</h4>
                </div>
            </div>
            <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('arsiptukin.index') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <h5>Bulan</h5>
            <select name="bulan" id="bulan" class="form-control">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="col-md-12 mt-4">
            <h5>Tahun</h5>
            <select name="tahun" id="tahun" class="form-control">

               <script>
                    var selectTahun = document.getElementById('tahun');
                    var tahunSaatIni = new Date().getFullYear();

               for (var tahun = 2020; tahun <= tahunSaatIni; tahun++) {
                 var option = document.createElement('option');
                 option.value = tahun;
                 option.text = tahun;
                 if (tahun === tahunSaatIni) {
                   option.selected = true;
                 }
                 selectTahun.appendChild(option);
               }
               </script>

            </select>
        </div>
        <div class="col-md-12 mt-4">
            <h5>UPLOAD FILE TUKIN (jpeg, jpg, png, pdf)</h5>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <div class="col-md-12 mt-4">
            <input  type="text" name="direktorat_id" value="{{ old('direktorat_id') }}" >
            <input type="text" name="satker" value="0">
            <button type="submit" name="simpanArsip" id="simpanArsip" class="btn btn-primary mt-4" style="width:100%;">Proses</button>
        </div>
    </form>
</div>

@endsection
