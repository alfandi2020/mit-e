<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload </h4>
                </div>
                <form method="POST" action="<?= base_url('user/upload_file') ?>" enctype="multipart/form-data">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="basicInputFile">Upload File</label>
                                        <div class="custom-file">
                                            <input type="file" id="filex" name="filex" class="custom-file-input"
                                                id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4">
                                    <button type="button" class="btn btn-primary mt-2" id="preview_submit">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body">
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
                </div>
            </div>
        </div>
</section>