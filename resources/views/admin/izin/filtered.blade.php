@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> DATA PERIZINAN<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="{{ route('izin.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <h6>Catatan: data dibawah ini adalah data izin yang sudah masuk dan sudah di verifikasi</h6>
                        <div class="col-md-12"> &nbsp;</div>
                        <div class="col-md-2">
                            <h5>Tanggal</h5>
                            <input type="text" id="config-demo-izin" class="form-control">
                            <input type="hidden" name="awal" id="awal"
                                class="fontkecil"value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="akhir" id="akhir"
                                class="fontkecil"value="{{ date('Y-m-d') }}">
                        </div>
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
                            <a href=""><button class="well1 btn btn-success">Tambah Baru</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <div class="container">
        <table id="example2" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text_header_tabel">#</th>
                    <th class="text_header_tabel">NIK</th>
                    <th class="text_header_tabel">NAMA</th>
                    <th class="text_header_tabel">TANGGAL</th>
                    <th class="text_header_tabel">JENIS</th>
                    <th class="text_header_tabel">NO SURAT</th>
                    <th class="text_header_tabel">ALASAN</th>
                    <th class="text_header_tabel">ACTION</th>
                </tr>
                <tr>
                    <th colspan='26' class="highlight-cell bg-warning">
                        <i class='fa fa-list fa-fw'></i>
                        @if ($satkerName)
                            {{ $satkerName }}
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredData as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->nosurat }}</td>
                        <td>{{ $item->alasan }}</td>
                        <td width='20%' style='text-align:center;'>
                            <div class="btn-group" role="group">
                                <form action="{{ route('izin.delete', ['nik' => $item->nik, 'nosurat' => $item->nosurat]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </div>
                            <div class="btn-group" role="group">
                                {{-- <a href="{{ route('konfirmasi.show', $item->nik) }}" class="btn btn-sm btn-outline-warning">Dokumen</a> --}}
                                <a href="{{ route('izin.show', $item->nosurat.'.'.$item->extensi) }}" class="btn btn-sm btn-outline-warning" target="_blank">Dokumen</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
