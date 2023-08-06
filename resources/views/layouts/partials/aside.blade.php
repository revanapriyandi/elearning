<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="default.html" target="_blank">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Dashboards') }}</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Materi Pelajaran
                </h6>
            </li>
            <li class="nav-item">
                <a href="{{ route('materi') }}" class="nav-link {{ request()->is('materi*') ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-powerpoint text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Materi') }}</span>
                </a>
            </li>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Computer Based Test
                        (CBT)
                    </h6>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#banksoal" class="nav-link" aria-controls="banksoal"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-discourse fa-discourse text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Bank Soal') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('cbt/banksoal*') ? 'show' : '' }}" id="banksoal"
                        style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('cbt/banksoal/quiz*') ? 'active' : '' }}"
                                    href="{{ route('banksoal') }}">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Tugas Quiz </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('cbt/banksoal/ujian*') ? 'active' : '' }}"
                                    href="{{ route('banksoal.ujian') }}">
                                    <span class="sidenav-mini-icon"> U </span>
                                    <span class="sidenav-normal"> Ujian </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">
                        Rombongan Belajar
                    </h6>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rombel') }}" class="nav-link {{ request()->is('rombel*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Rombongan Belajar') }}</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Report
                    </h6>
                </li>
                <li class="nav-item">
                    <a href="{{ route('presensi.data') }}"
                        class="nav-link {{ request()->is('report/presensi*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-object-group text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Presensi') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.dataNilai') }}"
                        class="nav-link {{ request()->is('report/siswa/nilai*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-graduation-cap text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Hasil Ujian') }}</span>
                    </a>

                </li>
            @endif

            @if (auth()->user()->role == 'siswa')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Presensi
                    </h6>
                </li>
                <li class="nav-item">
                    <a href="{{ route('presensi') }}"
                        class="nav-link {{ request()->is('presensi*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file-powerpoint text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Presensi') }}</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Computer Based Test
                        (CBT)
                    </h6>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mod') }}" class="nav-link {{ request()->is('mod*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-keyboard text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('CBT') }}</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Report
                    </h6>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.detailNilai', auth()->user()->siswa->id) }}"
                        class="nav-link {{ request()->is('report/siswa/nilai*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-graduation-cap text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Hasil Ujian') }}</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Forum</h6>
            </li>
            <li class="nav-item">
                <a href="{{ route('ruangdiskusi') }}"
                    class="nav-link  {{ request()->is('ruangdiskusi*') ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Ruang Diskusi') }}</span>
                </a>
            </li>
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MASTER DATA</h6>
                </li>
            @endif
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('tahun-ajaran.index') }}"
                        class="nav-link {{ request()->is('masterdata/tahun-ajaran*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-calendar-days text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Tahun Ajaran / Semester') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas') }}"
                        class="nav-link {{ request()->is('masterdata/kelas*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-landmark text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Kelas') }}</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('mapel.index') }}"
                        class="nav-link {{ request()->is('masterdata/mapel*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-object-group text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Mata Pelajaran') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                <li class="nav-item">
                    <a href="{{ route('siswa.index') }}"
                        class="nav-link {{ request()->is('masterdata/siswa*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-screen-users text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Siswa') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('guru.index') }}"
                        class="nav-link {{ request()->is('masterdata/guru*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-chalkboard-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Guru') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ request()->is('masterdata/user*') ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Users') }}</span>
                    </a>
                </li>
            @endif
            {{-- @if (auth()->user()->role == 'admin')
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">SITE ADMINISTRATION</h6>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('General') }}</span>
                    </a>
                </li>
            @endif --}}

        </ul>
    </div>
    <div class="sidenav-footer mx-3 my-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">{{ auth()->user()->nama_lengkap }}</h6>
                    <p class="text-xs font-weight-bold mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); showAlert();"
            class="btn btn-danger btn-sm w-100 mb-3">
            <i class="fa-solid fa-right-from-bracket p-1"></i>
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <script>
            function showAlert() {
                if (confirm("Apakah Anda yakin ingin keluar?")) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>

    </div>
</aside>
