    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            @if (auth()->user()->id_role == 1) Wadir III
                <li class="nav-item {{ request()->is('dashboard-wadir3') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('wadir3.index') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-item {{ request()->is('wadir3/mahasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('wadir3-mahasiswa.index') }}">
                        <i class="ti-agenda menu-icon"></i>
                        <span class="menu-title">Data Mahasiswa</span>
                    </a>
                </li> --}}

                <li class="nav-item {{ request()->is('wadir3-beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('wadir3-beasiswa.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Data Beasiswa</span>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->is('wadir3/laporan-beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('wadir3.laporan') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Data Penerima <br> Beasiswa</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->id_role == 2) Akademik
                <li class="nav-item {{ request()->is('akademik') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akademik.index') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->is('akademik-beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akademik-beasiswa.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Data Beasiswa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('akademik/calon_penerima_beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akademik.calon_penerima_beasiswa') }}">
                        <i class="ti-agenda menu-icon"></i>
                        <span class="menu-title">Data Calon <br>Penerima Beasiswa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('akademik/laporan-beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akademik.laporan') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Laporan</span>
                    </a>
                </li>

            @endif

            @if (auth()->user()->id_role == 3) Admin Prodi
                <li class="nav-item {{ request()->is('admin-prodi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin-prodi.index') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/mahasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                        <i class="ti-agenda menu-icon"></i>
                        <span class="menu-title">Data Mahasiswa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/beasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('beasiswa.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Data Beasiswa</span>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->is('admin/pengumuman') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin-prodi.pengumuman') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Pengajuan <br>Rekomendasi<br> Mahasiswa</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->id_role == 4) Mahasiswa

                <li class="nav-item {{ request()->is('dashboard-mahasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item 
                    @if($beep_profile)
                    beep 
                    @endif
                    {{ request()->is('profile-mahasiswa/'.auth()->user()->id) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.profile', auth()->user()->id) }}">
                        <i class="ti-user menu-icon"></i>
                        <span class="menu-title">Profile
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('pendaftaran_beasiswa/'.auth()->user()->id) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.pendaftaran-beasiswa', auth()->user()->id) }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Pendaftaran Beasiswa</span>
                    </a>
                </li>

                <li class="nav-item 
                    @if($beep_datarumah)
                    beep 
                    @elseif($beep_datakeluarga)
                    beep
                    @endif
                    {{ request()->is('datarumah-mahasiswa/'. auth()->user()->id) ? 'active' : '' }}
                    {{ request()->is('datakeluarga-mahasiswa/'. auth()->user()->id) ? 'active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="ti-id-badge menu-icon"></i>
                        <span class="menu-title">Data Pribadi</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->is('datarumah-mahasiswa/'. auth()->user()->id) ? 'show' : '' }}
                                        {{ request()->is('datakeluarga-mahasiswa/'. auth()->user()->id) ? 'show' : '' }}" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item 
                                @if($beep_datarumah)
                                beep 
                                @endif
                                {{ request()->is('datarumah-mahasiswa/'. auth()->user()->id) ? 'active' : '' }}"> <a class="nav-link"
                                href="{{ route('datarumah-mahasiswa.show' , auth()->user()->id) }}">Data Rumah</a>
                            </li>
                            <li class="nav-item 
                                @if($beep_datakeluarga)
                                beep 
                                @endif
                                {{ request()->is('datakeluarga-mahasiswa/'. auth()->user()->id) ? 'active' : '' }}"> <a class="nav-link"
                                href="{{ route('datakeluarga-mahasiswa.show' , auth()->user()->id) }}">Data Keluarga</a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                <li class="nav-item {{ request()->is('pengumuman-mahasiswa/'.auth()->user()->id) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.pengumuman', auth()->user()->id) }}">
                        <i class="ti-pulse menu-icon"></i>
                        <span class="menu-title">Pengumuman</span>
                    </a>
                </li>

            @endif
        </ul>
    </nav>
