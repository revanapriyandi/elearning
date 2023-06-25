   <div class="modal fade" id="import" tabindex="-1" aria-hidden="true" style="display: none;">
       <div class="modal-dialog mt-lg-10">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                   <i class="fas fa-upload ms-3"></i>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <p>You can browse your computer for a file.</p>
                   <input type="text" placeholder="Browse file..." class="form-control mb-3" onfocus="focused(this)"
                       onfocusout="defocused(this)">
                   <div class="form-check">
                       <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                       <label class="custom-control-label" for="importCheck">I accept the terms
                           and conditions</label>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn bg-gradient-secondary btn-sm"
                       data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn bg-gradient-primary btn-sm">Upload</button>
               </div>
           </div>
       </div>
   </div>
