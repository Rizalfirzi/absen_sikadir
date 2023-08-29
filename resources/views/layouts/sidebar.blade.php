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
                        <a class="sidebar-link" href="{{'/user'}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <b> <span class="hide-menu">User</span></b>
                        </a>
                    </li>
                @endif
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pegawai.index')}}" aria-expanded="false">
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
                @if (Auth::user()->roles[0]->name == 'SUPER ADMIN')
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('hargajabatan.index')}}" aria-expanded="false">
                            <span>
                                <i class="fa fa-list-alt fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">MASTER PERINGKAT DAN <br>HARGA JABATAN</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('harikerjapuasa.index')}}" aria-expanded="false">
                            <span>
                                <i class="fa fa-list-alt fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">MASTER HARI KERJA <br> PUASA</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('libur.index')}}" aria-expanded="false">
                            <span>
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">LIBUR NASIONAL</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('skp.index')}}" aria-expanded="false">
                        <span>
                            <i class="fa fa-trophy fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">PREASTASI KINERJA</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('liburlokal.index')}}" aria-expanded="false">
                        <span>
                            <i class="fa fa-calendar fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">LIBUR LOKAL</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('izin.index')}}" aria-expanded="false">
                        <span>
                            <i class="fa fa-close fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">BERHALANGAN HADIR</span></b>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="fa fa-envelope-o fa-fw"></i>
                        </span>
                        <b><span class="hide-menu">PERMINTAAN <br>BERHALANGAN <br>HADIR BARU</span></b>
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
                    <a class="sidebar-link" href="{{route('tukin.index')}}" aria-expanded="false">
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
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
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
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
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
                        <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
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
                        <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-trophy fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">PREASTASI KINERJA</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">LIBUR LOKAL</span>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                            <span>
                                <i class="fa fa-close fa-fw"></i>
                            </span>
                            <b><span class="hide-menu">BERHALANGAN HADIR</span></b>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
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
