@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Mata Pelajaran') }}</h4>
            <p class="text-white opacity-8">{{ __('Mata Pelajaran Management') }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-12 p-2">
            <div class="card text-left">
                <div class="card-header pb-0 text-start">
                    <h6 class="mb-0">Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Mata Pelajaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Pengajar</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $index => $item)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{ $index + 1 }}</td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $item->kode_mapel }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <div class="d-flex text-sm">
                                                <img class="w-10 ms-3 bg-primary" src="{{ $item->image_url }}"
                                                    alt="{{ $item->nama_mapel }}">
                                                <h6 class="ms-3 my-auto text-sm">{{ $item->nama_mapel }}</h6>
                                            </div>
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            @php
                                                $pengajar = \App\Models\Pengajar::where('mata_pelajaran_id', $item->id)->first();
                                            @endphp
                                            @if ($pengajar)
                                                <a
                                                    href="{{ route('pengajar.show', $pengajar->id) }}">{{ $pengajar->user->nama_lengkap }}</a>
                                            @else
                                                <span class="badge bg-gradient-warning">Belum Ada Pengajar</span>
                                            @endif
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <a href="{{ route('mapel.edit', $item->id) }}" class="nav-link ">
                                                <i class="fa fa-edit text-warning text-sm opacity-10"></i>
                                            </a>
                                            <form action="{{ route('mapel.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link"
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
                    var table = $('#dataTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2]
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
                    <h6 class="mb-0">Tambah Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data" id="FormData">
                        @csrf
                        <div class="mb-3">
                            <input type="text"
                                class="form-control form-control-lg @error('kode_mapel') is-invalid @enderror"
                                id="kode_mapel" name="kode_mapel" placeholder="{{ __('Kode Mapel') }}" required autofocus
                                autocomplete="false" value="{{ old('kode_mapel') }}">
                            @error('kode_mapel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text"
                                class="form-control form-control-lg @error('nama_mapel') is-invalid @enderror"
                                id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel') }}"
                                placeholder="{{ __('Nama Mapel') }}" required>
                            @error('nama_mapel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control form-control-lg @error('images') is-invalid @enderror"
                                id="images" name="images" placeholder="{{ __('Image (opsional)') }}">
                            <small class="text-xs">{{ __('Image cover (opsional)') }}</small>
                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="deskripsi" id="deskripsi" class="form-control form-control-lg @error('deskripsi') is-invalid @enderror"
                                cols="10" rows="4" placeholder="{{ __('Deskripsi') }}">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
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

                                    var form = document.getElementById('FormData');
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
