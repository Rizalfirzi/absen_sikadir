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
                <form id="filterForm" action="{{ route('konfir.edit_proses', $izins->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <h5>NIK</h5>
                            <input type="text" class="chosen-select well2 col-md-12 form-control" name="nip" value="{{$izins->nik}}" placeholder="Input Nik" readonly>
                        </div>
                        <div class='col-md-12'></div>
                        <div class="col-md-5">
                            <h5>Tanggal</h5>
                            <input type="text" id="config-demo" class="form-control" value="{{$izins->tanggal}}">
                            <input type="hidden" name="awal" id="awal" class="form-control" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="akhir" id="akhir" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class='col-md-12'>&nbsp;</div>
                        <div class='col-md-5'>
                            <h5>JENIS IZIN</h5>
                            <select name='jenis' id='jenis' class="col-md-12  well2 form-control">
                                <option value=""> -- PILIH JENIS -- </option>
                                <option value="I">Izin (Terlambat, Pulang sebelum waktunya, Tidak berada di tempat
                                    tugas, Tidak mengisi daftar hadir)</option>
                                <option value="DL">Dinas Luar</option>
                                <option value="TL">Tugas Luar</option>
                                <option value="S">Sakit</option>
                                <option value="TB">Tugas Belajar/Pendidikan</option>
                                <option value="BP">Pelatihan/Bimbingan Teknik (BP)</option>
                                <option value="C1">Cuti Tahunan</option>
                                <option value="C2">Cuti Besar</option>
                                <option value="C4">Cuti Bersalin</option>
                                <option value="C5">Cuti Karena Alasan Penting</option>
                                <option value="C6">Cuti Diluar Tanggungan Negara</option>
                                @if (Auth::user()->roles[0]->name == 'SUPER ADMIN')
                                    <option value="DSP">Dispensasi</option>
                                @endif
                            </select>
                        </div>
                        <div class='col-md-12'>&nbsp;</div>
                        <div class='col-md-5'>
                            <h5>ALASAN</h5>
                            <textarea name='alasan' id='alasan' class="col-md-12 well2 form-control" rows='5'>{{$izins->alasan}}</textarea>
                        </div>
                        <div class='col-md-12'>&nbsp;</div>
                        <div class="col-md-5">
                            <h5>UPLOAD FILE (jpg,png,pdf)</h5>
                            <input type="file" name="file" id="file" class="col-md-12 well2 form-control">
                        </div>
                        <input type="hidden" name="delete" class="col-md-12 well2 form-control" value="0">
                        <input type="hidden" name="st" class="col-md-12 well2 form-control" value="0">
                        <input type="hidden" name="anak" class="col-md-12 well2 form-control" value="0">
                        <div class='col-md-12'>&nbsp;</div>
                        <div class="col-md-12">
                            {{-- <input type="hidden" name="id" id="id" value="{{ $id }}"> --}}
                            {{-- <input type="hidden" name="nosurat" id="nosurat" value="{{ $nosurat }}"> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <br>
                                <button type="submit" class="col-md-12 well1 btn btn-primary">simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection