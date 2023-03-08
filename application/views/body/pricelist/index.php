<section>
   <div class="row">
      <div class="col-md-12">
         <?= $this->session->flashdata('message_name'); ?>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="card-title">
                  Daftar Harga
               </div>
               <a href="<?= base_url('pricelist/create') ?>" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-content">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table" id="table-pricelist">
                        <thead>
                           <tr>
                              <!-- <th>No.</th> -->
                              <th>Maskapai</th>
                              <th>Origin</th>
                              <th>Dest.</th>
                              <th>All in</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>