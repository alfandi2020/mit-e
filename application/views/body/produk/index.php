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
                  Daftar Produk
               </div>
               <a href="<?= base_url('produk/create') ?>" class="btn btn-primary"> Buat Paket </a>
               <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaket"> Show </button> -->
            </div>
            <div class="card-content">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table" id="tabel-produk">
                        <thead>
                           <tr>
                              <th>Kode Produk</th>
                              <th>Stok</th>
                              <th>Isi paket</th>
                              <th>Aksi</th>
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