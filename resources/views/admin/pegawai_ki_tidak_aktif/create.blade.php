@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom lg-5 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="col-lg-10">
                    <h4 class="pheader"><i class="fa fa-list fa-fw"></i> TAMBAH DATA KARYAWAN <font color='#ff0000'></font>

                    </h4>
                </div>
            </div>
            <hr>
            <!-- Kolom lg-12 -->
            <div class="col-md-12">
                <form action="{{ route('karyawan_bukan_non_pns.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h5>BADGENUMBER</h5>
                            <input name="badgenumber" type="text" class="form-control" value="0">
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>BADGENUMBER BARU</h5>
                            <input type="text" name="badgenumber_baru" class="form-control">
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>NIP</h5>
                            <input type="text" name="nip" class="form-control">
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>NAMA</h5>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>Direktorat</h5>
                            <select name="direktorat" id="direktorat" class="form-control" required>
                                <option value="">-- Pilih Direktorat --</option>
                                @foreach ($direktorats as $direktorat)
                                    <option value="{{ $direktorat->direktorat_id }}">{{ $direktorat->direktorat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>Satker / Unit Kerja</h5>
                            <div id="isisatker">
                                <select name="satker_id" id="satker_p" class="form-control">
                                    <!-- Opsi satker akan diisi melalui JavaScript -->
                                </select>
                            </div>
                            *Dipilih ketika pegawai akan dimasukkan ke dalam satker / unit kerja tertentu
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class="col-md-12">
                            <h5>PPK</h5>
                            <div id="isisatker">
                                <select name="ppk_id" id="ppk_p" class="form-control">
                                    <!-- Opsi satker akan diisi melalui JavaScript -->
                                </select>
                            </div>
                            *Dipilih ketika pegawai akan dimasukkan ke dalam PPK / Subdit tertentu
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class='col-md-12'>
                            <h5>URAIAN JABATAN</h5>
                            <input type="text" name="jabatan" class="form-control">
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class='col-md-12'>
                            <h5>Status Kepegawaian</h5>
                            <select class="form-control well1" id="status" name="status">
                                <option value="1">PNS</option>
                            </select>
                        </div>
                        <div class='col-md-12'><br></div>
                        <div class='col-md-12'>
                            <h5>Aktif</h5>
                            <select class="form-control" id="aktif" name="aktif">
                                <option value="Aktif" selected>Aktif</option>
                                <option value="Tidak Aktif" selected>Tidak Aktif</option>
                                <!-- Sisipkan opsi lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class='col-md-12'></div>
                        <div class="col-md-12" style="padding-top: 20px;">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <button class="btn btn-danger" id="cancel"
                                onclick="window.history.go(-1); return false;">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('direktorat').addEventListener('change', function() {
            const selectedDirektoratId = this.value;
            const satkerSelect = document.getElementById('satker_p');
            const ppkSelect = document.getElementById('ppk_p');

            satkerSelect.innerHTML = '<option value="0">-- Isi Satker --</option>';
            ppkSelect.innerHTML = '<option value="0">-- Isi PPK --</option>';

            if (selectedDirektoratId) {
                fetch(`/get-satker_p/${selectedDirektoratId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(satker => {
                            const option = document.createElement('option');
                            option.value = satker.satker_id;
                            option.textContent = satker.nama;
                            satkerSelect.appendChild(option);
                        });
                    });

                fetch(`/get-ppk/${selectedDirektoratId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(ppk => {
                            const option = document.createElement('option');
                            option.value = ppk.satker_id; // Ganti dengan kolom yang sesuai
                            option.textContent = ppk.nama;
                            ppkSelect.appendChild(option);
                        });
                    });

                // Mengaktifkan pilihan Satker dan PPK
                satkerSelect.disabled = false;
                ppkSelect.disabled = false;
            } else {
                // Menonaktifkan pilihan Satker dan PPK jika tidak ada Direktorat yang dipilih
                satkerSelect.disabled = true;
                ppkSelect.disabled = true;
            }
        });

        // Menambahkan event listener untuk memeriksa pemilihan Satker
        document.getElementById('satker_p').addEventListener('change', function() {
            const selectedSatkerId = this.value;
            const ppkSelect = document.getElementById('ppk_p');

            if (selectedSatkerId) {
                // Menonaktifkan pilihan PPK jika Satker dipilih
                ppkSelect.disabled = true;
            } else {
                // Mengaktifkan pilihan PPK jika tidak ada Satker yang dipilih
                ppkSelect.disabled = false;
            }

            // Memeriksa jika Satker kembali ke nilai 0, maka mengaktifkan kembali pilihan PPK
            if (selectedSatkerId === "0") {
                ppkSelect.disabled = false;
            }
        });

        // Menambahkan event listener untuk memeriksa pemilihan PPK
        document.getElementById('ppk_p').addEventListener('change', function() {
            const selectedPpkId = this.value;
            const satkerSelect = document.getElementById('satker_p');

            if (selectedPpkId) {
                // Menonaktifkan pilihan Satker jika PPK dipilih
                satkerSelect.disabled = true;
            } else {
                // Mengaktifkan pilihan Satker jika tidak ada PPK yang dipilih
                satkerSelect.disabled = false;
            }

            // Memeriksa jika PPK kembali ke nilai 0, maka mengaktifkan kembali pilihan Satker
            if (selectedPpkId === "0") {
                satkerSelect.disabled = false;
            }
        });
    </script>
@endsection
