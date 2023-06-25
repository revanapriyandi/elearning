@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (!$isWeekend)
                <div class="card card-background card-background-mask-dark align-items-start mt-4">
                    <div class="full-background cursor-pointer"
                        style="background-image: url('https://cdn.pixabay.com/photo/2022/03/02/09/17/wallpaper-7042708_960_720.jpg')">
                    </div>
                    @if ($presensiHariIni)
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="text-white mb-0 text-center">{{ __('Absensi anda telah dicatat untuk hari ini, ') }}
                                {{ date('d F Y') }}</h5>
                        </div>
                    @else
                        <form action="{{ route('presensi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <h5 class="text-white mb-0">Absensi</h5>
                                <p class="text-white text-sm">Absensi adalah kehadiran siswa dalam kegiatan belajar
                                    mengajar.
                                </p>
                                <div class="d-flex mt-4 pt-2">
                                    <button type="submit" id="hadir" onclick="showForm('Hadir')"
                                        class="btn btn-outline-white btn-sm mx-auto mb-0">
                                        Hadir
                                    </button>
                                    <button class="btn btn-outline-white btn-sm mx-auto mx-2 mb-0" id="izin"
                                        onclick="showForm('Izin')">
                                        Izin
                                    </button>
                                    <button class="btn btn-outline-white btn-sm mx-auto mb-0" id="sakit"
                                        onclick="showForm('Sakit')">
                                        Sakit
                                    </button>
                                </div>
                                <div class="mt-4" id="keterangan-form" style="display: none;">
                                    <input type="hidden" name="status" value="" id="status">
                                    <input type="hidden" name="latitude" value="" id="latitude">
                                    <input type="hidden" name="longitude" value="" id="longitude">
                                    <input type="hidden" name="location" value="" id="location">
                                    <textarea name="keterangan" id="keterangan" cols="15" rows="4" class="form-control"></textarea>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button class="btn btn-primary btn-sm mx-auto mb-0" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            @else
                <div class="card card-background card-background-mask-dark align-items-start mt-4 " style="height: 300px;">
                    <div class="full-background cursor-pointer"
                        style="background-image: url('https://img.freepik.com/free-vector/happy-weekend-lettering-with-photography-background_23-2147972571.jpg')">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="text-white mb-0">{{ __('Tidak perlu absen hari ini!') }}</h5>
                        <p class="text-white text-sm">
                            {{ __('Hari ini adalah hari libur! Selamat menikmati liburan akhir pekan Anda!') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        @include('Pages.Presensi.table')
    </div>

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }

        function showForm(jenis) {
            var keteranganForm = document.getElementById('keterangan-form');
            var keteranganTextarea = document.getElementById('keterangan');
            var izinButton = document.getElementById('izin');
            var sakitButton = document.getElementById('sakit');
            var status = document.getElementById('status');

            if (jenis === 'Izin' || jenis === 'Sakit') {
                keteranganForm.style.display = 'block';
                keteranganTextarea.required = true;

                if (jenis === 'Izin') {
                    status.value = 'izin';
                    izinButton.classList.add('active');
                    sakitButton.classList.remove('active');
                } else if (jenis === 'Sakit') {
                    status.value = 'sakit';
                    sakitButton.classList.add('active');
                    izinButton.classList.remove('active');
                }
            } else {
                status.value = 'hadir';
                keteranganForm.style.display = 'none';
                keteranganTextarea.required = false;
            }
        }
    </script>
@endsection
