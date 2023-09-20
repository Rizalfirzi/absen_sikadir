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
        <table id="example2" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
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
                @php
                $currentSatker = null;
            @endphp

            @foreach ($filtered as $key => $item)
            @if ($currentSatker !== $item->nama_satker)

            @php
                $currentSatker = $item->nama_satker;
            @endphp

                <tr>
                    <th colspan='26' class="highlight-cell bg-warning">
                        <i class='fa fa-list fa-fw'></i>
                        {{ $currentSatker }}
                    </th>
                </tr>
            @endif
            </thead>
            <tbody>
                {{-- @foreach ($filteredData as $key => $item) --}}
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->nosurat }}</td>
                        <td>{{ $item->alasan }}</td>
                        <td width='20%' style='text-align:center;'>
                            {{-- <form action="{{ route('konfir.delete', ['nik' => $item->nik, 'nosurat' => $item->nosurat]) }}" method="post">
                                @csrf
                                @method('delete') --}}
                                <a href="{{ route('konfirmasi.edit', $item->nik) }}"
                                    class="btn btn-sm btn-outline-success">
                                    Edit
                                </a> |
                                <a href="{{ route('konfirmasi.show', $item->nik) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    Show
                                </a> |
                                {{-- <a href="{{ route('konfir.delete', ['nik' => $item->nik, 'nosurat' => $item->nosurat]) }}"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Apakah Anda Yakin?')">Delete</a>                                  --}}
                            {{-- </form> --}}
                            <form action="{{ route('konfir.delete', ['nik' => $item->nik, 'nosurat' => $item->nosurat]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
