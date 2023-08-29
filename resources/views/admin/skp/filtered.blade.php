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
                <form id="filterForm" action="{{ route('skp.filter') }}" method="POST">
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
                        <div class="col-md-3" style="padding-top: 25px">
                            <button class="btn btn-primary">Proses</button>
                            <a href=""><button class="well1 btn btn-primary">Tambah Baru</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="container">
            <table id="example2" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SATKER/UNIT KERJA</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>TAHUN</th>
                        <th>PRESTASI KINERJA (%)</th>
                        <th>PREDIKAT KINERJA</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->nama_satker }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->nama_pegawai }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->persentase }}</td>
                            <td>
                                @if ($data->nilai >= 100)
                                    Sangat Baik
                                @elseif ($data->nilai >= 76 && $data->nilai <= 90)
                                    Baik
                                @elseif ($data->nilai >= 61 && $data->nilai <= 75)
                                    Butuh Perbaikan
                                @elseif ($data->nilai >= 51 && $data->nilai <= 60)
                                    Kurang
                                @else
                                    Sangat Kurang
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('skp.edit', $data->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            // Automatically go back to the previous page without confirmation on refresh
            if (performance.navigation.type === 1) {
                window.location.href = '{{ route('skp.index') }}';
            }
        </script>
    @endsection
