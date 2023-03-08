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
                  Daftar Inventori
               </div>
               <a href="<?= base_url('inventori/tambah_barang') ?>" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-content">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table" id="table-inventori">
                        <thead>
                           <tr>
                              <!-- <th>No.</th> -->
                              <th>Nama Barang</th>
                              <th>Jumlah</th>
                              <th>Berat</th>
                              <th>Pengirim</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>