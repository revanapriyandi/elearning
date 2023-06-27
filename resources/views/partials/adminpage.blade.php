@include('partials.widgetAdmin')
<div class="row mt-4">
    <div class="col-12 col-md-8 mb-4 mb-md-0">
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Ujian
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data = \App\Models\TugasQuiz::with(['kelasTugasQuiz', 'mapel'])
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp
                        @foreach ($data as $index => $item)
                            <td>
                                {{ $index + 1 }}</td>
                            <td>
                                {{ $item->judul }}</td>
                            <td>
                                {{ date('d F Y, H:m', strtotime($item->waktu_mulai)) }} -
                                {{ date('d F Y, H:m', strtotime($item->waktu_berakhir)) }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $item->mapel->nama_mapel }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card widget-calendar mt-3">
            <div class="card-body p-3">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Mata Pelajaran</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    @php
                        $datamapel = \App\Models\MataPelajaran::orderBy('created_at', 'desc')->get();
                    @endphp
                    @foreach ($datamapel as $mapel)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{ $mapel->nama_mapel }}</h6>
                                    <span class="text-xs">{{ $mapel->kode_mapel }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                    <i class="ni ni-bold-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <script>
        fetch("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json")
            .then(response => response.json())
            .then(data => {
                var events = [];
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        events.push({
                            title: data[key].description,
                            start: key,
                            color: '#c40026',
                        });
                    }
                }

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    contentHeight: 'auto',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        start: 'title',
                        center: '',
                        end: 'today prev,next'
                    },
                    selectable: true,
                    editable: true,
                    events: events,

                    eventClick: function(info) {
                        window.location.href = info.event.url;
                    }
                });

                calendar.render();
            });
    </script>
@endpush
