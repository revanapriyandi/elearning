@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Data Pengguna') }}</h4>
            <p class="text-white opacity-8">{{ __('Daftar Pengguna ') }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Pengguna</h6>
                </div>
                <div class="card-body">
                    @if ($users->isEmpty())
                        <p>Tidak ada data pengguna yang tersedia.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-flush" id="DataTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('#') }}
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('Nama Lengkap') }}
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('Email') }}
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
                                    @foreach ($users as $item)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $item->image_url }}" class="avatar avatar-sm me-3"
                                                            alt="{{ $item->nama_lengkap }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            <a
                                                                href="{{ route('user.edit', $item->id) }}">{{ $item->nama_lengkap }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary mb-0 text-sm"><a href="#"
                                                        class="__cf_email__" #>[{{ $item->email }}]</a>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm">
                                                    {{ $item->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('user.edit', $item->id) }}"
                                                    class="text-secondary font-weight-bold text-xs">
                                                    <span
                                                        class="badge badge-sm bg-gradient-warning">{{ __('Edit') }}</span>
                                                </a>
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link font-weight-bold text-xs mb-0"
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                @if (!$users->isEmpty())
                    var table = $('#DataTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            }
                        ],
                        processing: true,
                        responsive: true,
                    });
                    table.on('draw', function() {
                        table.buttons().container().appendTo('#tableSoal_wrapper .col-md-6:eq(0)');
                    });
                @endif
            });
        </script>
    @endpush

@endsection
