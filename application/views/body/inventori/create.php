<section>
   <div class="row">
      <div class="col-md-12">
         <?= $this->session->flashdata('message_name'); ?>
      </div>
   </div>
   <?php
   if ($this->uri->segment(3) == true) {
   ?>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     Edit Barang
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">
                        <form action="<?= base_url('inventori/update') ?>" method="post" class="form" name="formTambahBarang">
                           <div class="form-row">
                              <div class="form-group col-md-12">
                                 <label for="inputNama">Nama Barang</label>
                                 <input type="text" class="form-control" name="inputNama" id="inputNama" autofocus value="<?= $inventori['nama_barang'] ?>">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputJumlah">Jumlah Barang</label>
                                 <input type="number" name="inputJumlah" id="inputJumlah" class="form-control" value="<?= $inventori['jumlah'] ?>">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputBerat">Berat Barang</label>
                                 <input type="number" name="inputBerat" id="inputBerat" class="form-control" value="<?= $inventori['berat'] ?>">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputPengirim">Pengirim</label>
                                 <select name="inputPengirim" id="inputPengirim" class="form-control select2" data-live-search="true">
                                    <option value="">Pilih Pengirim</option>
                                    <?php
                                    foreach ($pengirim as $p) {
                                    ?>
                                       <option value="<?= $p->Id ?>" <?= $inventori['pengirim'] == $p->Id ? 'selected' : '' ?>><?= $p->nama_pengirim ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputTanggalMasuk">Tanggal Masuk</label>
                                 <input type="date" name="inputTanggalMasuk" id="inputTanggalMasuk" class="form-control" value="<?= $inventori['tanggal_masuk'] ?>">
                              </div>
                              <div class="form-row">
                                 <div class="form-group col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary pull-right ">Simpan</button>
                                 </div>
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
                     Tambah Barang
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">
                        <form action="<?= base_url('inventori/store') ?>" method="post" class="form" name="formTambahBarang">
                           <div class="form-row">
                              <div class="form-group col-md-12">
                                 <label for="inputNama">Nama Barang</label>
                                 <input type="text" class="form-control" name="inputNama" id="inputNama" autofocus>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputJumlah">Jumlah Barang</label>
                                 <input type="number" name="inputJumlah" id="inputJumlah" class="form-control">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputBerat">Berat Barang</label>
                                 <input type="number" name="inputBerat" id="inputBerat" class="form-control">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputPengirim">Pengirim</label>
                                 <select name="inputPengirim" id="inputPengirim" class="form-control select2" data-live-search="true">
                                    <option value="">Pilih Pengirim</option>
                                    <?php
                                    foreach ($pengirim as $p) {
                                    ?>
                                       <option value="<?= $p->Id ?>"><?= $p->nama_pengirim ?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputTanggalMasuk">Tanggal Masuk</label>
                                 <input type="date" name="inputTanggalMasuk" id="inputTanggalMasuk" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                              </div>
                              <div class="form-row">
                                 <div class="form-group col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary pull-right ">Simpan</button>
                                 </div>
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