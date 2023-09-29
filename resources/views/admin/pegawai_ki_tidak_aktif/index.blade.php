@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> DATA PEGAWAI BUKAN NON PNS (Tidak Aktif)<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="{{ route('karyawan_bukan_non_pns_tidak_aktif.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Direktorat</h5>
                            <select name="direktorat" id="direktorat" class="form-control" required>
                                <option value="">-- Pilih Direktorat --</option>
                                @foreach ($direktorats as $direktorat)
                                    <option value="{{ $direktorat->direktorat_id }}">{{ $direktorat->direktorat }}</option>
                                @endforeach
                            </select>
                        </div>

                     
                        <div class="col-md-4">
                            <h5>Satker / Unit Kerja</h5>
                            <div id="isisatker">
                                <select name="satker" id="satker" class="form-control">
                                    <!-- Opsi satker akan diisi melalui JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <h5>Status</h5>
                            <select class="form-control" id="status" name="status">
                                <option value="4" selected>KI</option>
                            </select>
                        </div>
                        <div class="col-md-3 alert" style="padding-top: 25px">
                            <button class="btn btn-primary">Proses</button>
                            <a href="{{ route('karyawan_bukan_non_pns_off.create') }}" class="btn btn-success">Tambah Baru</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="container">
            <table id="empTable" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
                <thead>
                    <tr>
                        <th> No </th>
                        <th> BadgeNumber </th>
                        <th> BadgeNumber<br>Baru</th>
                        <th> NRP </th>
                        <th> NAMA </th>
                        <!--th> GRADE JABATAN </th-->
                        <th> DIREKTORAT </th>
                        <th> UNIT KERJA </th>
                        <!--th> GOL </th-->
                        <th> JABATAN </th>
                        <!--th> EKP </th-->
                        <th> Status </th>
                        <th> Aktif </th>
                        <th> Actions </th>
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
                            {{-- <td>{{ $data->golongan_ruang }}</td> --}}
                            <td>{{ $data->nama_direktorat }}</td>
                            <td>
                                {{ $data->nama_satker }}
                            </td>
                            <td>{{ $data->jabatan }}</td>
                            <td>
                                @if ($data->status == 4)
                                    KI
                                @endif
                            </td>
                            <td>{{ $data->aktif }}</td>
                            <td>
                                <div class="button-container">
                                    <button id="editButton{{ $data->id }}" class="btn btn-sm btn-primary"
                                        onclick="EditPEG({{ $data->id }})">Edit</button>
                                    <form action="{{ route('pegawai.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="deleteButton{{ $data->id }}" type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="DeletePEG({{ $data->id }})"Delete>Delete</button>
                                    </form>
                                    <button id="simpanButton{{ $data->id }}" onclick="SimpanPEG({{ $data->id }})"
                                        style="display: none;" class="btn btn-sm btn-primary">Simpan</button>
                                    <button id="cancelButton{{ $data->id }}" onclick="CancelPEG({{ $data->id }})"
                                        style="display: none;" class="btn btn-sm btn-danger">Batal</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
