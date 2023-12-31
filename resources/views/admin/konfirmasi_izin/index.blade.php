@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> PERMOHONAN IZIN BARU <font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="{{ route('konfirmasi.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <h6>Catatan: data dibawah ini adalah data izin yang sudah masuk tetapi belum di verifikasi</h6>
                        <div class="col-md-12"> &nbsp;</div>
                        <div class="col-md-3">
                            <h5>Direktorat</h5>
                            <select name="direktorat" id="direktorat" class="form-control" required>
                                <option value="">-- Pilih Direktorat --</option>
                                @foreach ($direktorats as $direktorat)
                                    <option value="{{ $direktorat->direktorat_id }}">{{ $direktorat->direktorat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <h5>Satker / Unit Kerja</h5>
                            <div id="isisatker">
                                <select name="satker" id="satker" class="form-control">
                                    <!-- Opsi satker akan diisi melalui JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <h5>Status</h5>
                            <select class="form-control well1" id="tipe_pegawai" name="tipe_pegawai">
                                <option value="1">PNS</option>
                                <option value="2">Non PNS Pendukung</option>
                                <option value="3">Non PNS Substansi</option>
                                <option value="4">Bukan Non PNS/ KI</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding-top: 25px">
                            <button class="btn btn-primary">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="dotted-line"></div>
    <br>
    <div class="container">
        <table id="" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>TANGGAL</th>
                    <th>JENIS</th>
                    <th>NO SURAT</th>
                    <th>ALASAN</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
