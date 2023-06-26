@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Data Nilai Ujian <strong>{{ $data->user->nama_lengkap }}</strong> </h6>
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
                                        {{ __('Ujian') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Nilai') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Grades') }}</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs text-center font-weight-bolder">
                                        {{ __('Updated At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalNilai = 0;
                                @endphp
                                @foreach ($data->ujian as $item)
                                    @php
                                        $totalNilai += $item->nilai;
                                    @endphp
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->tugasQuiz->judul }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ $item->nilai }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            @if ($item->nilai >= 90)
                                                A
                                            @elseif($item->nilai >= 80)
                                                B
                                            @elseif($item->nilai >= 70)
                                                C
                                            @elseif($item->nilai >= 60)
                                                D
                                            @else
                                                E
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">
                                            {{ date('d F Y, H:i', strtotime($item->updated_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-xs font-weight-bold mb-0" colspan="3" style="text-align:right">
                                        Rata-rata:
                                        @if ($data->ujian->count() > 0)
                                            <span
                                                class="badge bg-gradient-primary">{{ $totalNilai / $data->ujian->count() }}</span>
                                        @else
                                            <span class="badge bg-gradient-primary">0</span>
                                        @endif
                                    </th>
                                    <th class="text-xs font-weight-bold mb-0" style="text-align:center" id="averageValue">
                                        Grades:
                                        @if ($data->ujian->count() > 0)
                                            @if ($totalNilai / $data->ujian->count() >= 90)
                                                <span class="badge bg-gradient-primary">A</span>
                                            @elseif($totalNilai / $data->ujian->count() >= 80)
                                                <span class="badge bg-gradient-info">B</span>
                                            @elseif($totalNilai / $data->ujian->count() >= 70)
                                                <span class="badge bg-gradient-success">C</span>
                                            @elseif($totalNilai / $data->ujian->count() >= 60)
                                                <span class="badge bg-gradient-secondary">D</span>
                                            @else
                                                <span class="badge bg-gradient-danger">E</span>
                                            @endif
                                        @else
                                            <span class="badge bg-gradient-danger">E</span>
                                        @endif
                                    </th>
                                    <th class="text-xs font-weight-bold mb-0" colspan="1"></th>
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
