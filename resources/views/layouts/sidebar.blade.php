<style>
    /* Gaya untuk container gambar */
    .img-container {
        display: inline-block;
        position: relative;
        margin: 10px;
        /* Atur jarak dari elemen lain jika diperlukan */
    }

    /* Gaya untuk gambar */
    .img-container img {
        width: 45px;
        /* Atur lebar gambar sesuai kebutuhan */
        border: 2px solid white;
        /* Atur ketebalan dan warna stroke di pinggir gambar */
    }
    .sidedrop {
        color: white;
        background-color: rgb(10, 10, 90);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        font-size: 14px;
        white-space: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        line-height: 25px;
        position: relative;
        margin: 0px 0px 2px;
        padding: 10px;
        border-radius: 7px;
        gap: 15px;
        font-weight: 400;
        display: none;
    }

</style>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div
            class="brand-logo d-flex align-items-center justify-content-between"style="background-color: rgb(10, 10, 90)">
            <a href="./index.html" class="text-nowrap logo-img">
                <div class="img-container">
                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="" />
                </div>
            </a>
            <h2 style="color: white">ABSENSI</h2>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <br>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li> --}}
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ '/home' }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <b><span class="hide-menu">BERANDA</span></b>
                    </a>
                </li>

                @if (Auth::user()->roles[0]->name == 'SUPER ADMIN')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ '/user' }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <b> <span class="hide-menu">User</span></b>
                        </a>
                    </li>
                @endif
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('pegawai.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">DATA KARYAWAN PNS</span></b>
                    </a>
                </li>
                <li class="sidebar-item" id="non-pns">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">DATA KARYAWAN NON <br> PNS</span></b>
                    </a>
                    <a class="sidedrop" href="{{ route('karyawan_non_pns.index') }}" aria-expanded="false" id="dropdown">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">NON PNS AKTIF</span></b>
                    </a>
                    <a class="sidedrop" href="{{ route('karyawan_non_pns.index') }}" aria-expanded="false" id="dropdown2">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu" >NON PNS TIDAK AKTIF</span></b>
                    </a>
                </li>
                <li class="sidebar-item" id="bukan-non-pns">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">DATA KARYAWAN BUKAN <br> NON PNS</span></b>
                    </a>
                    <a class="sidedrop" href="{{ route('karyawan_bukan_non_pns.index') }}" aria-expanded="false" id="dropdown3">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">BUKAN NON PNS AKTIF</span></b>
                    </a>
                    <a class="sidedrop" href="{{ route('karyawan_bukan_non_pns.index') }}" aria-expanded="false" id="dropdown4">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu" >BUKAN NON PNS TIDAK AKTIF</span></b>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0);" data-toggle="collapse" aria-expanded="false">
                        <span>
                            <i class="fa fa-users fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">DATA KARYAWAN BUKAN <br> NON PNS</span></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" style="padding-left: 15px">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('karyawan_bukan_non_pns.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa fa-users fa-fw"></i>
                                    </span>
                                    <b><span class="hide-menu">DATA KARYAWAN BUKAN <br> NON PNS AKTIF</span></b>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="" aria-expanded="false">
                                    <span>
                                        <i class="fa fa-users fa-fw"></i>
                                    </span>
                                    <b><span class="hide-menu">DATA KARYAWAN BUKAN <br> NON PNS TIDAK AKTIF</span></b>
                                </a>
                            </li>
                            <!-- Anda dapat menambahkan submenu lainnya di sini -->
                        </ul>
                    </div>
                </li> --}}
                @if (Auth::user()->roles[0]->name == 'SUPER ADMIN')
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('hargajabatan.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-list-alt fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">MASTER PERINGKAT DAN <br>HARGA JABATAN</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('harikerjapuasa.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-list-alt fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">MASTER HARI KERJA <br> PUASA</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('libur.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">LIBUR NASIONAL</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('skp.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-trophy fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">PRESTASI KINERJA</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('liburlokal.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-calendar fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">LIBUR LOKAL</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('izin.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-close fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">BERHALANGAN HADIR</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('konfirmasi.index') }}" aria-expanded="false"
                        style="position: relative;">
                        <span>
                            <i class="fa fa-envelope-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">PERMINTAAN <br>BERHALANGAN <br>HADIR BARU</span></b>
                        <span class="badge badge-pill badge-danger" id="notification-badge"
                            style="background-color: red; position: absolute; top: 1px; right: 1px;">0</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-files-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">REKAP KEHADIRAN <br> PEGAWAI</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('tukin.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-files-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">REKAP TUNJANGAN</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-check-square-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">STATUS KEHADIRAN <br> PEGAWAI HARI INI</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('import.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-folder-open-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">IMPORT <br> KEHADIRAN PEGAWAI</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-folder-open-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">EXPORT KEHADIRAN <br> PEGAWAI & TUKIN</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-folder-open-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">EXPORT TUKIN <br> TAHUNAN</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-folder-open-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">EXPORT LAPORAN <br> KEHADIRAN</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('arsiptukin.index') }}" aria-expanded="false">
                        <span>
                            <i class="fa fa-folder-open-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">ARSIP TUKIN & <br>KEHADIRAN</span></b>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-line-chart fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">MONITORING KEHADIRAN</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-bar-chart fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">GRAFIK KEHADIRAN</span></b>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-lock fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">GANTI PASSWORD</span></b>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

