<div class="row">
    <div class="col-lg-6 col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card overflow-hidden shadow-lg"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports1.jpg'); background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="ni ni-circle-08 text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                    {{ $guru->count() }}
                                </h5>
                                <span class="text-white text-sm">{{ __('Jumlah Guru') }}</span>
                            </div>
                            <div class="col-4">
                                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                    {{ ($guru->count() / 100) * 100 }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card overflow-hidden shadow-lg"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports2.jpg'); background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="ni ni-active-40 text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                    {{ $guru->where('user.jenis_kelamin', 'L')->count() }}
                                </h5>
                                <span class="text-white text-sm">{{ __('Guru Laki Laki') }}</span>
                            </div>
                            <div class="col-4">
                                @if ($guru->count() > 0)
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        {{ ($guru->where('user.jenis_kelamin', 'L')->count() / $guru->count()) * 100 }}%
                                    </p>
                                @else
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        0%
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card overflow-hidden shadow-lg"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports3.jpg'); background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="ni ni-cart text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                    {{ $guru->where('user.jenis_kelamin', 'P')->count() }}
                                </h5>
                                <span class="text-white text-sm">{{ __('Guru Perempuan') }}</span>
                            </div>
                            <div class="col-4">
                                @if ($guru->count() > 0)
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        {{ ($guru->where('user.jenis_kelamin', 'P')->count() / $guru->count()) * 100 }}%
                                    </p>
                                @else
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        0%
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                <div class="card overflow-hidden shadow-lg"
                    style="background-image: url('https://www.riau.go.id/home/bankdataimage/pentingnya-guru-menguasai-kompetensi-pedagogik.jpg'); background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="ni ni-active-40 text-dark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                    {{ $guru->where('created_at', '>=', now()->subMonths(6))->count() }}
                                </h5>
                                <span class="text-white text-sm">{{ __('Guru baru dalam 6 bulan') }}</span>
                            </div>
                            <div class="col-4">
                                @if ($guru->count() > 0)
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        {{ ($guru->where('created_at', '>=', now()->subMonths(6))->count() / $guru->count()) * 100 }}%
                                    </p>
                                @else
                                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">
                                        0%
                                    </p>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">{{ __('Grafik') }}</h6>
            </div>
            <div class="card-body pb-0 p-3">
                <div class="chart">
                    <canvas id="chart" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var ctx1 = document.getElementById("chart").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "bar",
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: "Guru",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: {!! json_encode($guruCount->values()) !!},
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
