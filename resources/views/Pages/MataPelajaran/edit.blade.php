@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Update Mata Pelajaran') }}</h4>
            <p class="text-white opacity-8">{{ $data->nama_mapel }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" onclick="event.preventDefault();document.getElementById('updateForm').submit();"
                class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">
                <span>{{ __('Update Mapel') }}</span></button>
        </div>
    </div>
    <form class="multisteps-form__form mb-8" style="height: 408px;" action="{{ route('mapel.update', $data->id) }}"
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
                                <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{ $data->image_url }}"
                                    alt="{{ $data->nama_mapel }}">
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
                        <h5 class="font-weight-bolder mb-0">{{ __('Update Mapel') }}</h5>
                        <p class="mb-0 text-sm">{{ $data->nama_mapel }}</p>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Kode Mapel') }}</label>
                                <input class="multisteps-form__input form-control @error('kode_mapel') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Kode Mapel') }}" autofocus name="kode_mapel"
                                    value="{{ $data->kode_mapel }}">
                                @error('kode_mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Mata Pelajaran') }}</label>
                                <input class="multisteps-form__input form-control @error('nama_mapel') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Nama Kelas') }}" autofocus name="nama_mapel"
                                    value="{{ $data->nama_mapel }}">
                                @error('nama_mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                <label>{{ __('Deskripsi') }}</label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="multisteps-form__input form-control @error('deskripsi') is-invalid @enderror" cols="10" rows="4"
                                    placeholder="{{ __('Kompetensi Keahlian (opsional)') }}">{{ $data->deskripsi }}</textarea>
                                @error('deskripsi')
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
                                <span id="btnText">{{ __('Update Mapel') }}</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
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
