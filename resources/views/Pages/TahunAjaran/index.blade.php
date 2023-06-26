@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Tahun Ajaran') }}</h4>
            <p class="text-white opacity-8">{{ __('Management Tahun Ajaran') }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Tahun Ajaran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableTahunAjaran">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun
                                        Ajaran
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{ $index + 1 }}</td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $item->name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <span
                                                class="badge {{ $item->status == 1 ? 'bg-gradient-primary' : 'bg-gradient-danger' }}">
                                                {{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>

                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <a href="{{ route('tahun-ajaran.edit', $item->id) }}" class="nav-link ">
                                                <i class="fa fa-edit text-warning text-sm opacity-10"></i>
                                            </a>
                                            <form action="{{ route('tahun-ajaran.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link "
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash text-danger text-sm opacity-10"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var table = $('#tableTahunAjaran').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            }
                        ],
                        processing: true,
                        responsive: true,
                    });
                    table.on('draw', function() {
                        table.buttons().container().appendTo('#tableSoal_wrapper .col-md-6:eq(0)');
                    });
                });
            </script>
        @endpush
        <div class="col-md-5 col-12 p-2">
            <div class="card">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Tambah Data Tahun Ajaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('tahun-ajaran.store') }}" method="POST"" id="tahunAjaranForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <input type="text"
                                        class="date-own form-control @error('tahun1') is-invalid @enderror"
                                        placeholder="Tahun Ajaran" name="tahun1" id="tahun1" value="{{ old('tahun1') }}"
                                        pattern="[0-9]{4}" maxlength="4" minlength="4"
                                        title="Masukkan tahun dengan format empat digit (misalnya: 2022)">
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
                                        value="{{ old('tahun2') }}" pattern="[0-9]{4}" maxlength="4" minlength="4"
                                        title="Masukkan tahun dengan format empat digit (misalnya: 2022)">

                                    @error('tahun2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option value="" selected disabled>-- Pilih Status --</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == '2' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" type="submit" id="btnSubmit"
                                onclick="submitForm(event)">
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Loading...') }}
                                </span>
                                <span id="btnText">{{ __('Simpan') }}</span>
                            </button>
                        </div>
                        @push('scripts')
                            <script>
                                function submitForm(event) {
                                    event.preventDefault();

                                    var form = document.getElementById('tahunAjaranForm');
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
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    <script>
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true
        });
    </script>
@endpush
