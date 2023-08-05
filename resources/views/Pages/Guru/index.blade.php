@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Data Guru') }}</h4>
            <p class="text-white opacity-8">{{ __('Data Guru') }}</p>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <a href="{{ route('guru.create') }}" class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2"
                id="btnSubmit">
                <span id="btnText">{{ __('Tambah Data guru') }}</span></a>
        </div>
    </div>
    @include('Pages.Guru.widget', ['guru' => $guru])

    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Daftar Guru') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="DataTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('#') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Nama Lengkap') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Nip') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Mata Pelajaran yang diajar') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Kelas') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Created At') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $index => $item)
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
                                                            href="{{ route('guru.show', $item->id) }}">{{ $item->user->nama_lengkap }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $item->nip }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-secondary mb-0 text-sm">{{ $item->mapel->nama_mapel }}
                                            </p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">{{ $item->kelas->nama_kelas }}</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-sm">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">

                                            <a href="{{ route('guru.show', $item->id) }}"
                                                class="text-secondary font-weight-bold text-xs">
                                                <span class="badge badge-sm bg-gradient-primary">{{ __('Show') }}</span>
                                            </a>
                                            <a href="{{ route('guru.edit', $item->id) }}"
                                                class="text-secondary font-weight-bold text-xs">
                                                <span class="badge badge-sm bg-gradient-warning">{{ __('Edit') }}</span>
                                            </a>
                                            <form action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link font-weight-bold text-xs mb-0"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <span
                                                        class="badge badge-sm bg-gradient-danger mb-0">{{ __('Hapus') }}</span>
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
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#DataTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
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
