<div class="card mt-3" id="basic-info">
    <div class="card-body pt-0">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-7 mx-auto text-center">
                <h4 class="text-bolder fadeIn1 fadeInBottom mt-5 ">{{ $data->mapel->nama_mapel }}
                </h4>
                <h2 class="fadeIn3 fadeInBottom mt-3">{{ $data->judul }}</h2>
                <p class="lead fadeIn2 fadeInBottom">{!! $data->deskripsi !!}</p>
                <button type="button" class="btn bg-gradient-primary mt-4 fadeIn2 fadeInBottom">
                    <a href="{{ route('mod.update', ['id' => $data->id, 'status' => 'dikerjakan']) }}"
                        class="text-white">{{ __('Mulai Ujian') }}</a>
                </button>
            </div>
        </div>
    </div>
</div>
