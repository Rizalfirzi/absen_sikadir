@extends('layouts.master')

@section('content')
    <div class="container" style="padding-top: 1%">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-12">
                    <h4><i class="fa fa-list fa-fw"></i>DATA REKAP TUKIN DAN KEHADIRAN</h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ route('arsiptukin.filter') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <h5>Direktorat</h5>
                            <select data-placeholder="INPUT DIREKTORAT" name="direktorat" id="direktorat" class="chosen-select well2 col-md-12 form-control" tabindex="2" style="width: 100%">
                                <option value="">-- Pilih Direktorat --</option>

                                @foreach ($direktorats as $direktorat)
                                <option value="{{ $direktorat->direktorat_id }}">{{ $direktorat->direktorat }}</option>
                                @endforeach
                            </select>
                    </div>
                            <div class="col-md-2">
                                <h5>Tahun</h5>
                                <select name="tahun" id="tahun" class="well1 col-md-12 form-control">
                                    <option value="">-- Pilih Tahun --</option>
                                    @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info btn-md" type="submit" style="margin-top: 17%">Proses</button>
                            </div>
                        </form>
                    <div class="col-md-3">
                        <a href="{{ route('arsiptukin.create') }}">
                            <button class="btn btn-success btn-md" style="margin-top: 11.5%; margin-left: 54%">Tambah Baru</button>
                        </a>
                    </div>
                </div>
            </div>

            <hr style="margin-top: 2%;margin-bottom: 2%">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-4">Direktorat</th>
                        <th class="col-sm-1 text-center">Bulan</th>
                        <th class="col-sm-2 text-center">Tahun</th>
                        <th class="col-sm-1 text-center">File</th>
                        <th class="col-sm-2 text-center">Jenis</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($arsips as $arsip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $arsip->nama_direktorat }}</td>
                                <td class="text-center">{{ $arsip->nama_bulan }}</td>
                                <td class="text-center">{{ $arsip->tahun }}</td>
                                <td class="text-center"><a href="{{ asset('arsip/' . $arsip->file_dok) }}" target="_blank">Dokumen</a></td>
                                <td class="text-center">{{ $arsip->jenis }}</td>
                                <td>
                                    <form onsubmit="return deleteData('{{ $arsip->id }}')" action="{{ url('arsiptukin/'.$arsip->id) }}" style="display: inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
