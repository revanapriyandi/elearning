<div class="row">
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Kelas</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $kelas = App\Models\Kelas::count();
                                @endphp
                                {{ $kelas }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Mata Pelajaran</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $mapel = App\Models\MataPelajaran::count();
                                @endphp
                                {{ $mapel }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="fa-brands fa-discourse text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Siswa</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $siswa = App\Models\Siswa::count();
                                @endphp
                                {{ $siswa }}
                            </h5>

                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="fa-sharp fa-solid fa-users text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Guru</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $guru = App\Models\Guru::count();
                                @endphp
                                {{ $guru }}
                            </h5>

                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="fa-solid fa-chalkboard-user text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
