@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Ujian Baru') }}</h4>
        </div>
    </div>
    <form action="{{ route('banksoal.soal.store', $tugasquiz->id) }}" method="POST" id="form">
        @csrf

        <div class="row mt-4">
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Soal Ujian') }}</h5>
                        <input type="hidden" value="{{ request()->get('jenis') }}" name="jenis">
                        <div class="row ">
                            <div class="col-12 ">
                                <label class="mt-4">{{ __('Pertanyaan') }}</label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" rows="3">{{ old('pertanyaan') }}</textarea>
                                @error('pertanyaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>

                        <div>
                            @php
                                $jenis = request()->get('jenis');
                                if ($jenis == 'pilihan_ganda') {
                                    $options = ['A', 'B', 'C', 'D', 'E'];
                                } elseif ($jenis == 'benar_salah') {
                                    $options = ['Benar', 'Salah'];
                                }
                            @endphp

                            @if ($jenis == 'pilihan_ganda')
                                @foreach ($options as $index => $option)
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12">
                                            <label>{{ __('Pilihan') }} {{ $option }}</label>
                                            <input type="hidden" name="pilihan[]" value="{{ $option }}">
                                            <textarea class="form-control @error('text_jawaban.' . $index) is-invalid @enderror" name="text_jawaban[]" required
                                                rows="3">{{ old('text_jawaban.' . $index) }}</textarea>
                                            @error('text_jawaban.' . $index)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                        @endif

                        @if ($jenis == 'pilihan_ganda' || $jenis == 'benar_salah')
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <label>{{ __('Jawaban Benar') }}</label>
                                    <select name="jawaban_benar" id="jawaban_benar"
                                        class="form-control @error('jawaban_benar') is-invalid @enderror">
                                        @foreach ($options as $item)
                                            <option value="{{ $item }}"
                                                {{ old('jawaban_benar') == $item ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jawaban_benar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-12">
                            <button class="btn btn-primary " type="submit" title="{{ __('Submit') }}"
                                onclick="submitForm(event)" id="btnSubmit">
                                <span id="btnLoadingSubmit" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Menyimpan...') }}
                                </span>
                                <span id="btnText">{{ __('Simpan') }}</span>
                            </button>
                            <input type="hidden" name="lanjut" value="" id="lanjut">
                            <button class="btn btn-secondary " type="submit" title="{{ __('Submit dan Lanjut') }}"
                                onclick="submitForm(event, true)" id="btnSubmitLanjut">
                                <span id="btnLoadingSubmitLanjut" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ __('Menyimpan...') }}
                                </span>
                                <span id="btnTextLanjut">{{ __('Submit dan Lanjut') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    @push('scripts')
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

            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image code link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                height: 300,
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
