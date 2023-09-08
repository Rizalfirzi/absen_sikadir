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
        <table id="" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
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
                        <td id="badgenumber{{ $data->id }}">{{ $data->badgenumber }}</td>
                        <td id="badgenumber_baru{{ $data->id }}">{{ $data->badgenumber_baru }}</td>
                        <td id="nama{{ $data->id }}">{{ $data->nama }}</td>
                        <td id="nip{{ $data->id }}">{{ $data->nip }}</td>
                        <td id="golonganRuang{{ $data->id }}" data-golongan-sebelumnya="{{ $data->golongan_ruang }}">
                            {{ $data->golongan_ruang }}</td>
                        <td id="jabatan{{ $data->id }}">{{ $data->jabatan }}</td>
                        <td id="gradeJabatan{{ $data->id }}">
                            @if ($data->gradejabatan === null || $data->gradejabatan == 0)
                                -
                            @else
                                {{ $data->gradejabatan }}
                            @endif
                        </td>
                        <td id="direktorat{{ $data->id }}">{{ $data->nama_direktorat }}</td>
                        <td id="satker{{ $data->id }}">
                            @if ($data->satker_id == '0' || $data->satker_id == '')
                                -
                            @else
                                {{ $data->nama_satker }}
                            @endif
                        </td>
                        <td id="ppk{{ $data->id }}">
                            @if ($data->ppk_id == '0' || $data->ppk_id == '')
                                -
                            @else
                                {{ $data->nama_satker }}
                            @endif
                        </td>

                        <td id="status{{ $data->id }}">
                            @if ($data->status == 1)
                                PNS
                            @endif
                        </td>
                        <td id="aktif{{ $data->id }}">{{ $data->aktif }}</td>
                        <td>
                            <div class="button-container">
                                <button id="editButton{{ $data->id }}" class="btn btn-sm btn-primary"
                                    onclick="EditPEG({{ $data->id }})">Edit</button>
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

    <script>
        function EditPEG(id) {
            // Sembunyikan tombol Edit
            document.getElementById(`editButton${id}`).style.display = "none";

            // Tampilkan tombol Simpan dan Batal
            document.getElementById(`simpanButton${id}`).style.display = "block";
            document.getElementById(`cancelButton${id}`).style.display = "block";

            // Dapatkan nilai-nilai saat ini dari elemen-elemen yang sesuai
            var badgenumber = document.getElementById(`badgenumber${id}`).textContent;
            var badgenumber_baru = document.getElementById(`badgenumber_baru${id}`).textContent;
            var nama = document.getElementById(`nama${id}`).textContent;
            var nip = document.getElementById(`nip${id}`).textContent;
            var golonganRuang = document.getElementById(`golonganRuang${id}`).textContent;
            var jabatan = document.getElementById(`jabatan${id}`).textContent;
            var gradeJabatan = document.getElementById(`gradeJabatan${id}`).textContent;
            var direktorat = document.getElementById(`direktorat${id}`).textContent;
            var satker = document.getElementById(`satker${id}`).textContent;
            var ppk = document.getElementById(`ppk${id}`).textContent;
            var status = document.getElementById(`status${id}`).textContent;
            var aktif = document.getElementById(`aktif${id}`).textContent;

            // Gantikan nilai-nilai dengan input text
            document.getElementById(`badgenumber${id}`).innerHTML =
                `<input type="text" id="input_badgenumber${id}" value="${badgenumber}">`;
            document.getElementById(`badgenumber_baru${id}`).innerHTML =
                `<input type="text" id="input_badgenumber_baru${id}" value="${badgenumber_baru}">`;
            document.getElementById(`nama${id}`).innerHTML = `<input type="text" id="input_nama${id}" value="${nama}">`;
            document.getElementById(`nip${id}`).innerHTML = `<input type="text" id="input_nip${id}" value="${nip}">`;
            document.getElementById(`golonganRuang${id}`).innerHTML =
                `<input type="text" id="input_golonganRuang${id}" value="${golonganRuang}">`;
            document.getElementById(`jabatan${id}`).innerHTML =
                `<input type="text" id="input_jabatan${id}" value="${jabatan}">`;
            document.getElementById(`gradeJabatan${id}`).innerHTML =
                `<input type="text" id="input_gradeJabatan${id}" value="${gradeJabatan}">`;
            document.getElementById(`direktorat${id}`).innerHTML =
                `<input type="text" id="input_direktorat${id}" value="${direktorat}">`;
            document.getElementById(`satker${id}`).innerHTML =
                `<input type="text" id="input_satker${id}" value="${satker}">`;
            document.getElementById(`ppk${id}`).innerHTML = `<input type="text" id="input_ppk${id}" value="${ppk}">`;
            document.getElementById(`status${id}`).innerHTML =
                `<select id="input_status${id}">
                <option value='1' ${status === 'PNS' ? 'selected' : ''}>PNS</option>
            </select>
                `;
            document.getElementById(`aktif${id}`).innerHTML = `<input type="text" id="input_aktif${id}" value="${aktif}">`;
        }

        function SimpanPEG(id) {
            // Dapatkan nilai-nilai yang baru diinputkan
            var badgenumber = document.getElementById(`input_badgenumber${id}`).value;
            var badgenumber_baru = document.getElementById(`input_badgenumber_baru${id}`).value;
            var nama = document.getElementById(`input_nama${id}`).value;
            var nip = document.getElementById(`input_nip${id}`).value;
            var golonganRuang = document.getElementById(`input_golonganRuang${id}`).value;
            var jabatan = document.getElementById(`input_jabatan${id}`).value;
            var gradeJabatan = document.getElementById(`input_gradeJabatan${id}`).value;
            var direktorat = document.getElementById(`input_direktorat${id}`).value;
            var satker = document.getElementById(`input_satker${id}`).value;
            var ppk = document.getElementById(`input_ppk${id}`).value;
            var status = document.getElementById(`input_status${id}`).value;
            var aktif = document.getElementById(`input_aktif${id}`).value;

            // Kirim permintaan Ajax untuk menyimpan data
            $.ajax({
                url: `/pegawai/${id}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    badgenumber: badgenumber,
                    badgenumber_baru: badgenumber_baru,
                    nama: nama,
                    nip: nip,
                    golonganRuang: golonganRuang,
                    jabatan: jabatan,
                    gradeJabatan: gradeJabatan,
                    direktorat: direktorat,
                    satker: satker,
                    ppk: ppk,
                    status: status,
                    aktif: aktif
                },
                success: function(response) {
                    alert(response.message);

                    // Tampilkan tombol Edit
                    document.getElementById(`editButton${id}`).style.display = "block";

                    // Sembunyikan tombol Simpan dan Batal
                    document.getElementById(`simpanButton${id}`).style.display = "none";
                    document.getElementById(`cancelButton${id}`).style.display = "none";

                    // Gantikan input text dengan nilai yang baru disimpan
                    document.getElementById(`badgenumber${id}`).textContent = badgenumber;
                    document.getElementById(`badgenumber_baru${id}`).textContent = badgenumber_baru;
                    document.getElementById(`nama${id}`).textContent = nama;
                    document.getElementById(`nip${id}`).textContent = nip;
                    document.getElementById(`golonganRuang${id}`).textContent = golonganRuang;
                    document.getElementById(`jabatan${id}`).textContent = jabatan;
                    document.getElementById(`gradeJabatan${id}`).textContent = gradeJabatan;
                    document.getElementById(`direktorat${id}`).textContent = direktorat;
                    document.getElementById(`satker${id}`).textContent = satker;
                    document.getElementById(`ppk${id}`).textContent = ppk;
                    document.getElementById(`status${id}`).textContent = status;
                    document.getElementById(`aktif${id}`).textContent = aktif;
                },
                error: function(error) {
                    alert('Gagal memperbarui data pegawai.');
                }
            });
        }

        function CancelPEG(id) {
            // Tampilkan tombol Edit
            document.getElementById(`editButton${id}`).style.display = "block";

            // Sembunyikan tombol Simpan dan Batal
            document.getElementById(`simpanButton${id}`).style.display = "none";
            document.getElementById(`cancelButton${id}`).style.display = "none";

            // Kembalikan elemen ke tampilan awal (tidak tersimpan)
            document.getElementById(`badgenumber${id}`).textContent = document.getElementById(`input_badgenumber${id}`).value;
            document.getElementById(`badgenumber_baru${id}`).textContent = document.getElementById(`input_badgenumber_baru${id}`).value;
            document.getElementById(`nama${id}`).textContent = document.getElementById(`input_nama${id}`).value;
            document.getElementById(`nip${id}`).textContent = document.getElementById(`input_nip${id}`).value;
            document.getElementById(`golonganRuang${id}`).textContent = document.getElementById(`input_golonganRuang${id}`).value;
            document.getElementById(`jabatan${id}`).textContent = document.getElementById(`input_jabatan${id}`).value;
            document.getElementById(`gradeJabatan${id}`).textContent = document.getElementById(`input_gradeJabatan${id}`).value;
            document.getElementById(`direktorat${id}`).textContent = document.getElementById(`input_direktorat${id}`).value;
            document.getElementById(`satker${id}`).textContent = document.getElementById(`input_satker${id}`).value;
            document.getElementById(`ppk${id}`).textContent = document.getElementById(`input_ppk${id}`).value;
            document.getElementById(`status${id}`).textContent = document.getElementById(`input_status${id}`).value;
            document.getElementById(`aktif${id}`).textContent = document.getElementById(`input_aktif${id}`).value;
        }
    </script>
@endsection
