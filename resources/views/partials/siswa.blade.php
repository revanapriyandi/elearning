<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card widget-calendar">
            <div class="card-body p-3">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Tugas Saya</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    @foreach ($ujian as $item)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>spaceship</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(4.000000, 301.000000)">
                                                        <path
                                                            d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                        </path>
                                                        <path
                                                            d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                        </path>
                                                        <path
                                                            d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                                                            opacity="0.598539807"></path>
                                                        <path
                                                            d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                                                            opacity="0.598539807"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{ $item->tugasQuiz->judul }}</h6>
                                    <span
                                        class="text-xs">{{ date('d F Y, H:i', strtotime($item->tugasQuiz->created_at)) }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('mod') }}"
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></a>
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
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next'
            },
            selectable: true,
            editable: true,
            events: [
                @foreach ($ujian as $item)
                    {
                        title: "{{ $item->tugasQuiz->judul }}",
                        start: "{{ $item->tugasQuiz->waktu_mulai }}",
                        end: "{{ $item->tugasQuiz->waktu_berakhir }}",
                        color: "#{{ substr(md5($item->tugasQuiz->id), 0, 6) }}",
                        url: "{{ route('mod.update', ['id' => ':id', 'status' => 'belum']) }}".replace(':id',
                            "{{ $item->tugasQuiz->id }}")
                    },
                @endforeach
            ],
            eventClick: function(info) {
                // Tindakan yang dilakukan saat event di-klik
                // Contoh: Redirect ke halaman detail tugas quiz
                window.location.href = info.event.url;
            }
        });


        calendar.render();
    </script>
@endpush