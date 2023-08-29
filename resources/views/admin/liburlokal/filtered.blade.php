@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> DATA HARI LIBUR LOKAL<font color='#ff0000'></font>
                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->

            <div class="col-md-12">
                <form id="filterForm" action="" method="POST">
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
                        <div class="col-md-3" style="padding-top: 29px">
                            <button class="btn btn-primary">Proses</button>
                        </div>
                        <div class="col-md-3" style="padding-top: 29px; padding-right: 25px;">
                            <a href="{{ route ('liburlokal.create') }}"><input type='button' class=' well1 btn btn-success ' id='tambah' value='Tambah Baru' style='float:right;right:5%;'></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <hr>
    <div class="container">
        <table id="example2" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TANGGAL</th>
                    <th>UNIT KERJA</th>
                    <th>KETERANGAN</th>
                    <th>ACTION</th>
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
                @foreach ($liburLokals as $lokal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lokal->tanggal }}</td>
                    <td>{{ $lokal->nama_satker }}</td>
                    <td>{{ $lokal->keterangan }}</td>
                    <td>
                            <center>
                            <a href="{{ route('liburlokal.edit', $lokal->kdliburlokal) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                        </center>
                        </form>
                    </td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