@if (Auth::user()->roles[0]->name == 'ADMIN SATKER')
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div
                class="brand-logo d-flex align-items-center justify-content-between"style="background-color: rgb(10, 10, 90)">
                <a href="./index.html" class="text-nowrap logo-img">
                    <div class="img-container">
                        <img src="{{ asset('assets/img/logo.jpg') }}" alt="" />
                    </div>
                </a>
                <h2 style="color: white">ABSENSI</h2>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <br>
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li> --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ '/home' }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <b><span class="hide-menu">BERANDA</span></b>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pegawai.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-users fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">DATA KARYAWAN PNS</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-users fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">DATA KARYAWAN NON <br> PNS</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-users fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">DATA KARYAWAN BUKAN <br> NON PNS</span></b>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('skp.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-trophy fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">PREASTASI KINERJA</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('liburlokal.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">LIBUR LOKAL</span>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('izin.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-close fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">BERHALANGAN HADIR</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('konfirmasi.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa fa-envelope-o fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">PERMINTAAN <br>BERHALANGAN <br>HADIR BARU</span></b>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-folder-open-o fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">REKAP KEHADIRAN <br> PEGAWAI</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-folder-open-o fa-fw"></i>
                            </span>
                            <b> <span class="hide-menu">IMPORT ABSENSI</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-folder-open-o fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">ARSIP TUKIN & KEHADIRAN</span></b>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">GANTI PASSWORD</span></b>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
@endif

<script>
    // Menggunakan JavaScript untuk mengambil data notifikasi dari endpoint
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('get.notifications') }}")
            .then(response => response.json())
            .then(data => {
                if (data.notif > 0) {
                    document.getElementById("notification-badge").textContent = data.notif;
                }
            });
    });

    // Mendapatkan referensi ke elemen-elemen yang diperlukan
    const nonPns = document.getElementById("non-pns");
    const dropdown = document.getElementById("dropdown");
    const dropdown2 = document.getElementById("dropdown2");

    // Menambahkan event handler onmouseover pada button
    nonPns.onclick = function() {
        // Cek apakah dropdown sedang ditampilkan atau tidak
        if (dropdown.style.display === "block") {
            // Jika ditampilkan, sembunyikan dropdown
            dropdown.style.display = "none";
            dropdown2.style.display = "none";
        } else {
            // Jika tidak ditampilkan, tampilkan dropdown
            dropdown.style.display = "block";
            dropdown2.style.display = "block";
        }
    };

    // Mendapatkan referensi ke elemen-elemen yang diperlukan
    const bknNonPns = document.getElementById("bukan-non-pns");
    const dropdown3 = document.getElementById("dropdown3");
    const dropdown4 = document.getElementById("dropdown4");

    // Menambahkan event handler onmouseover pada button
    bknNonPns.onclick = function() {
        // Cek apakah dropdown sedang ditampilkan atau tidak
        if (dropdown3.style.display === "block") {
            // Jika ditampilkan, sembunyikan dropdown
            dropdown3.style.display = "none";
            dropdown4.style.display = "none";

            bknNonPns.classList.remove("active");
        } else {
            // Jika tidak ditampilkan, tampilkan dropdown
            dropdown3.style.display = "block";
            dropdown4.style.display = "block";

            bknNonPns.classList.add("active");
        }
    };

    // Menambahkan event handler saat dropdown dipilih
    dropdown.addEventListener("click", function() {
        // Tambahkan kelas "active" ke elemen nonPns saat dropdown dipilih
        nonPns.classList.add("active");
    });
</script>
