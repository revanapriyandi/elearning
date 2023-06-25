@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card blur shadow-blur max-height-vh-70">
                <div class="card-header shadow-lg">
                    <div class="row">
                        <div class="col-lg-10 col-8">
                            <div class="d-flex align-items-center">
                                <img alt="{{ $data->judul }}"
                                    src="https://www.shutterstock.com/image-photo/forum-chat-message-discuss-talk-260nw-289492913.jpg"
                                    class="avatar">
                                <div class="ms-3">
                                    <h6 class="mb-0 d-block">{{ $data->judul }}</h6>
                                    <span
                                        class="text-sm text-dark opacity-8">{{ date('d F Y', strtotime($data->updated_at)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-2 my-auto pe-0">
                            <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button"
                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Video call">
                                <i class="ni ni-camera-compact"></i>
                            </button>
                        </div>
                        <div class="col-lg-1 col-2 my-auto pe-0">
                            <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0 fullscreen-btn"
                                type="button" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Fullscreen">
                                <i class="fa fa-maximize"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="card-body overflow-auto overflow-x-hidden" id="commentContainer">
                    @push('scripts')
                        <script>
                            var commentContainer = document.getElementById('commentContainer');
                            commentContainer.scrollTop = commentContainer.scrollHeight;

                            var fullscreenBtn = document.querySelector('.fullscreen-btn');
                            fullscreenBtn.addEventListener('click', toggleFullscreen);

                            function toggleFullscreen() {
                                if (!document.fullscreenElement) {
                                    document.documentElement.requestFullscreen();
                                    fullscreenBtn.innerHTML = '<i class="fa fa-minimize"></i>';
                                } else {
                                    if (document.exitFullscreen) {
                                        document.exitFullscreen();
                                    }
                                    fullscreenBtn.innerHTML = '<i class="fa fa-maximize"></i>';
                                }
                            }
                        </script>
                    @endpush
                    @foreach ($data->comment as $item)
                        @if ($item->created_at->diffInMinutes() > 0)
                            <div class="row mt-4">
                                <div class="col-md-12 text-center">
                                    <span class="badge text-dark">{{ $item->created_at->format('D, g:i A') }}</span>
                                </div>
                            </div>
                        @endif
                        <div
                            class="row mb-4 @if ($item->user_id == auth()->user()->id) justify-content-end text-right @else justify-content-start @endif">
                            <div class="col-auto">
                                <div class="card bg-gray-200">
                                    <div class="card-body py-2 px-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xs">
                                                <img alt="{{ $item->user->nama_lengkap }}"
                                                    src="{{ $item->user->image_url }}"
                                                    class="avatar avatar-xs rounded-circle">
                                            </div>
                                            <div class="ms-2">
                                                <strong
                                                    class="text-xs text-dark opacity-7">{{ $item->user->nama_lengkap }}</strong>
                                                <h6 class="mb-0 text-sm">{{ $item->content }}</h6>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                            <i class="ni ni-check-bold text-sm me-1"></i>
                                            <small>{{ $item->created_at->format('H:m') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @push('scripts')
                    <script>
                        var commentContainer = document.getElementById('commentContainer');
                        commentContainer.scrollTop = commentContainer.scrollHeight;
                    </script>
                @endpush
                <div class="card-footer d-block">
                    <form class="align-items-center" action="{{ route('ruangdiskusi.comment', $data->id) }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control @error('message') is-invalid @enderror"
                                    name="message" placeholder="Type here" aria-label="Message input"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn bg-gradient-primary mb-0 ms-2" type="submit">
                                <i class="ni ni-send"></i>
                            </button>
                        </div>
                    </form>

                    @push('scripts')
                        <script>
                            function focused(e) {
                                e.parentElement.classList.add('focused');
                            }

                            function defocused(e) {
                                e.parentElement.classList.remove('focused');
                            }
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection
