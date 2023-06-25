   <div class="modal fade" id="jenisSoal" tabindex="-1" aria-hidden="true" style="display: none;">
       <div class="modal-dialog mt-lg-10">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="ModalLabel">Jenis Soal</h5>
                   <i class="fas fa-upload ms-3"></i>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <p>Jenis Soal</p>
                   <div class="btn-group ">
                       <button type="button" class="btn btn-sm bg-gradient-primary dropdown-toggle btn-lg w-100"
                           data-bs-toggle="dropdown" aria-expanded="false">
                           Pilih Jenis Soal
                       </button>
                       <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                           <li><a class="dropdown-item border-radius-md"
                                   href="{{ route('banksoal.soal.create', ['id' => $data, 'jenis' => 'pilihan_ganda']) }}">Pilihan
                                   Ganda</a></li>
                           <li><a class="dropdown-item border-radius-md"
                                   href="{{ route('banksoal.soal.create', ['id' => $data, 'jenis' => 'benar_salah']) }}">True/False</a>
                           </li>
                           <li><a class="dropdown-item border-radius-md"
                                   href="{{ route('banksoal.soal.create', ['id' => $data, 'jenis' => 'isian']) }}">Essay</a>
                           </li>
                       </ul>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn bg-gradient-secondary btn-sm"
                       data-bs-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
   </div>
