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
                            <td>
                                <span id="nilai{{ $data->id }}">
                                    {{-- {{ $data->nilai }} --}}
                                    @if (is_numeric($data->nilai))
                                        @if ($data->nilai >= 96 && $data->nilai <= 100)
                                            Sangat Baik
                                        @elseif ($data->nilai >= 76 && $data->nilai <= 95)
                                            Baik
                                        @elseif ($data->nilai >= 61 && $data->nilai <= 75)
                                            Butuh Perbaikan
                                        @elseif ($data->nilai >= 51 && $data->nilai <= 60)
                                            Kurang
                                        @else
                                            Sangat Kurang
                                        @endif
                                    @else
                                        {{ $data->nilai }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button id="editButton{{ $data->id }}" class="btn btn-sm btn-primary"
                                        onclick="EditSKP({{ $data->id }})">Edit</button>
                                    <button id="simpanButton{{ $data->id }}" onclick="SimpanSKP({{ $data->id }})"
                                        style="display: none;" class="btn btn-sm btn-primary">Simpan</button>
                                    <button id="cancelButton{{ $data->id }}" onclick="CancelSKP({{ $data->id }})"
                                        style="display: none;" class="btn btn-sm btn-danger">Batal</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function EditSKP(id) {
                // Sembunyikan tombol Edit
                document.getElementById(`editButton${id}`).style.display = "none";

                // Tampilkan tombol Simpan dan Batal
                document.getElementById(`simpanButton${id}`).style.display = "block";
                document.getElementById(`cancelButton${id}`).style.display = "block";

                // Dapatkan nilai saat ini
                var nilai = document.getElementById(`nilai${id}`).textContent;

                // Simpan nilai saat ini sebagai nilai sebelumnya
                document.getElementById(`nilai${id}`).setAttribute('data-nilai-sebelumnya', nilai);

                // Gantikan nilai dengan elemen select
                document.getElementById(`nilai${id}`).innerHTML = `
        <select id="nilaiSelect${id}">
            <option value='Sangat Baik' ${nilai === 'Sangat Baik' ? 'selected' : ''}>Sangat Baik</option>
            <option value='Baik' ${nilai === 'Baik' ? 'selected' : ''}>Baik</option>
            <option value='Butuh Perbaikan' ${nilai === 'Butuh Perbaikan' ? 'selected' : ''}>Butuh Perbaikan</option>
            <option value='Kurang' ${nilai === 'Kurang' ? 'selected' : ''}>Kurang</option>
            <option value='Sangat Kurang' ${nilai === 'Sangat Kurang' ? 'selected' : ''}>Sangat Kurang</option>
        </select>
    `;
            }

            function SimpanSKP(id) {
                // Dapatkan nilai yang baru diinputkan
                var nilaiBaru = document.getElementById(`nilaiSelect${id}`).value;

                // Kirim permintaan Ajax untuk menyimpan nilai
                $.ajax({
                    url: `/skp/${id}`,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nilai: nilaiBaru
                    },
                    success: function(response) {
                        alert(response.message);

                        // Tampilkan tombol Edit
                        document.getElementById(`editButton${id}`).style.display = "block";

                        // Sembunyikan tombol Simpan dan Batal
                        document.getElementById(`simpanButton${id}`).style.display = "none";
                        document.getElementById(`cancelButton${id}`).style.display = "none";

                        // Gantikan elemen select dengan nilai yang baru disimpan
                        document.getElementById(`nilai${id}`).innerHTML = nilaiBaru;
                    },
                    error: function(error) {
                        alert('Gagal memperbarui nilai.');
                    }
                });
            }

            function CancelSKP(id) {
                // Tampilkan tombol Edit
                document.getElementById(`editButton${id}`).style.display = "block";

                // Sembunyikan tombol Simpan dan Batal
                document.getElementById(`simpanButton${id}`).style.display = "none";
                document.getElementById(`cancelButton${id}`).style.display = "none";

                // Kembalikan elemen select ke nilai sebelumnya (tidak tersimpan)
                var nilaiSebelumnya = document.getElementById(`nilai${id}`).getAttribute('data-nilai-sebelumnya');
                document.getElementById(`nilai${id}`).innerHTML = nilaiSebelumnya;
            }
        </script>
    @endsection
