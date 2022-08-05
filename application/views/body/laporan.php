<section id="basic-input">
    <div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Laporan</h4>
                </div>
                    <div class="card-content">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2">
                                <label>Start</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-xl-2">
                                <label>End</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-xl-3">
                                <label>Agent</label>
                                <select name="" id="" class="form-control select2">
                                    <?php foreach ($agent as $k) { ?>
                                        <option value=""><?= $k->nama ?></option>
                                        <?php }?>
                                </select>
                            </div>
                            <div class="col-xl-4 mt-2">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                        </div> 
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
                                    <?php $no=1; foreach ($agent as $x) {?>
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