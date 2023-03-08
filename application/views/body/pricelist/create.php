<script>
   function startCalc(){
      interval = setInterval("calc()",1);
   }

   function calc(){
      var ppnCalc = 0.11;
      var smuBasicCalc = document.formTambahPricelist.inputBasic.value;
      var ppnSmu = smuBasicCalc * ppnCalc;
      var smuPpn = (Number(smuBasicCalc) + Number(ppnSmu));
      var raCalc = document.formTambahPricelist.inputRA.value;
      var ihc = document.formTambahPricelist.inputIhc.value;
      var wh = document.formTambahPricelist.inputWarehouse.value;
      var handling = document.formTambahPricelist.inputHandling.value;
      var allin = (Number(smuPpn) + Number(raCalc) + Number(ihc) + Number(wh) + Number(handling));
      document.formTambahPricelist.inputTax.value = ppnSmu;
      document.formTambahPricelist.inputBasicTax.value = smuPpn;
      document.formTambahPricelist.inputAllin.value = allin;                    
   }

   function stopCalc(){
      clearInterval(interval);
   }
</script>
<section>
   <div class="row">
      <div class="col-md-12">
         <?= $this->session->flashdata('message_name'); ?>
      </div>
   </div>
   <?php if($this->uri->segment(3) == true) { ?>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="card-title">
                  Edit harga
               </div>
            </div>
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-8">

                     <form action="<?= base_url('pricelist/store')?>" method="post" class="form" name="formTambahPricelist">
                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="inputMaskapai">Airline</label>
                              <select name="inputMaskapai" id="" class="form-control" data-live-search="true">
                                 <option>Choose Airline ...</option>
                                 <option <?= $pricelist['maskapai_id'] == 'CTL' ? 'selected' : '' ?> value="CTL">Citilink</option>
                                 <option <?= $pricelist['maskapai_id'] == 'GIA' ? 'selected' : '' ?> value="GIA">Garuda Indonesia</option>
                                 <option <?= $pricelist['maskapai_id'] == 'LAG' ? 'selected' : '' ?> value="LAG">Lion Air Group</option>
                              </select>
                           </div>
                           <!-- <div class="form-group col-md-6">
                              <label for="inputProduct">Product Type</label>
                              <select name="inputProduct" id="" class="form-control" data-live-search="true">
                                 <option>Choose Product Type...</option>
                                 <option <?= $pricelist['origin'] == 'Port to Port"' ? 'selected' : '' ?> value="Port to Port">Port to Port</option>
                                 <option <?= $pricelist['origin'] == 'Port to Door"' ? 'selected' : '' ?> value="Port to Door">Port to Door</option>
                                 <option <?= $pricelist['origin'] == 'Door to Port"' ? 'selected' : '' ?> value="Door to Port">Door to Port</option>
                                 <option <?= $pricelist['origin'] == 'Door to Door"' ? 'selected' : '' ?> value="Door to Door">Door to Door</option>
                              </select>
                           </div> -->
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="inputOrigin">Origin</label>
                              <select name="inputOrigin" class="form-control" data-live-search="true">
                                 <!-- <select id="inputState" class="form-control se"> -->
                                 <option>Choose Origin...</option>
                                 <option <?= $pricelist['origin'] == 'CGK' ? 'selected' : '' ?> value="CGK">JAKARTA (CENGKARENG)</option>
                                 <option <?= $pricelist['origin'] == 'HLP' ? 'selected' : '' ?> value="HLP">JAKARTA (HALIM PERDANAKUSUMA)</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="inputDest">Destination</label>
                              <select name="inputDest" class="form-control select2" data-live-search="true">
                                 <!-- <select id="inputState" class="form-control se"> -->
                                 <option>Choose Destination...</option>
                                 <?php 
                                 foreach($destination as $d) {
                                    ?>
                                 <option <?= $pricelist['destinasi'] == $d->kode_destinasi ? 'selected' : '' ?> value="<?= $d->kode_destinasi ?>">(<?= $d->kode_destinasi ?>) - <?= $d->destinasi?></option>
                                 <?php
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-4">
                              <label for="inputBasic">SMU Basic</label>
                              <input type="text" class="form-control" value="<?= $pricelist['smu_basic'] ?>" name="inputBasic" id="inputBasic" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Basic price">
                           </div>
                           <div class="form-group col-md-4">
                              <label for="inputTax">Tax 11%</label>
                              <input type="text" class="form-control" name="inputTax" id="inputTax" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Tax">
                           </div>
                           <div class="form-group col-md-4">
                              <label for="inputBasicTax">Basic + Tax</label>
                              <input type="text" class="form-control" name="inputBasicTax" id="inputBasicTax" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Basic price">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="inputRA">Regulated Agent</label>
                              <input type="text" class="form-control" value="<?= $pricelist['r_a'] ?>" name="inputRA" id="inputRA" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Regulated Agent">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="inputWarehouse">Warehouse</label>
                              <input type="text" class="form-control" name="inputWarehouse"  value="<?= $pricelist['warehouse'] ?>" id="inputWarehouse" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Warehouse">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-4">
                              <label for="inputIhc">IHC</label>
                              <input type="text" class="form-control"  value="<?= $pricelist['ihc'] ?>" name="inputIhc" id="inputIhc" onFocus="startCalc();" onBlur="stopCalc();" placeholder="IHC">
                           </div>
                           <div class="form-group col-md-4">
                              <label for="inputHandling">Handling</label>
                              <input type="text" class="form-control" name="inputHandling"  value="<?= $pricelist['handling'] ?>" id="inputHandling" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Handling">
                           </div>
                           <div class="form-group col-md-4">
                              <label for="inputAllin">All in</label>
                              <input type="text" class="form-control" name="inputAllin"  value="<?= $pricelist['all_in'] ?>" id="inputAllin" onFocus="startCalc();" onBlur="stopCalc();" placeholder="All in">
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php }else{ ?>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     Tambah harga
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="col-md-8">

                        <form action="<?= base_url('pricelist/store')?>" method="post" class="form" name="formTambahPricelist">
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputMaskapai">Airline</label>
                                 <select name="inputMaskapai" id="" class="form-control" data-live-search="true">
                                    <option>Choose Airline ...</option>
                                    <option value="CTL">Citilink</option>
                                    <option value="GIA">Garuda Indonesia</option>
                                    <option value="LAG">Lion Air Group</option>
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputProduct">Product Type</label>
                                 <select name="inputProduct" id="" class="form-control" data-live-search="true">
                                    <option>Choose Product Type...</option>
                                    <option value="Port to Port">Port to Port</option>
                                    <option value="Port to Door">Port to Door</option>
                                    <option value="Door to Port">Door to Port</option>
                                    <option value="Door to Door">Door to Door</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputOrigin">Origin</label>
                                 <select name="inputOrigin" class="form-control" data-live-search="true">
                                    <!-- <select id="inputState" class="form-control se"> -->
                                    <option>Choose Origin...</option>
                                    <option value="CGK">JAKARTA (CENGKARENG)</option>
                                    <option value="HLP">JAKARTA (HALIM PERDANAKUSUMA)</option>
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputDest">Destination</label>
                                 <select name="inputDest" class="form-control" data-live-search="true">
                                    <!-- <select id="inputState" class="form-control se"> -->
                                    <option>Choose Destination...</option>
                                    <?php 
                                    foreach($pricelist as $d) {
                                       ?>
                                    <option value="<?= $d->kode_destinasi ?>"><?= $d->destinasi?></option>
                                    <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="inputBasic">SMU Basic</label>
                                 <input type="text" class="form-control" name="inputBasic" id="inputBasic" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Basic price">
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="inputTax">Tax 11%</label>
                                 <input type="text" class="form-control" name="inputTax" id="inputTax" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Tax">
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="inputBasicTax">Basic + Tax</label>
                                 <input type="text" class="form-control" name="inputBasicTax" id="inputBasicTax" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Basic price">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputRA">Regulated Agent</label>
                                 <input type="text" class="form-control" name="inputRA" id="inputRA" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Regulated Agent">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputWarehouse">Warehouse</label>
                                 <input type="text" class="form-control" name="inputWarehouse" id="inputWarehouse" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Warehouse">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="inputIhc">IHC</label>
                                 <input type="text" class="form-control" name="inputIhc" id="inputIhc" onFocus="startCalc();" onBlur="stopCalc();" placeholder="IHC">
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="inputHandling">Handling</label>
                                 <input type="text" class="form-control" name="inputHandling" id="inputHandling" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Handling">
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="inputAllin">All in</label>
                                 <input type="text" class="form-control" name="inputAllin" id="inputAllin" onFocus="startCalc();" onBlur="stopCalc();" placeholder="All in">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php } ?>
</section>