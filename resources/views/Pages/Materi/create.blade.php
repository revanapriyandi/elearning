@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-9 col-12 mx-auto">
                <div class="card card-body mt-4">
                    <h6 class="mb-0">{{ __('Tambah Materi') }}</h6>
                    <p class="text-sm mb-0">{{ __('Tambahkan materi baru di ') }} <strong>{{ $data->nama_mapel }}</strong>
                    </p>
                    <hr class="horizontal dark my-3">
                    <form action="{{ route('materi.store', $data->id) }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <label for="judul" class="form-label">{{ __('Judul') }}<small
                                class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" value="{{ old('judul') }}" placeholder="{{ __('Judul') }}" required
                            onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row mt-4">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        {{ __('Draft Materi') }}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{ __('Jika diaktifkan materi tidak akan ditampilkan di halaman siswa.') }}
                                    </p>
                                    <div class="form-check form-switch ms-1">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="checkbox" id="status" id="status" name="status" value="true">
                                        <label class="form-check-label" for="status"></label>
                                    </div>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label class="mt-4">{{ __('Content') }}</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="row mt-3">
                            <div class="col-12">
                                <label class="form-label">{{ __('Files') }}</label>
                                <div class="needsclick dropzone" id="document-dropzone"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-primary " type="submit" title="{{ __('Submit') }}"
                                onclick="submitForm(event)" id="btnSubmit">
                                <span id="btnLoadingSubmit" class="d-none m-0">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Menyimpan...') }}
                                </span>
                                <span id="btnText">{{ __('Simpan') }}</span>
                            </button>
                            <input type="hidden" name="lanjut" value="" id="lanjut">
                            <button class="btn btn-secondary ms-2" type="submit" title="{{ __('Submit dan Lanjut') }}"
                                onclick="submitForm(event, true)" id="btnSubmitLanjut">
                                <span id="btnLoadingSubmitLanjut" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Menyimpan...') }}
                                </span>
                                <span id="btnTextLanjut">{{ __('Submit dan Lanjut') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <script>
        function submitForm(event, lanjut = false) {
            event.preventDefault();

            var form = document.getElementById('form');
            var btnSubmit = document.getElementById('btnSubmit');
            var btnSubmitLanjut = document.getElementById('btnSubmitLanjut');
            var btnText = document.getElementById('btnText');
            var btnTextLanjut = document.getElementById('btnTextLanjut');
            var btnLoading = document.getElementById('btnLoadingSubmit');
            var btnLoadingLanjut = document.getElementById('btnLoadingSubmitLanjut');

            if (lanjut) {
                document.getElementById('lanjut').value = 1;
                btnSubmitLanjut.disabled = true;
                btnTextLanjut.classList.add('d-none');
                btnLoadingLanjut.classList.remove('d-none');
            } else {
                btnSubmit.disabled = true;
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
            }


            form.submit();
        }

        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: "{{ route('uploads') }}",
            maxFilesize: 35, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($project) && $project->document)
                    var files =
                        {!! json_encode($project->document) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }

        function focused(e) {
            e.parentElement.classList.add('focused');
        }

        function defocused(e) {
            e.parentElement.classList.remove('focused');
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
