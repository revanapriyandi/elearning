@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-white">{{ __('Edit Ujian') }}</h4>
        </div>
    </div>
    <form action="{{ route('banksoal.soal.update', $soal->id) }}" method="POST" id="form">
        @csrf
        @method('PUT')
        <div class="row mt-4">
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">{{ __('Soal Ujian') }}</h5>
                        <input type="hidden" value="{{ $soal->jenis }}" name="jenis">
                        <div class="row ">
                            <div class="col-12 ">
                                <label class="mt-4">{{ __('Pertanyaan') }}</label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" rows="3">{{ $soal->pertanyaan }}</textarea>
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
                                $jenis = $soal->jenis;
                                if ($jenis == 'pilihan_ganda') {
                                    $options = ['A', 'B', 'C', 'D', 'E'];
                                } elseif ($jenis == 'benar_salah') {
                                    $options = ['Benar', 'Salah'];
                                }
                            @endphp

                            @if ($jenis == 'pilihan_ganda')
                                @foreach ($soal->jawaban as $jwb)
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12">
                                            <label>{{ __('Pilihan') }} {{ $jwb->pilihan }}</label>
                                            <input type="hidden" name="pilihan[]" value="{{ $jwb->pilihan }}">
                                            <textarea class="form-control @error('text_jawaban.' . $loop->index) is-invalid @enderror" name="text_jawaban[]"
                                                rows="3">{{ $jwb->text_jawaban }}</textarea>
                                            @error('text_jawaban.' . $loop->index)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if ($jenis == 'pilihan_ganda' || $jenis == 'benar_salah')
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <label>{{ __('Jawaban Benar') }}</label>
                                    <select name="jawaban_benar" id="jawaban_benar"
                                        class="form-control @error('jawaban_benar') is-invalid @enderror">
                                        @foreach ($options as $item)
                                            @php
                                                $selected = '';
                                                foreach ($soal->jawaban as $jwb) {
                                                    if ($jwb->pilihan == $item) {
                                                        if ($jenis == 'pilihan_ganda' && $jwb->is_benar == 1) {
                                                            $selected = 'selected';
                                                            break;
                                                        }
                                                        $selected = 'selected';
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <option value="{{ $item }}" {{ $selected }}>
                                                {{ $item }}
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
                    <button class="btn btn-primary btn-lg w-100" type="submit" title="{{ __('Submit') }}"
                        onclick="submitForm(event)" id="btnSubmit">
                        <span id="btnLoading" class="d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ __('Loading...') }}
                        </span>
                        <span id="btnText">{{ __('Simpan') }}</span>
                    </button>
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
