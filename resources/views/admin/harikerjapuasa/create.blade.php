@extends('layouts.master')

@section('content')
    <div class="col-lg-12">
        <div id="page-wrapper">
            <h4 class="pheader"><i class="fa fa-list fa-fw"></i> DATA HARI LIBUR NASIONAL <font color='#ff0000'></font>
            </h4>
            <div class="">
                <br>
                <form action="{{ route('harikerjapuasa.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <h5>Hari</h5>
                            <select name="hari" class="form-control well1">
                                <option value="Senin - Kamis">Senin - Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            {{-- <h5>Keterangan</h5>
                            <textarea name="ket" id="ket" class="form-control well2" rows="5"></textarea> --}}
                        </div>
                        <div class="col-md-5">
                            <h5>Tanggal Awal</h5>
                            <input type="date" name="tgl_awal" class="form-control well1">
                        </div>
                        <div class="col-md-5">
                            <h5>Tanggal Akhir</h5>
                            <input type="date" name="tgl_akhir" class="form-control well1">
                        </div>
                        <div class="col-md-5">
                            <h5>JAM MASUK</h5>
                            <input type="time" name="jam_masuk" class="form-control well1">
                        </div>
                        <div class="col-md-5">
                            <h5>JAM PULANG</h5>
                            <input type="time" name="jam_keluar" class="form-control well1">
                        </div>
                        <div class="col-md-5">
                            <h5>Keterangan</h5>
                            <textarea name="ket" class="form-control well2" rows="5"></textarea>
                        </div>
                        <div class="col-md-5">
                            {{-- <h5>Keterangan</h5>
                            <textarea name="ket" id="ket" class="form-control well2" rows="5"></textarea> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <br>
                                <input type="submit" name="submitAdd" id="submitAdd" class="btn btn-primary" value="Simpan">
                                <a href="{{ route('harikerjapuasa.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
