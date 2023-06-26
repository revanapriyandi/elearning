@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Presensi <strong>{{ $data->user->nama_lengkap }}</strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableData">
                            <thead class="thead-light">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        #</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Tanggal') }}</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder"
                                        colspan="4">{{ __('Kehadiran') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Keterangan') }}</th>
                                </tr>
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">Hadir
                                    </th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">Sakit
                                    </th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">Izin
                                    </th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">Alpa
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->presensi as $item)
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->created_at->format('d F Y, H:i') }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($item->status == 'hadir')
                                                <i class="fa-solid fa-circle-check text-primary" title="✔️"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark text-danger" title="x"></i>
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($item->status == 'sakit')
                                                <i class="fa-solid fa-circle-check text-primary" title="✔️"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark text-danger" title="x"></i>
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($item->status == 'izin')
                                                <i class="fa-solid fa-circle-check text-primary" title="✔️"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark text-danger" title="x"></i>
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($item->status == 'alpa')
                                                <i class="fa-solid fa-circle-check text-primary" title="✔️"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark text-danger" title="x"></i>
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {!! $item->keterangan !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="thead-light">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        #</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Tanggal') }}</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder"
                                        colspan="4">{{ __('Kehadiran') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Keterangan') }}</th>
                                </tr>
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        Total Hadir: {{ $data->presensi->where('status', 'hadir')->count() }}</td>
                                    <td class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        Total Sakit: {{ $data->presensi->where('status', 'sakit')->count() }}</td>
                                    <td class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        Total Izin: {{ $data->presensi->where('status', 'izin')->count() }}</td>
                                    <td class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">
                                        Total Alpa: {{ $data->presensi->where('status', 'alpa')->count() }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var icon = $(node).find('i').clone().addClass('fa-lg');
                                    return (icon.length ? icon.prop('outerHTML') : '') + data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var icon = $(node).find('i').clone().addClass('fa-lg');
                                    return (icon.length ? icon.prop('outerHTML') : '') + data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var icon = $(node).find('i').clone().addClass('fa-lg');
                                    return (icon.length ? icon.prop('outerHTML') : '') + data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var icon = $(node).find('i').clone().addClass('fa-lg');
                                    return (icon.length ? icon.prop('outerHTML') : '') + data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var icon = $(node).find('i').clone().addClass('fa-lg');
                                    return (icon.length ? icon.prop('outerHTML') : '') + data;
                                }
                            }
                        }
                    }
                ],
                processing: true,
                responsive: true,
            });
        });
    </script>
@endpush
