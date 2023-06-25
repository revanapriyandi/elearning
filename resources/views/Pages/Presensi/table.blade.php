<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="table-presensi">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensi as $item)
                        @php
                            $statusColor = '';
                            $textColor = '';

                            if ($item->status == 'hadir') {
                                $statusColor = 'green';
                                $textColor = 'white';
                            } elseif ($item->status == 'izin') {
                                $statusColor = 'yellow';
                                $textColor = 'black';
                            } elseif ($item->status == 'sakit') {
                                $statusColor = 'red';
                                $textColor = 'white';
                            }
                        @endphp

                        <tr class="text-center" style="background-color: {{ $statusColor }};">
                            <td style="color: {{ $textColor }};">{{ $loop->iteration }}</td>
                            <td style="color: {{ $textColor }};">{{ date('d F Y H:m', strtotime($item->created_at)) }}
                            </td>
                            <td style="color: {{ $textColor }};">{{ $item->latitude }},{{ $item->longitude }}</td>
                            <td style="color: {{ $textColor }};">{{ ucfirst($item->status) }}</td>
                            <td style="color: {{ $textColor }};">{!! $item->keterangan !!}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

            {{ $presensi->links() }}
        </div>
    </div>
</div>
