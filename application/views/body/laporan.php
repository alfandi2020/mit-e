<section id="basic-input">
    <div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Laporan</h4>
                </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-xl-2">
                                        <label>Start</label>
                                        <input type="date" name="start" class="form-control">
                                    </div>
                                    <div class="col-xl-2">
                                        <label>End</label>
                                        <input type="date" name="end" class="form-control">
                                    </div>
                                    <div class="col-xl-3">
                                        <label>Agent</label>
                                        <select name="agent" id="" class="form-control select2">
                                            <?php foreach ($agent as $k) { ?>
                                                <option value="<?= $k->id_agent ?>"><?= $k->id_agent ?></option>
                                                <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 mt-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div> 
                            </form>
                        <div class="table-responsive">
                            <table class="table zero-configuration" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Agent</th>
                                        <th>Nama Agent</th>
                                        <th style="text-align:right">Saldo</th>
                                        <!-- <th width="230">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=1; 

                                    $start = strtotime($this->input->get('start'));
                                    $end = strtotime($this->input->get('end'));
                                    $agent_get = $this->input->get('agent');
                                    
                                    if ($agent_get == true) { 
                                       $date1 = date('d-m-Y',$start);
                                       $date2 = date('d-m-Y',$end);
                                    $cek = $this->db->query("SELECT * FROM dt_excel where z like '%$agent_get%' and f between '$date1' and '$date2'")->result();
                                    foreach ($cek as $x) {
                                        ?>
                                       <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $x->A?></td>
                                            <td><?= $x->B ?></td>
                                            <td align="right"><?= "Rp.". number_format($x->saldo_akhir,0,".",".") ?></td>
                                       </tr>
                                    <?php
                                        } 
                                    }else{
                                         foreach ($agent as $x) {
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->id_agent ?></td>
                                        <td><?= $x->nama ?></td>
                                        <td align="right"><?= "Rp.". number_format($x->saldo,0,".",".") ?></td>
                                        <!-- <td>
                                            <button id="<?= $x->id ?>" class="btn btn-primary update-user"> <i class="feather icon-edit"></i> Edit</button>&nbsp;&nbsp;
                                            <?php if ($x->id != 1) { ?>
                                            <a href="<?= base_url('user/delete/').$x->id ?>" class="btn btn-danger confirm-delete"> <i class="feather icon-trash-2"></i> Delete</a>
                                            <?php } ?>
                                        </td> -->
                                    </tr>
                                    <?php } 
                                    }?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>