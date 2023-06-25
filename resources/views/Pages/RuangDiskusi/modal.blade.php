<div class="modal fade @if ($errors->any()) show @endif" id="createDiskusi" tabindex="-1" role="dialog"
    aria-labelledby="createDiskusiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDiskusiLabel">Diskusi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ruangdiskusi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Judul</label>
                    <div class="input-group mb-3">
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Judul" aria-label="Judul" required aria-describedby="judul-addon">
                        @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label>Mata Pelajaran</label>
                    <div class="input-group mb-3">
                        <select name="mapel" id="mapel" class="form-control @error('mapel') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapel as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                        @error('mapel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label>Content</label>
                    <div class="input-group mb-3">
                        <textarea name="content" id="content" cols="15" rows="5"
                            class="form-control @error('content') is-invalid @enderror" placeholder="Content" required></textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
