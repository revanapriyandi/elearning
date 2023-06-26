@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Presensi </h6>
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
                                        {{ __('Siswa') }}</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder"
                                        colspan="4">{{ __('Kehadiran') }}</th>
                                    <th rowspan="2"
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Created At') }}</th>
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
                                @foreach ($data as $item)
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                        <td class="text-xs font-weight-bold mb-0"><a class="text-primary text-bold"
                                                href="{{ route('presensi.detail', $item->user->siswa->id) }}">{{ $item->user->nama_lengkap }}</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->presensi->where('status', 'hadir')->count() }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->presensi->where('status', 'sakit')->count() }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->presensi->where('status', 'izin')->count() }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->presensi->where('status', 'alpa')->count() }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ date('d F Y, H:i', strtotime($item->updated_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
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

                    },
                    {
                        extend: 'excelHtml5',

                    },
                    {
                        extend: 'csvHtml5',

                    },
                    {
                        extend: 'pdfHtml5',

                    },
                    {
                        extend: 'print',

                    }
                ],
                processing: true,
                responsive: true,
            });
        });
    </script>
@endpush
