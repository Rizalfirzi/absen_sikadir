@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> DATA PEGAWAI<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="{{ route('pegawai.filter') }}" method="POST">
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
                            <h5>Aktif</h5>
                            <select class="form-control" id="aktif" name="aktif">
                                <option value="Aktif" selected>Aktif</option>
                                <option value="Meninggal">Meninggal</option>
                                <option value="Pemberhentian Dengan Hormat Atas Permintaan Sendiri">Pemberhentian Dengan
                                    Hormat Atas Permintaan Sendiri</option>
                                <option value="Pemberhentian Dengan Hormat Tidak Atas Permintaan Sendiri">Pemberhentian
                                    Dengan Hormat Tidak Atas Permintaan Sendiri</option>
                                <option value="Pemberhentian Tidak Dengan Hormat">Pemberhentian Tidak Dengan Hormat</option>
                                <option value="Pensiun">Pensiun</option>
                                <option value="Mutasi lintas Unor">Mutasi lintas Unor</option>
                                <!-- Sisipkan opsi lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="col-md-3" style="padding-top: 25px">
                            <button class="btn btn-primary">Proses</button>
                            <a href=""><button class="well1 btn btn-primary">Tambah Baru</button></a>
                        </div>
                    </div>
                </form>
                {{-- <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Proses</button>
                        </div> --}}
            </div>
            {{-- <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Proses</button>
                        </div> --}}
        </div>
    </div>

    <br>
    <div class="container">
        <table id="example" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan='2'>#</th>
                    <th rowspan='2'>Badge<br>Number</th>
                    <th rowspan='2'>Badge<br>Number<br>Baru</th>
                    <th rowspan='2'>NAMA</th>
                    <th rowspan='2'>NIP</th>
                    <th rowspan='2'>GOL</th>
                    <th rowspan='2'>PANGKAT</th>
                    <th rowspan='2'>GRADE</th>
                    <th rowspan='2'>DIREKTORAT</th>
                    <th class="white-bottom-border" colspan='2'>
                        <center>UNIT KERJA
                        </center>
                    </th>
                    <th rowspan='2'>status</th>
                    <th rowspan='2'>Aktif</th>
                    <th rowspan='2'>
                        <center>ACTION</center>
                    </th>
                </tr>
                <tr>
                    <th>satker</th>
                    <th>ppk/Subdit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->badgenumber }}</td>
                        <td>{{ $data->badgenumber_baru }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->nip }}</td>
                        <td>{{ $data->golongan_ruang }}</td>
                        <td>{{ $data->jabatan }}</td>
                        <td>
                            @if ($data->gradejabatan === null || $data->gradejabatan == 0)
                                -
                            @else
                                {{ $data->gradejabatan }}
                            @endif
                        </td>
                        <td>{{ $data->nama_direktorat }}</td>
                        <td>
                            @if ($data->satker_id == '0' || $data->satker_id == '')
                                -
                            @else
                                {{ $data->nama_satker }}
                            @endif
                        </td>
                        <td>
                            @if ($data->ppk_id == '0' || $data->ppk_id == '')
                                -
                            @else
                                {{ $data->nama_satker }}
                            @endif
                        </td>

                        <td>
                            @if ($data->status == 1)
                                PNS
                            @endif
                        </td>
                        <td>{{ $data->aktif }}</td>
                        <td>
                            <form action="" method="POST">
                                <center>
                                    <a href="" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                                </center>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Automatically go back to the previous page without confirmation on refresh
        if (performance.navigation.type === 1) {
            window.location.href = '{{ route('pegawai.index') }}';
        }
    </script>

@endsection
