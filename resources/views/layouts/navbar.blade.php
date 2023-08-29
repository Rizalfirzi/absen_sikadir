<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(10, 10, 90)">

        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                </a>
            </li>
        </ul>
        <div class="justify-content-end px-0" id="navbarNav" style="">
            <ul class="navbar-nav d-flex flex-row align-items-center justify-content-end">
                <li class="nav-item mr-3" style="padding-right: 50px">
                    <a style="color: white; font-size: 20px">
                            SISTEM INFORMASI KEHADIRAN PEGAWAI <br>
                            DIREKTORAT JENDERAL CIPTA KARYA

                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row align-items-center justify-content-end">
                <li class="nav-item mr-3" style="padding-right: 10px">
                    <a style="color: white">
                        Selamat Datang, {{ Auth::user()->username }}
                    </a>
                </li>
                <li class="nav-item" style="padding-right: 10px">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                        class="btn btn-outline-warning">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
