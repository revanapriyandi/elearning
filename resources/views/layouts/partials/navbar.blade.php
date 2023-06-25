<nav class="navbar navbar-main navbar-expand-lg  @if (request()->is('mod')) 'bg-transparent shadow-none position-absolute px-4 w-100 z-index-2 mt-n11' @else 'px-0 mx-4 shadow-none border-radius-xl z-index-sticky' @endif "
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        @if (!request()->is('mod/exam/*'))
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none p-1">
                <a href="javascript:;" class="nav-link p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('user.edit', auth()->user()->id) }}"
                            class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">{{ auth()->user()->nama_lengkap }}</span>
                        </a>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0">
                            <i class="fa fa-clock"></i>
                            <span class="ms-2">
                                <span id="waktu"></span>
                            </span>
                            @push('scripts')
                                <script>
                                    setInterval(() => {
                                        var now = new Date();
                                        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now.getDay()];
                                        var tanggal = now.getDate().toString().padStart(2, '0');
                                        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                                            'Oktober', 'November', 'Desember'
                                        ][now.getMonth()];
                                        var tahun = now.getFullYear();
                                        var jam = now.getHours().toString().padStart(2, '0');
                                        var menit = now.getMinutes().toString().padStart(2, '0');
                                        var detik = now.getSeconds().toString().padStart(2, '0');
                                        var waktu = hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun + ' ' + jam + ':' + menit + ':' + detik;
                                        document.getElementById("waktu").textContent = waktu;
                                    }, 1000);
                                </script>
                            @endpush
                        </a>
                    </li>
                </ul>
            </div>
        @endif

    </div>
</nav>
