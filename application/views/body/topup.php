<section id="basic-input">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Up Saldo </h4>
                </div>
                <form method="POST" action="<?= base_url('user/topup') ?>">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-12">
                                    <label>Agent</label>
                                    <select name="id_agent" id="" class="form-control select2">
                                        <?php
                                            foreach ($agent as $x) {
                                        ?>
                                            <option value="<?= $x->id ?>"><?= $x->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-6 col-12">
                                    <label>Saldo</label>
                                    <input type="text" class="form-control" id="rupiah" name="saldo" required placeholder="10000">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h4 class="card-title">Table Agent</h4>
                </div>
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