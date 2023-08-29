@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4><i class="fa fa-list fa-fw"></i> DATA PRESTASI KINERJA <font color='#ff0000'></font>
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
                        <div class="col-md-3" style="padding-top: 29px">
                            <button class="btn btn-primary">Proses</button>
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
                    @foreach ($skps as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->nama_satker }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->nama_pegawai }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->persentase }}</td>
                            <td id="ket_{{ $index }}">
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
                                <button id="buttonE{{ $index }}"  class="btn btn-sm btn-primary"
                                    onclick="EditSKP({{ $index }})">Edit</button>
                                <button id="buttonS{{ $index }}" onclick="SimpanSKP({{ $index }})"
                                    style="display: none;" class="btn btn-sm btn-primary" >Simpan</button>
                                <button id="buttonC{{ $index }}" onclick="CancelSKP({{ $index }})"
                                    style="display: none;" class="btn btn-sm btn-danger">Cancel</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <script>
            $(document).ready(function() {
                $(".edit-button").click(function() {
                    var index = $(this).data("index");
                    editSKP(index);
                });

                $(".save-button").click(function() {
                    var index = $(this).data("index");
                    simpanSKP(index);
                });

                $(".cancel-button").click(function() {
                    var index = $(this).data("index");
                    cancelSKP(index);
                });
            });

            function editSKP(index) {
                var persentase = $("#persentase_" + index).text(); // Ambil persentase
                var selectElement = `
            <select name='ket${index}' id='ket${index}'>
                <option value='-1'>- Pilih Predikat -</option>
                <option value='Sangat Baik'>Sangat Baik</option>
                <option value='Baik'>Baik</option>
                <option value='Butuh Perbaikan'>Butuh Perbaikan</option>
                <option value='Kurang'>Kurang</option>
                <option value='Sangat Kurang'>Sangat Kurang</option>
            </select>`;
                $("#ket_" + index).html(selectElement);
                $(`#ket${index}`).val(getPredikatFromPersentase(persentase)); // Set predikat sesuai presentase
                $(`.edit-button[data-index="${index}"]`).hide();
                $(`.save-button[data-index="${index}"]`).show();
                $(`.cancel-button[data-index="${index}"]`).show();
            }

            function getPredikatFromPersentase(persentase) {
                if (persentase >= 100) {
                    return "Sangat Baik";
                } else if (persentase >= 76 && persentase <= 90) {
                    return "Baik";
                } else if (persentase >= 61 && persentase <= 75) {
                    return "Butuh Perbaikan";
                } else if (persentase >= 51 && persentase <= 60) {
                    return "Kurang";
                } else {
                    return "Sangat Kurang";
                }
            }

            function simpanSKP(index) {
                var ket = $(`select[name="ket${index}"]`).val();
                // Lakukan permintaan AJAX ke server
                $.ajax({
                    type: "PATCH",
                    url: `{{ route('simpan_skp', ['id' => 'REPLACE_WITH_SKP_ID']) }}`,
                    data: {
                        _token: '{{ csrf_token() }}',
                        ket: ket,
                        id: id
                    },
                    success: function(response) {
                        $(`.save-button[data-index="${index}"]`).hide();
                        $(`.cancel-button[data-index="${index}"]`).hide();
                        $(`.edit-button[data-index="${index}"]`).show();
                        $(`#ket_${index}`).html(`<span class="predikat">${ket}</span>`);
                    }
                });
            }

            function cancelSKP(index) {
                var ket = $(`#ket_${index} .predikat`).text();
                $(`#ket_${index}`).html(`<span class="predikat">${ket}</span>`);
                $(`.save-button[data-index="${index}"]`).hide();
                $(`.cancel-button[data-index="${index}"]`).hide();
                $(`.edit-button[data-index="${index}"]`).show();
            }
        </script> --}}
        <script>
            function EditSKP(index) {
                var ketElement = $("#ket_" + index);
                var ket = ketElement.text();

                // Simpan nilai keterangan awal
                ketElement.html(`
                    <select name='ket${index}' id='ket${index}'>
                        <option value='-1'>- Pilih Predikat -</option>
                        <option value='Sangat Baik'>Sangat Baik</option>
                        <option value='Baik'>Baik</option>
                        <option value='Butuh Perbaikan'>Butuh Perbaikan</option>
                        <option value='Kurang'>Kurang</option>
                        <option value='Sangat Kurang'>Sangat Kurang</option>
                    </select>
                `);

                // Tampilkan tombol Simpan dan Batal, sembunyikan tombol Edit
                $(`#buttonE${index}`).hide();
                $(`#buttonS${index}`).show();
                $(`#buttonC${index}`).show();

                // Set nilai dropdown sesuai dengan keterangan awal
                $(`select[name="ket${index}"]`).val(ket);
            }

            function SimpanSKP(index, nip) {
                var ket = $(`select[name="ket${index}"]`).val();

                // Lakukan permintaan AJAX ke server
                $.ajax({
                    type: "POST",
                    url: "{{ route('simpan_skp') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        nip: nip,
                        ket: ket
                    },
                    success: function(response) {
                        // Tindakan setelah data disimpan
                        console.log(response);
                        // Misalnya, tampilkan notifikasi atau ubah tampilan tombol
                        $(`#buttonS${index}`).hide();
                        $(`#buttonC${index}`).hide();
                        $(`#buttonE${index}`).show();
                        $(`#ket_${index}`).text(ket);
                    }
                });
            }

            function CancelSKP(index) {
                var ketElement = $(`#ket_${index}`);
                var ket = ketElement.find('select option:selected').text();

                // Hapus dropdown, tampilkan kembali nilai awal
                ketElement.html(ket);

                // Sembunyikan tombol Simpan dan Batal, tampilkan tombol Edit
                $(`#buttonS${index}`).hide();
                $(`#buttonC${index}`).hide();
                $(`#buttonE${index}`).show();
            }
        </script>
    @endsection
