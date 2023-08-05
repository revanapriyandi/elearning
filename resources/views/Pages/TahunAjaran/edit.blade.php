@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Update Data Tahun Ajaran') }}</h4>
            <p class="text-white opacity-8">{{ $data->name }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" onclick="event.preventDefault();document.getElementById('updateForm').submit();"
                class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" id="btnSubmit">
                <span id="btnText">{{ __('Update Tahun Ajaran') }}</span></button>
        </div>
    </div>
    <form class="multisteps-form__form mb-8" style="height: 408px;" action="{{ route('tahun-ajaran.update', $data->id) }}"
        method="POST" id="updateForm">
        @csrf
        @method('PUT')
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3"
                                    src="https://asy-syukriyyah.ac.id/wp-content/uploads/2019/07/Logo-Akademik-868x675.jpg"
                                    alt="{{ $data->name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder mb-0">{{ __('Update') }}</h5>
                        <p class="mb-0 text-sm">{{ $data->name }}</p>


                        <div class="row mt-3">
                            <label>{{ __('Tahun Ajaran') }}</label>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <input type="text"
                                        class="date-own form-control @error('tahun1') is-invalid @enderror"
                                        placeholder="Tahun Ajaran" name="tahun1" id="tahun1"
                                        value="{{ explode('/', $data->name)[0] }}" pattern="[0-9]{4}" maxlength="4"
                                        minlength="4" title="Masukkan tahun dengan format empat digit (misalnya: 2022)">
                                    @error('tahun1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center">/</p>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <input type="text"
                                        class="date-own form-control @error('tahun2') is-invalid @enderror"
                                        placeholder="Tahun Ajaran" name="tahun2" id="tahun2"
                                        value="{{ explode('/', $data->name)[1] }}" pattern="[0-9]{4}" maxlength="4"
                                        minlength="4" title="Masukkan tahun dengan format empat digit (misalnya: 2022)">
                                    @error('tahun2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('Semester') }}</label>
                                <div class="mb-3 ">
                                    <select class="form-control @error('semester') is-invalid @enderror" name="semester"
                                        id="semester">
                                        <option value="genap" {{ $data->semester == 'genap' ? 'selected' : '' }}>Genap
                                        </option>
                                        <option value="ganjil" {{ $data->semester == 'ganjil' ? 'selected' : '' }}>Ganjil
                                        </option>
                                    </select>
                                    @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('Status') }}</label>
                                <div class="mb-3">
                                    <select class="form-control @error('status') is-invalid @enderror" name="status"
                                        id="status">
                                        <option value="" selected disabled>-- Pilih Status --</option>
                                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $data->status == '2' ? 'selected' : '' }}>Tidak Aktif
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="{{ __('Submit') }}" onclick="submitForm(event)" id="btnSubmit">
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Loading...') }}
                                </span>
                                <span id="btnText">{{ __('Update') }}</span>
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
@push('scripts')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true
        });

        $(document).ready(function() {
            $('select').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
