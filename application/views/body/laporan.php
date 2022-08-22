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
                                        <?php if($this->input->get('agent')){ ?>
                                            <a target="_blank" href="<?= base_url('laporan/pdf/'.$this->input->get('agent')) ?>" class="btn btn-success">Pdf</a>
                                        <?php } ?>
                                    </div>
                                </div> 
                            </form>
                        <div class="table-responsive">
                            <table class="table zero-configuration" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Agent</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th style="text-align:right">Saldo</th>
                                        <!-- <th>Action</th> -->
                                        <!-- <th width="230">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $start = strtotime($this->input->get('start'));
                                    $end = strtotime($this->input->get('end'));
                                    $agent_get = $this->input->get('agent');
                                    
                                    if ($agent_get == true) { 
                                        $no=1; 

                                       $date1 = date('d-m-Y',$start);
                                       $date2 = date('d-m-Y',$end);
                                    $cek = $this->db->query("SELECT * FROM dt_excel where z like '%$agent_get%' or f between '$date1' and '$date2' order by id asc")->result();
                                    foreach ($cek as $x) {
                                        if ($x->A != "TOP UP") {
                                        ?>
                                       <tr style="background-color: #fd79a8;font-weight:bold;">
                                            <td style="color:white;"><?= $no++; ?></td>
                                            <td style="color:white;"><?= $x->A?></td>
                                            <td style="color:white;"><?= $x->F?></td>
                                            <td style="color:white;"><?= $x->U?></td>
                                            <td style="color:white;" align="right"><?= "Rp.". number_format($x->saldo_akhir,0,".",".") ?></td>
                                       </tr>
                                    <?php
                                            }else{?>
                                        <tr style="background-color: #55efc4;font-weight:bold;">
                                            <td style="color:white;"><?= $no++; ?></td>
                                            <td style="color:white;"><?= $x->A?></td>
                                            <td style="color:white;"><?= $x->F?></td>
                                            <td style="color:white;"><?= $x->U?></td>
                                            <td style="color:white;" align="right"><?= "Rp.". number_format($x->saldo_akhir,0,".",".") ?></td>
                                       </tr>
                                        <?php }
                                        }?>
                                    <?php } ?>
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>