 <div class="row mt-4">
     <div class="col-lg-12 col-12">
         <div class="card">
             <div class="card-header p-3">
                 <div class="row">
                     <div class="col-md-6">
                         <h6 class="mb-0">Ruang Diskusi Mata Pelajaran</h6>
                     </div>
                     <div class="col-md-6 d-flex justify-content-end align-items-center">
                         <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                             data-bs-target="#createDiskusi">Buat
                             Diskusi</button>
                     </div>
                     @include('Pages.RuangDiskusi.modal', ['mapel' => $mapel])
                 </div>
                 <hr class="horizontal dark mb-0">
             </div>
             <div class="card-body p-3 pt-0">
                 <ul class="list-group list-group-flush" data-toggle="checklist">
                     @forelse ($data->where('mata_pelajaran_id', auth()->user()->pengajar->mata_pelajaran_id) as $item)
                         <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                             <a href="{{ route('ruangdiskusi.show', $item->slug) }}">
                                 <div class="checklist-item checklist-item-primary ps-2 ms-3">
                                     <div class="d-flex align-items-center">
                                         <h6 class="mb-0 text-dark font-weight-bold text-sm">
                                             {{ $item->judul }}
                                         </h6>
                                         <div class="dropdown float-lg-end ms-auto pe-4">
                                             <h6 class="mb-0 text-dark font-weight-bold text-sm">
                                                 {{ Str::limit($item->content, 50, '...') }}
                                             </h6>
                                         </div>
                                     </div>
                                     <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                                         <div>
                                             <p class="text-xs mb-0 text-secondary font-weight-bold">
                                                 Mata Pelajaran
                                             </p>
                                             <span class="text-xs font-weight-bolder">
                                                 {{ $item->mapel->nama_mapel }}
                                             </span>
                                         </div>
                                         <div class="ms-auto">
                                             <p class="text-xs mb-0 text-secondary font-weight-bold">
                                                 Update At
                                             </p>
                                             <span class="text-xs font-weight-bolder">
                                                 {{ $item->updated_at->format('d F Y, g:i A') }}
                                             </span>
                                         </div>
                                         <div class="mx-auto">
                                             <p class="text-xs mb-0 text-secondary font-weight-bold">
                                                 Creator
                                             </p>
                                             <span class="text-xs font-weight-bolder">
                                                 {{ $item->user->nama_lengkap }}
                                             </span>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                             <hr class="horizontal dark mt-4 mb-0">
                         </li>
                     @empty
                         <li class="list-group-item border-0 text-center">
                             <p class="text-secondary mb-0">Tidak ada data yang tersedia.</p>
                         </li>
                     @endforelse
                 </ul>
                 {{ $data->links() }}
             </div>
         </div>
     </div>
 </div>
