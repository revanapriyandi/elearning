@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Update Kelas') }}</h4>
            <p class="text-white opacity-8">{{ $kelas->nama_kelas }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" onclick="event.preventDefault();document.getElementById('updateForm').submit();"
                class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" id="btnSubmit">
                <span id="btnText">{{ __('Update Kelas') }}</span></button>
        </div>
    </div>
    <form class="multisteps-form__form mb-8" style="height: 408px;" action="{{ route('kelas.update', $kelas->id) }}"
        method="POST" enctype="multipart/form-data" id="updateForm">
        @csrf
        @method('PUT')
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Images</h5>
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $kelas->image_url }}"
                                    alt="{{ $kelas->nama_mapel }}">
                            </div>
                            <div class="col-12 mt-5">
                                <div class="d-flex">
                                    <input type="file"
                                        class="multisteps-form__input form-control  @error('images') is-invalid @enderror"
                                        id="images" name="images" placeholder="{{ __('Image (opsional)') }}">
                                    @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder mb-0">{{ __('Update Kelas') }}</h5>
                        <p class="mb-0 text-sm">{{ $kelas->nama_kelas }}</p>


                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Kode Kelas') }}</label>
                                <input class="multisteps-form__input form-control @error('kode_kelas') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Kode Kelas') }}" autofocus name="kode_kelas"
                                    value="{{ $kelas->kode_kelas }}">
                                @error('kode_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Nama Kelas') }}</label>
                                <input class="multisteps-form__input form-control @error('nama_kelas') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Nama Kelas') }}" autofocus name="nama_kelas"
                                    value="{{ $kelas->nama_kelas }}">
                                @error('nama_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                @php
                                    $mapel = App\Models\MataPelajaran::all();
                                    $kelasMapel = explode(',', $kelas->mapel);
                                @endphp
                                <label>{{ __('Mata Pelajaran') }}</label>
                                <select name="mapel[]" id="mapel"
                                    class="form-control form-control-lg select2 @error('mapel') is-invalid @enderror"
                                    required multiple>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            @if (in_array($item->id, $kelasMapel)) selected @endif>
                                            {{ $item->nama_mapel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                <label>{{ __('Kompetensi keahlian') }}</label>
                                <textarea name="kompetensi_keahlian" id="kompetensi_keahlian"
                                    class="multisteps-form__input form-control @error('kompetensi_keahlian') is-invalid @enderror" cols="10"
                                    rows="4" placeholder="{{ __('Kompetensi Keahlian (opsional)') }}">{{ $kelas->kompetensi_keahlian }}</textarea>
                                @error('kompetensi_keahlian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="{{ __('Submit') }}" onclick="submitForm(event)" id="btnSubmit">
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Loading...') }}
                                </span>
                                <span id="btnText">{{ __('Update Kelas') }}</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.select2').select2({
                        placeholder: 'Pilih Mata Pelajaran',
                        theme: 'bootstrap-5'
                    });
                });

                function submitForm(event) {
                    event.preventDefault();

                    var form = document.getElementById('updateForm');
                    var btnSubmit = document.getElementById('btnSubmit');
                    var btnText = document.getElementById('btnText');
                    var btnLoading = document.getElementById('btnLoading');

                    btnSubmit.disabled = true;
                    btnText.classList.add('d-none');
                    btnLoading.classList.remove('d-none');

                    form.submit();
                }
            </script>
        @endpush
    </form>
@endsection
