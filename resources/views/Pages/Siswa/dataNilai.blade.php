@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Nilai Ujian </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="tableData">
                            <thead class="thead-light">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        #</th>
                                    <th class="text-uppercase text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Siswa') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Rata Rata Nilai') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Grades') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Updated At') }}</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                        <td class="text-xs font-weight-bold mb-0"><a class="text-primary text-bold"
                                                href="{{ route('siswa.detailNilai', $item->id) }}">{{ $item->user->nama_lengkap }}</a>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @php
                                                $totalNilai = 0;
                                                $count = $item->ujian->count();
                                            @endphp

                                            @if ($count > 0)
                                                @foreach ($item->ujian as $ujian)
                                                    @php
                                                        $totalNilai += $ujian->nilai;
                                                    @endphp
                                                @endforeach

                                                @php
                                                    $rataNilai = $totalNilai / $count;
                                                @endphp

                                                Rata-rata Nilai: {{ $rataNilai }}
                                            @else
                                                Data nilai tidak tersedia.
                                            @endif
                                        </td>

                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($count > 0)
                                                @if ($rataNilai >= 90)
                                                    A
                                                @elseif ($rataNilai >= 80)
                                                    B
                                                @elseif ($rataNilai >= 70)
                                                    C
                                                @elseif ($rataNilai >= 60)
                                                    D
                                                @else
                                                    E
                                                @endif
                                            @else
                                                Data nilai tidak tersedia.
                                            @endif
                                        </td>
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
