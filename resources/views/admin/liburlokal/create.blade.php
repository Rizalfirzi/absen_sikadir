@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4 class="pheader"><i class="fa fa-list fa-fw"></i> TAMBAH HARI LIBUR LOKAL <font color='#ff0000'></font>

                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->
            <div class="col-md-12">
                <form action="{{ route('liburlokal.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <h5>Tanggal</h5>
                            <input type="text" id="config-demo" class="form-control">
                            <input type="hidden" name="tanggal" id="awal" class="form-control" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="akhir" id="akhir" class="form-control" value="{{ date('Y-m-d') }}">
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
                        <div class='col-md-12'></div>
                        <div class='col-md-5'>
                            <h5>Keterangan</h5>
                            <textarea name='keterangan' id='keterangan' class="col-md-12 well2 " rows='5'></textarea>
                        </div>
                        <div class='col-md-12'></div>
                        <div class="col-md-5" style="padding-top: 20px;">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-danger" id="cancel" onclick="window.history.go(-1); return false;">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
