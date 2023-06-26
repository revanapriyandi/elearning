@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Semester') }}</h4>
            <p class="text-white opacity-8">{{ __('Semester Management') }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Semester</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableSemester">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester
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
                                            <a href="{{ route('semester.edit', $item->id) }}" class="nav-link ">
                                                <i class="fa fa-edit text-warning text-sm opacity-10"></i>
                                            </a>
                                            <form action="{{ route('semester.destroy', $item->id) }}" method="POST"
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
                    var table = $('#tableSemester').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1]
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
                    <h6 class="mb-0">Tambah Data Semester</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('semester.store') }}" method="POST" enctype="multipart/form-data"
                        id="semesterForm">
                        @csrf
                        <div class="mb-3">
                            <input type="text"
                                class="form-control form-control-lg @error('semester') is-invalid @enderror" id="semester"
                                name="semester" placeholder="{{ __('Semester') }}" required autofocus autocomplete="false"
                                value="{{ old('semester') }}">
                            @error('semester')
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

                                    var form = document.getElementById('semesterForm');
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