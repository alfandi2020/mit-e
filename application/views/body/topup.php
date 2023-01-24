<section id="basic-input">
    <div class="row">
        <!-- <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Agent</h4>
                </div>
                <form method="POST" action="<?= base_url('user/agent') ?>">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-12">
                                    <label>Kode Agent</label>
                                    <input type="text" class="form-control" name="kode" required placeholder="Halim">
                                </div>
                                <div class="col-xl-6 col-md-6 col-12">
                                    <label>Nama Agent</label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Halim">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Up Saldo </h4>
                </div>
                <form method="POST" action="<?= base_url('pricelist/topup') ?>">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-xl-6 col-md-6 col-12">
                                    <label>Agent</label>
                                    <select name="id_agent" id="" class="form-control select2">
                                        <?php
                                            foreach ($agent as $x) {
                                        ?>
                                            <option value="<?= $x->id_user ?>"><?= $x->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <div class="col-xl-6 col-md-6 col-12">
                                    <label>Saldo</label>
                                    <input type="text" class="form-control" id="rupiah" name="saldo" required placeholder="10000">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-primary">Top Up</button>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-xl-4">
                                    <input type="text" id="data_excel">
                                    <button type="submit" id="upload" class="btn btn-primary">Upload </button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </form>
                <!-- <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>Preview Excel</h4>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table zero-configuration2">
                                        <thead id="head2">

                                        </thead>
                                        <tbody id="body2"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Top up</h4>
                </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                <script>   
     
                    <?php if($this->session->flashdata('msg') == 'no_rek'){ ?>
                        $(document).ready( function () {
                        Swal.fire(
                                {
                                type: "success",
                                title: 'Silahkan transfer ke nomor berikut!',
                                text: 'No Rekening : 43134351124 BCA a.n BDL Warehouse',
                                confirmButtonClass: 'btn btn-success',
                                });
                            });

                    <?php } ?>
                </script>
                <form method="POST" action="<?= base_url('user/agent') ?>">
                    <div class="card-content">
                        <div class="card-body">
                               
                        <div class="table-responsive">
                            <table class="table zero-configuration" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Agent</th>
                                        <th>Nama Agent</th>
                                        <th>Status</th>
                                        <th style="text-align:right">Saldo</th> 
                                        <?php if ($this->session->userdata('role') == '1') {?>
                                        <th width="330">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($agent as $x) {?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->id_user ?></td>
                                        <td><?= $x->nama ?></td>
                                        <td><?php if($x->status == 'waiting'){
                                            echo '<b class="btn btn-warning">Waiting</b>';
                                        } ?></td>
                                        <td align="right"><?= "Rp.". number_format($x->saldo,0,".",".") ?></td>
                                        <?php if ($this->session->userdata('role') == '1') {?>
                                        <td>
                                            <a href="<?= base_url('pricelist/status/'.$x->id.'/'.$x->saldo) ?>" class="btn btn-primary confirm-approve"> Approve</a>
                                            <a href="<?= base_url('user/delete/').$x->id ?>" class="btn btn-danger confirm-delete">Reject</a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                    <!-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total Pending</td>
                                        <td align="right">Rp.232.232</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </form>
                <!-- <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>Preview Excel</h4>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table zero-configuration2">
                                        <thead id="head2">

                                        </thead>
                                        <tbody id="body2"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div> -->
            </div>
        </div>
    </div>
</section>