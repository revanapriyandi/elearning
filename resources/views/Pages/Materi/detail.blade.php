@extends('layouts.app')

@section('content')
    <section class="py-3">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-white">{{ __('Materi Pelajaran') }}</h4>
                <p class="text-white opacity-8">
                    Materi Pelajaran yang tersedia di {{ $data->nama_mapel }} <br>
                </p>
            </div>
            <div class="col-lg-6">
                <div class="d-flex">
                    @if (auth()->user()->role != 'siswa')
                        <a href="{{ route('materi.create', $data->id) }}" class="btn btn-icon btn-outline-white ms-2 export">
                            <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
                            <span class="btn-inner--text">Tambah Materi</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">{{ $data->nama_mapel }}</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                @php
                                    $tahunAjaran = App\Models\TahunAjaran::where('status', 1)->first();
                                @endphp
                                <small>Tahun Ajaran: {{ $tahunAjaran->name ?? 'unknown' }}</small>
                            </div>
                        </div>
                        <hr class="horizontal dark mb-0">
                    </div>
                    <div class="card-body p-3 pt-0">
                        <ul class="list-group list-group-flush" data-toggle="checklist">
                            @forelse ($data->materi as $key => $item)
                                <li
                                    class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3 materi-item">
                                    <div class="checklist-item checklist-item-dark ps-2 ms-3">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                @php
                                                    $read = App\Models\MateriRead::where('user_id', Auth::user()->id)
                                                        ->where('materi_id', $item->id)
                                                        ->first();
                                                @endphp

                                                <input class="form-check-input" type="checkbox"
                                                    onclick="readMateri({{ $item->id }})" value="" readonly
                                                    id="flexCheckDefault1"
                                                    {{ $read && $read->status && $read->status == 1 ? 'checked' : '' }}>

                                            </div>
                                            <h6 onclick="readMateri({{ $item->id }})"
                                                class="mb-0 text-dark font-weight-bold text-sm">
                                                {{ $item->judul }}
                                            </h6>
                                            <div class="dropdown float-lg-end ms-auto pe-4">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    data-bs-offset="10,20">
                                                    <i class="ni ni-bullet-list-67 text-dark"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:;" onclick="readMateri({{ $item->id }})"
                                                        class="dropdown-item">
                                                        <i class="ni ni-single-copy-04"></i>
                                                        <span>Read</span>
                                                    </a>
                                                    @if (auth()->user()->role != 'siswa')
                                                        <a href="{{ route('materi.edit', $item->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ni ni-settings-gear-65"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteMateri({{ $item->id }})"
                                                            class="dropdown-item">
                                                            <i class="ni ni-fat-remove"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div onclick="readMateri({{ $item->id }})"
                                            class="d-flex justify-content-between align-items-center ms-4 mt-3 ps-1">
                                            <div>
                                                <p class="text-xs mb-0 text-secondary font-weight-bold">
                                                    {{ __('Date') }}
                                                </p>
                                                <span
                                                    class="text-xs font-weight-bolder">{{ $item->created_at->format('d F Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center ms-4 mt-3 ps-1">
                                            <div class="materi-content">
                                                {!! Str::limit($item->content, 200, '...') !!}
                                                <a href="javascript:;" onclick="openMateriModal({{ $item->id }})"
                                                    class="btn btn-link">Readmore</a>

                                            </div>
                                        </div>

                                        <div class="row ms-4 ps-1">
                                            @php
                                                $files = explode(',', $data->file);
                                            @endphp

                                            @if ($item->file)
                                                @for ($i = 0; $i < count(explode(',', $item->file)); $i++)
                                                    @php
                                                        $file = explode(',', $item->file)[$i];
                                                        $namaFile = explode('.', $file)[0];
                                                        $ext = explode('.', $file)[1];
                                                        
                                                        switch ($ext) {
                                                            case 'pdf':
                                                                $icon = 'far fa-file-pdf';
                                                                break;
                                                            case 'doc':
                                                            case 'docx':
                                                                $icon = 'far fa-file-word';
                                                                break;
                                                            case 'xls':
                                                            case 'xlsx':
                                                                $icon = 'far fa-file-excel';
                                                                break;
                                                            case 'ppt':
                                                            case 'pptx':
                                                                $icon = 'far fa-file-powerpoint';
                                                                break;
                                                            case 'txt':
                                                                $icon = 'far fa-file-alt';
                                                                break;
                                                            case 'jpg':
                                                            case 'jpeg':
                                                            case 'png':
                                                            case 'gif':
                                                                $icon = 'far fa-file-image';
                                                                break;
                                                            case 'mp3':
                                                            case 'wav':
                                                                $icon = 'far fa-file-audio';
                                                                break;
                                                            case 'mp4':
                                                            case 'mov':
                                                            case 'avi':
                                                                $icon = 'far fa-file-video';
                                                                break;
                                                            default:
                                                                $icon = 'far fa-file';
                                                                break;
                                                        }
                                                        $urlFile = storage_path('uploads/' . $file);
                                                    @endphp
                                                    <a class="pt-3" onclick="readMateri({{ $item->id }})"
                                                        href="{{ route('download', $file) }}" target="_blank">
                                                        <div class="card bg-gradient-primary ms-3 ">
                                                            <div class="card-body p-3">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <div class="numbers">
                                                                            <p
                                                                                class="text-white text-uppercase text-sm mb-0 opacity-7">
                                                                                {{ $namaFile }}</p>
                                                                            <h5
                                                                                class="text-white font-weight-bolder mb-0 text-uppercase">
                                                                                {{ $ext }}</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 text-end">
                                                                        <div
                                                                            class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                                            <i class="{{ $icon }} text-dark text-lg opacity-10"
                                                                                aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="horizontal dark mt-4 mb-0">
                                </li>
                            @empty
                                <li
                                    class="list-group-item border-0 flex-column align-items-center justify-content-center ps-0 py-0 mb-3">
                                    <div class="checklist-item checklist-item-primary ps-2 ms-3 text-center">
                                        <div class="d-flex align-items-center items-center">
                                            <h6>{{ __('Belum ada data tersedia') }}</h6>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark mt-4 mb-0">
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                <div class="card overflow-hidden">
                    <div class="card-header p-3 pb-0">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <div class="ms-3">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                    Materi
                                </p>
                                @php
                                    $con = new App\Http\Controllers\MateriController();
                                    $newData = $con->getMateriData($data);
                                    $task = $newData['task'];
                                    $MateriComplete = $newData['MateriComplete'];
                                    
                                    $chartLabels = $newData['chartLabels'];
                                    $chartData = $newData['chartData'];
                                    
                                    $chartDone = $newData['chartDone'];
                                @endphp

                                <h5 class="font-weight-bolder mb-0">{{ $data->materi->count() }}</h5>
                            </div>
                            <div class="progress-wrapper ms-auto w-25">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">{{ $MateriComplete }}%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-info " role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $MateriComplete }}%;"
                                        aria-valuenow="{{ $MateriComplete }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3 p-0">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="100" width="746"
                                style="display: block; box-sizing: border-box; height: 100px; width: 746px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card overflow-hidden mt-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="d-flex">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa-regular fa-note-sticky text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                            Tugas
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">{{ $data->materi->count() }}</h5>
                                    </div>
                                </div>
                                <span class="badge badge-dot d-block text-start pb-0 mt-3">
                                    <i class="bg-gradient-info"></i>
                                    <span class="text-muted text-xs font-weight-bold">Done</span>
                                </span>
                                <span class="badge badge-dot d-block text-start">
                                    <i class="bg-gradient-secondary"></i>
                                    <span class="text-muted text-xs font-weight-bold">In progress</span>
                                </span>
                            </div>
                            <div class="col-lg-7 my-auto">
                                <div class="chart ms-auto">
                                    <canvas id="chart-bar" class="chart-canvas" height="150" width="714"
                                        style="display: block; box-sizing: border-box; height: 150px; width: 714px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalFullScreen" tabindex="-1" aria-labelledby="modalFullScreenLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFullScreenLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteMateri(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('materi.delete', ['id' => 'an']) }}".replace('an', id),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            window.location.reload();
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        }

        function readMateri(id) {
            $.ajax({
                url: "{{ route('materi.read', ['id' => 'an']) }}".replace('an', id),
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function openMateriModal(materiId) {
            $.ajax({
                url: "{{ route('materi.show', ['id' => 'an']) }}".replace('an', materiId),
                method: 'GET',
                success: function(response) {
                    var modalBody = $("#modalFullScreen .modal-body");
                    var modalTitle = $("#modalFullScreen .modal-title");
                    modalBody.html(response.data.content);
                    modalTitle.text(response.data.judul);
                    $('#modalFullScreen').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        const ctx1 = document.getElementById("chart-line").getContext("2d");
        const ctx2 = document.getElementById("chart-bar").getContext("2d");

        const gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, "rgba(33,82,255,0.1)");
        gradientStroke1.addColorStop(0.2, "rgba(33,82,255,0.0)");
        gradientStroke1.addColorStop(0, "rgba(33,82,255,0)"); //purple colors

        const chartLabels = @json($chartLabels); // Ubah objek PHP menjadi array JavaScript
        const chartData = @json($chartData); // Ubah objek PHP menjadi array JavaScript
        const chartDone = @json($chartDone); // Ubah objek PHP menjadi array JavaScript

        new Chart(ctx1, {
            type: "line",
            data: {
                labels: chartLabels,
                datasets: [{
                    label: "Tasks",
                    tension: 0.3,
                    pointRadius: 2,
                    pointBackgroundColor: "#2152ff",
                    borderColor: "#2152ff",
                    borderWidth: 2,
                    backgroundColor: gradientStroke1,
                    data: chartData,
                    maxBarThickness: 6,
                    fill: true,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            color: "#252f40",
                            padding: 10,
                        },
                    },
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: "#9ca2b7",
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: "#9ca2b7",
                        },
                    },
                },
            },
        });

        new Chart(ctx2, {
            type: "doughnut",
            data: {
                labels: ["Done", "In progress"],
                datasets: [{
                    label: "Projects",
                    weight: 9,
                    cutout: 50,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: ["#2152ff", "#a8b8d8"],
                    data: chartDone,
                    fill: false,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                },
            },
        });
    </script>
@endpush
