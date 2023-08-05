@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Ujian Baru') }}</h4>
        </div>
    </div>
    <form action="{{ route('banksoal.store') }}" method="POST" id="form">
        @csrf

        <div class="row mt-4">

            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Informasi Ujian') }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>{{ __('Nama Ujian') }}</label>
                                <input class="form-control  @error('nama_ujian') is-invalid @enderror" type="text"
                                    value="{{ old('nama_ujian') }}" name="nama_ujian" autofocus
                                    placeholder="{{ __('Nama Ujian') }}">
                                @error('nama_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>{{ __('Jenis Ujian') }}</label>
                                <select name="jenis_ujian" id="jenis_ujian"
                                    class="form-control @error('jenis_ujian') is-invalid @enderror">

                                    @if (Str::contains(URL::previous(), 'ujian'))
                                        <option value="ujian" {{ old('jenis_ujian') == 'ujian' ? 'selected' : '' }}>
                                            {{ __('Ujian') }}</option>
                                    @else
                                        <option value="quiz" {{ old('jenis_ujian') == 'quiz' ? 'selected' : '' }}>
                                            {{ __('Quiz (Pilihan Ganda, True/False, Isian)') }}</option>
                                        <option value="tugas" {{ old('jenis_ujian') == 'tugas' ? 'selected' : '' }}>
                                            {{ __('Tugas (Upload File)') }}</option>
                                    @endif
                                </select>
                                @error('jenis_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mt-4">{{ __('Waktu Mulai Ujian') }}</label>
                                <input class="form-control @error('waktu_mulai') is-invalid @enderror" type="datetime-local"
                                    value="{{ old('waktu_mulai') }}" name="waktu_mulai">
                                @error('waktu_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="mt-4">{{ __('Waktu Berakhir Ujian') }}</label>
                                <input class="form-control @error('waktu_berakhir') is-invalid @enderror"
                                    type="datetime-local" value="{{ old('waktu_berakhir') }}" name="waktu_berakhir">
                                @error('waktu_berakhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label class="mt-4">{{ __('Penjelasan Ujian') }}</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Informasi Tambahan') }}</h5>
                        <div class="row">
                            <div class="col-12">
                                <label class="mt-4">{{ __('Kelas') }}</label>
                                <select name="kelas[]" class="form-control @error('kelas') is-invalid @enderror"
                                    multiple="multiple">
                                    <option value="all" {{ old('kelas') == '0' ? 'selected' : '' }}>
                                        {{ __('Semua Kelas') }}</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kelas') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="mt-4">{{ __('Mata Pelajaran') }}</label>
                                <select name="mapel" class="form-control @error('mapel') is-invalid @enderror">
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mapel') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_mapel }}</option>
                                    @endforeach
                                </select>
                                @error('mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mt-4">{{ __('Publish Ujian') }}</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input @error('is_aktif') is-invalid @enderror"
                                            name="is_aktif" type="checkbox" id="is_aktif"
                                            {{ old('is_aktif') ? 'checked' : '' }} required>
                                    </div>
                                    @error('is_aktif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="mt-4">{{ __('Terbitkan Nilai') }}</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input @error('is_terbitkan_nilai') is-invalid @enderror"
                                            name="is_terbitkan_nilai" type="checkbox" id="is_terbitkan_nilai"
                                            {{ old('is_terbitkan_nilai') ? 'checked' : '' }} required>
                                    </div>
                                    @error('is_terbitkan_nilai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-5">
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-sm mb-0 me-2" type="submit"
                                            title="{{ __('Submit') }}" onclick="submitForm(event)" id="btnSubmit">
                                            <span id="btnLoading" class="d-none">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                                {{ __('Loading...') }}
                                            </span>
                                            <span id="btnText">{{ __('Simpan') }}</span>
                                        </button>
                                        <button class="btn btn-outline-dark btn-sm mb-0" type="button"
                                            onclick="window.history.back()" name="button">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    @push('scripts')
        <script>
            function submitForm(event) {
                event.preventDefault();

                var form = document.getElementById('form');
                var btnSubmit = document.getElementById('btnSubmit');
                var btnText = document.getElementById('btnText');
                var btnLoading = document.getElementById('btnLoading');

                btnSubmit.disabled = true;
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');

                form.submit();
            }
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image code link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];

                        const reader = new FileReader();
                        reader.addEventListener('load', () => {
                            /*
                              Note: Now we need to register the blob in TinyMCEs image blob
                              registry. In the next release this part hopefully won't be
                              necessary, as we are looking to handle it internally.
                            */
                            const id = 'blobid' + (new Date()).getTime();
                            const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            /* call the callback and populate the Title field with the file name */
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        });
                        reader.readAsDataURL(file);
                    });

                    input.click();
                },
            });
        </script>
    @endpush
@endsection
