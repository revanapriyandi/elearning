@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ $data->name }}</h4>
            <p class="text-white opacity-8">{{ __('Rombongan Belajar') }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <button type="button" class="btn bg-gradient-primary  mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2"
                data-bs-toggle="modal" data-bs-target="#modalAddAnggota">
                <span id="btnText">{{ __('Tambah Anggota Rombel') }}</span></button>
            @include('Pages.Rombongan.modal')
        </div>
    </div>
    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Anggota Rombongan Belajar') }}
                </div>

                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="DataTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('No.') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Siswa') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Kelas') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Created At') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Updated At') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Aksi') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->siswa as $index => $item)
                                    <tr>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $item->user->image_url }}" class="avatar avatar-sm me-3"
                                                        alt="{{ $item->user->nama_lengkap }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><a
                                                            href="#">{{ $item->user->nama_lengkap }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-secondary mb-0 text-sm">{{ $item->kelas->nama_kelas }}
                                            </p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span
                                                    class="text-dark text-xs">{{ date('d-F-Y', strtotime($data->created_at)) }}</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-sm">
                                                {{ date('d-F-Y', strtotime($data->updated_at)) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group" aria-label="Aksi">
                                                <form action="{{ route('rombel.siswa.remove', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-secondary font-weight-bold text-xs"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                        <span class="badge badge-sm bg-gradient-danger">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <th colspan="4">Jumlah Siswa</th>
                                    <th colspan="2">
                                        {{ $data->siswa->count() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#DataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
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
@endsection
