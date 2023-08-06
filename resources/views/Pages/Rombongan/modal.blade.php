@push('modal')
    <div class="modal fade" id="modalAddAnggota" tabindex="-1" role="dialog" aria-labelledby="modalAddAnggotaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('rombel.siswa', $data->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftar Siswa</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="toggleSelectAll()" data-select-all>Pilih
                            Semua</button>
                    </div>
                    <div class="modal-body text-secondary text-sm">
                        <table class="table align-items-center mb-0 datatable text-center">
                            <thead>
                                <tr
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $i => $item)
                                    <tr class="align-middle text-center" onclick="toggleCheckbox({{ $i }})">
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check my-auto">
                                                    <input class="form-check-input" type="checkbox" name="siswa[]"
                                                        value="{{ $item->id }}" id="check_{{ $i }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->user->nama_lengkap }}</td>
                                        <td>{{ $item->tahunAjaran->semester }}</td>
                                        <td>{{ $item->tahunAjaran->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        function toggleCheckbox(index) {
            const checkbox = document.getElementById(`check_${index}`);
            checkbox.checked = !checkbox.checked;
        }

        function toggleSelectAll() {
            const checkboxes = document.querySelectorAll('input[name="siswa[]"]');
            const selectAllButton = document.querySelector('button[data-select-all]');

            let allChecked = true;
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allChecked = false;
                    checkbox.checked = true;
                }
            });

            if (allChecked) {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }

            selectAllButton.innerText = allChecked ? 'Pilih Semua' : 'Hapus Semua';
        }

        $(document).ready(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverside: true,
            });
            table.on('draw', function() {
                table.buttons().container().appendTo('#tableSoal_wrapper .col-md-6:eq(0)');
            });
        });
    </script>
@endpush
