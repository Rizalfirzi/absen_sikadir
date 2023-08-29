@extends('layouts.master')
@section('content')
    <style>
        .text_header_tabel {
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> TUNJANGAN KARYAWAN<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="{{ route('tukin.filter') }}" method="POST">
                    @csrf
                    <div class="row">
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
                        <div class="col-md-2">
                            <h5>Tahun</h5>
                            <select name="tahun" id="tahun" class="well1 col-md-12 form-control">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <h5>Bulan</h5>
                            <select name="bulan" id="bulan" class="well1 col-md-12 form-control">
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
                        <div class="col-md-2">
                            <div class="btn-group">
                                <div>
                                    <button class="btn btn-primary">lihat</button>
                                </div>
                                <div>
                                    <a href=""><input type="button" class="well1 btn btn-primary" id="proses"
                                            value="Proses"></a>
                                </div>
                            </div>
                            <div class="mt-2"> <!-- Add some margin at the top -->
                                <a href="" type="button" class="well1 btn btn-primary"> Pajak</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="containerScrol">
            <table id="example3" class="lebartabel table table-bordered " width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th class="text_header_tabel" rowspan="4">#</th>
                        <th class="text_header_tabel" rowspan="4">NIP</th>
                        <th class="text_header_tabel" rowspan="4">NAMA</th>
                        <th class="text_header_tabel" rowspan="4">PERINGKAT JABATAN</th>

                        <th class="text_header_tabel" rowspan="4">HARGA JABATAN</th>
                        <th class="text_header_tabel" rowspan="4">NILAI PRESTASI (%)</th>
                        <th class="text_header_tabel" rowspan="4">TUNJANGAN DASAR</th>
                        <th class="text_header_tabel" rowspan="4">TOTAL TUNJANGAN DITERIMA</th>
                        <th class="text_header_tabel" colspan="16">POTONGAN KETIDAK HADIRAN KARENA :</th>
                    </tr>
                    <tr>
                        <th class="text_header_tabel" colspan="6">CUTI</th>
                        <th class="text_header_tabel" colspan="2" rowspan="2">TUBEL</th>
                        <th class="text_header_tabel" colspan="2" rowspan="2">IZIN</th>
                        <th class="text_header_tabel" colspan="2">TIDAK MASUK KERJA</th>
                        <th class="text_header_tabel" colspan="4">KEKURANGAN JAM KERJA</th>
                    </tr>
                    <tr>
                        <th class="text_header_tabel" colspan="2">CUTI BESAR</th>
                        <th class="text_header_tabel" colspan="2">CUTI ALASAN PENTING</th>
                        <th class="text_header_tabel" colspan="2">CUTI MELAHIRKAN ANAK KE-3 DST</th>
                        <th class="text_header_tabel" colspan="2">TANPA KETERANGAN</th>
                        <th class="text_header_tabel" colspan="4">(DLM JAM)</th>
                    </tr>
                    <tr>
                        <th class="text_header_tabel">BLN KE-</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">BLN KE-</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">BLN KE-</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">BLN</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">JML HARI</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">JML HARI</th>
                        <th class="text_header_tabel">Rp. POT</th>
                        <th class="text_header_tabel">TL</th>
                        <th class="text_header_tabel">PSW</th>
                        <th class="text_header_tabel">TOTAL KJK</th>
                        <th class="text_header_tabel">Rp. POT</th>
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
                    @foreach ($tukinMatangs as $dtmatang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dtmatang->nip }}</td>
                            <td>{{ $dtmatang->nama }}</td>
                            @if ($dtmatang->nip && $dtmatang->nama)
                                <td>{{ $dtmatang->gradejabatan }}</td>
                                <td>{{ number_format($dtmatang->harga_jabatan, 0, ',', '.') }}</td>
                                <td>{{ $dtmatang->skp_persentase }}</td>
                                <td>{{ number_format($dtmatang->tukin_dasar, 0, ',', '.') }}</td>
                                <td style=" background-color: rgb(10, 10, 90); color:white">Rp.{{ number_format($dtmatang->tukin_terima, 0, ',', '.') }}</td>
                                <td>{{ $dtmatang->cuti_besar }}</td>
                                <td>{{ number_format($dtmatang->cuti_besar_pot, 0, ',', '.') }}</td>
                                <td>{{ $dtmatang->cuti_penting }}</td>
                                <td>{{ $dtmatang->cuti_penting_pot }}</td>
                                <td>{{ $dtmatang->cuti_lahir }}</td>
                                <td>{{ $dtmatang->cuti_lahir_pot }}</td>
                                <td>{{ $dtmatang->tubel }}</td>
                                <td>{{ $dtmatang->tubel_pot }}</td>
                                <td>{{ $dtmatang->izin }}</td>
                                <td>{{ $dtmatang->izin_pot }}</td>
                                <td>{{ $dtmatang->tk }}</td>
                                <td>{{ $dtmatang->tk_pot }}</td>
                                <td>{{ $dtmatang->telat_tl }}</td>
                                <td>{{ $dtmatang->psw }}</td>
                                <td>{{ $dtmatang->total_kjk }}</td>
                                <td>{{ number_format($dtmatang->kjk_pot, 0, ',', '.') }}</td>
                            @else
                                <td colspan="23">
                                    <center>Data Tunjangan belum digenerate. Silahkan generate terlebih dahulu.</center>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    {{-- @foreach ($tukinMatangs as $dtmatang)
                        <tr>
                            @if ($dtmatang->nip && $dtmatang->nama)
                                <td>{{ $dtmatang->nip }}</td>
                                <td>{{ $dtmatang->nama }}</td>
                                <td>{{ $dtmatang->gradejabatan }}</td>
                                <td>{{ number_format($dtmatang->harga_jabatan, 0, ',', '.') }}</td>
                                <td>{{ $dtmatang->skp_persentase }}</td>
                                <td>{{ number_format($dtmatang->tukin_dasar, 0, ',', '.') }}</td>
                                <td>{{ number_format($dtmatang->tukin_terima, 0, ',', '.') }}</td>
                                <td>{{ $dtmatang->cuti_besar }}</td>
                                <td>{{ $dtmatang->cuti_besar_pot }}</td>
                                <td>{{ $dtmatang->cuti_penting }}</td>
                                <td>{{ $dtmatang->cuti_penting_pot }}</td>
                                <td>{{ $dtmatang->cuti_lahir }}</td>
                                <td>{{ $dtmatang->cuti_lahir_pot }}</td>
                                <td>{{ $dtmatang->tubel }}</td>
                                <td>{{ $dtmatang->tubel_pot }}</td>
                                <td>{{ $dtmatang->izin }}</td>
                                <td>{{ $dtmatang->izin_pot }}</td>
                                <td>{{ $dtmatang->tk }}</td>
                                <td>{{ $dtmatang->tk_pot }}</td>
                                <td>{{ $dtmatang->telat_tl }}</td>
                                <td>{{ $dtmatang->psw }}</td>
                                <td>{{ $dtmatang->total_kjk }}</td>
                                <td>{{ number_format($dtmatang->kjk_pot, 0, ',', '.') }}</td>
                            @else
                                <td>{{ $dtmatang->$nip }}</td>
                                <td>{{ $dtmatang->$nama }}</td>
                                <td colspan='21'>
                                    <center>Data Tunjangan belum digenerate. Silahkan generate terlebih dahulu.</center>
                                </td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            @endif
                        </tr>
                    @endforeach --}}
                    <!-- Isi data random untuk beberapa baris lainnya -->
                </tbody>
            </table>
        </div>
    @endsection
