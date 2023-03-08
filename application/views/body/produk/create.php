<section>
   <?php
   if ($this->uri->segment(2) == "set_paket") {
   ?>

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
                     Set paket
                  </div>
                  <a href="<?= base_url('produk/index') ?>" class="btn btn-warning pull-right">Kembali</a>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">
                        <div class="table-responsive">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 foreach ($paket as $p) {
                                 ?>
                                    <tr>
                                       <form action="<?= base_url('produk/update_isi_paket') ?>" method="post">
                                          <td>
                                             <input type="hidden" name="idPaket" value="<?= $this->uri->segment(3) ?>">
                                             <input type="hidden" name="idDetail" value="<?= $p->Id ?>">
                                             <select name="idInventori" id="idInventori" class="form-control select2">
                                                <option value="">-- Pilih --</option>
                                                <?php
                                                foreach ($inventori as $i) {
                                                ?>
                                                   <option value="<?= $i->id ?>" <?= $i->id == $p->kode_barang ? 'selected' : '' ?>><?= $i->nama_barang ?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                          </td>

                                          <td>
                                             <input type="number" name="inputJumlah" id="inputJumlah" class="form-control" value="<?= $p->jumlah ?>">
                                          </td>
                                          <td>
                                             <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                          </td>
                                       </form>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                                 <tr>
                                    <form action="<?= base_url('produk/tambah_set_paket') ?>" method="post">
                                       <td>
                                          <input type="hidden" name="idPaket" value="<?= $this->uri->segment(3) ?>">
                                          <select name="idInventori" id="idInventori" class="form-control select2">
                                             <option value="">-- Pilih --</option>
                                             <?php
                                             foreach ($inventori as $i) {
                                             ?>
                                                <option value="<?= $i->id ?>"><?= $i->nama_barang ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </td>
                                       <td>
                                          <input type="number" name="inputJumlah" id="inputJumlah" class="form-control">
                                       </td>
                                       <td>
                                          <button type="submit" class="btn btn-primary btn-sm"><i class="feather icon-plus"></i></button>
                                       </td>
                                    </form>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   <?php
   } else if ($this->uri->segment(2) == "tambah_paket") {
   ?>

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
                     Tambah paket
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">
                        <form action="<?= base_url('produk/tambah_jumlah_paket') ?>" method="post" class="form">
                           <div class="form-row">
                              <div class="form-group col-md-8">
                                 <input type="hidden" name="idPaket" value="<?= $id ?>">
                                 <label for="inputJumlahPaket">Jumlah Paket</label>
                                 <input type="number" name="inputJumlahPaket" id="inputJumlahPaket" class="form-control" placeholder="Masukkan jumlah paket" autofocus required>
                              </div>
                              <!-- <div class="form-group col-md-4">
                                 <label for="inputJumlah">Jumlah</label>
                                 <input type="number" name="inputJumlah" id="inputJumlah" class="form-control">
                              </div> -->
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-8 text-right">
                                 <a href="<?= base_url('produk/index') ?>" class="btn btn-warning">Kembali</a>
                                 <span>&nbsp;</span>
                                 <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                              </div>
                           </div>
                        </form>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   <?php
   } else {
   ?>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     Buat Paket
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">
                        <form action="<?= base_url('produk/simpan_paket') ?>" method="post" class="form">
                           <div class="form-row">
                              <div class="form-group col-md-12">
                                 <label for="inputNama">Nama Paket</label>
                                 <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="Masukkan nama paket" autofocus required>
                              </div>
                              <!-- <div class="form-group col-md-4">
                                 <label for="inputJumlah">Jumlah</label>
                                 <input type="number" name="inputJumlah" id="inputJumlah" class="form-control">
                              </div> -->
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-12 text-right">
                                 <a href="<?= base_url('produk/index') ?>" class="btn btn-warning">Kembali</a>
                                 <span>&nbsp;</span>
                                 <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php
   }
   ?>
</section>