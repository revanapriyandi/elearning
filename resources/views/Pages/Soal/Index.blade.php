@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Daftar Soal') }}</h4>
            <p class="text-white opacity-8">{{ $tugasQuiz->judul }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">{{ __('Data Soal') }}</h5>
                            <p class="text-sm mb-0">
                                {{ __('Kumpulan soal yang dapat digunakan untuk ujian atau tes berbasis komputer.') }}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript::" data-bs-toggle="modal" data-bs-target="#jenisSoal"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                    {{ __('New Soal') }}</a>
                                @include('Pages.Soal.modal', ['data' => $tugasQuiz->id])
                                <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal"
                                    data-bs-target="#import">
                                    Import
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableSoal">
                            <thead class="thead-light">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">#</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        Aksi</th>
                                    <th rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                        {{ __('Pertanyaan') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        {{ __('Jenis') }}</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder"
                                        colspan="5">{{ __('Jawaban') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        {{ __('Jawaban Benar') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        {{ __('Created At') }}</th>
                                </tr>
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th class="text-center">A</th>
                                    <th class="text-center">B</th>
                                    <th class="text-center">C</th>
                                    <th class="text-center">D</th>
                                    <th class="text-center">E</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-weight-normal" style="text-align: center; vertical-align: middle;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableSoal').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            },
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            }
                        }
                    ],
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('banksoal.soal', $tugasQuiz->id) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }, {
                            data: 'pertanyaan',
                            name: 'pertanyaan'
                        },
                        {
                            data: 'jenis',
                            name: 'jenis'
                        },
                        {
                            data: 'jawaban_A',
                            name: 'jawaban_A',
                        },
                        {
                            data: 'jawaban_B',
                            name: 'jawaban_B',
                        },
                        {
                            data: 'jawaban_C',
                            name: 'jawaban_C',
                        },
                        {
                            data: 'jawaban_D',
                            name: 'jawaban_D',
                        },
                        {
                            data: 'jawaban_E',
                            name: 'jawaban_E',
                        },
                        {
                            data: 'jawaban_benar',
                            name: 'jawaban_benar'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ],
                });
                table.on('draw', function() {
                    table.buttons().container().appendTo('#tableSoal_wrapper .col-md-6:eq(0)');
                });
            });
        </script>
    @endpush
@endsection
