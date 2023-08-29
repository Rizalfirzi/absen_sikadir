@extends('layouts.master')

@section('content')
    <div class="col-lg-12">
        <div id="page-wrapper">
            <h4 class="pheader"><i class="fa fa-list fa-fw"></i> DATA HARI LIBUR NASIONAL <font color='#ff0000'></font>
            </h4>
            <div class="">
                <br>
                <form action="{{ route('harikerjapuasa.update', $harikerjapuasa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-5">
                            <h5>Hari</h5>
                            <select name="hari" id="hari" class="form-control well1">
                                <option value="Senin - Kamis"
                                    {{ $harikerjapuasa->hari === 'Senin - Kamis' ? 'selected' : '' }}>Senin - Kamis</option>
                                <option value="Jumat" {{ $harikerjapuasa->hari === 'Jumat' ? 'selected' : '' }}>Jumat
                                </option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            {{-- <h5>Keterangan</h5>
                            <textarea name="ket" id="ket" class="form-control well2" rows="5">{{ $harikerjapuasa->ket }}</textarea> --}}
                        </div>
                        <div class="col-md-5">
                            <h5>Tanggal Awal</h5>
                            <input type="date" name="tgl_awal" id="startDate" class="form-control well1"
                                value="{{ $harikerjapuasa->tgl_awal }}">
                        </div>
                        <div class="col-md-5">
                            <h5>Tanggal Akhir</h5>
                            <input type="date" name="tgl_akhir" id="endDate" class="form-control well1"
                                value="{{ $harikerjapuasa->tgl_akhir }}">
                        </div>
                        <div class="col-md-5">
                            <h5>JAM MASUK</h5>
                            <input type="time" name="jam_masuk" id="jam_masuk" class="form-control well1"
                                value="{{ $harikerjapuasa->jam_masuk }}">
                        </div>
                        <div class="col-md-5">
                            <h5>JAM PULANG</h5>
                            <input type="time" name="jam_keluar" id="jam_keluar" class="form-control well1"
                                value="{{ $harikerjapuasa->jam_keluar }}">
                        </div>
                        <div class="col-md-5">
                            <h5>Keterangan</h5>
                            <textarea name="ket" id="ket" class="form-control well2" rows="5">{{ $harikerjapuasa->ket }}</textarea>
                        </div>
                        <div class="col-md-5">
                            {{-- <h5>Keterangan</h5>
                            <textarea name="ket" id="ket" class="form-control well2" rows="5">{{ $harikerjapuasa->ket }}</textarea> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <br>
                                <input type="submit" name="submitAdd" id="submitAdd" class="btn btn-primary"
                                    value="Simpan">
                                <button class="btn btn-danger" id="cancel"
                                    onclick="window.history.go(-1); return false;">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
