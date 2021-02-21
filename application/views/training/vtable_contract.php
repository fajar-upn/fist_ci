<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
                        <span id="alertmessage"></span>
                    </div>
                <?php endif; ?>
                <h4 class="card-title">Kontrak</h4>
                <hr>
                <div class="p-20">
                    <div class="col-sm-5">
                        <div class="form-group row">
                            <h5 class="control-label text-left col-md-3">Nama </h5>
                            <div class="col-sm-1">
                                <h5 class="form-control-static">:</h5>
                            </div>
                            <div class="col-sm-8">
                                <h5 class="form-control-static"><?php echo $contracts->uprof_full_name ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group row">
                            <h5 class="control-label text-left col-md-3">Tanggal </h5>
                            <div class="col-sm-1">
                                <h5 class="form-control-static">:</h5>
                            </div>
                            <div class="col-sm-5">
                                <h5 class="form-control-static"><?php echo $contracts->tcontr_date ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group row">
                            <h5 class="control-label text-left col-md-3">File Kontrak </h5>
                            <div class="col-sm-1">
                                <h5 class="form-control-static">:</h5>
                            </div>
                            <div class="col-sm-5">
                                <h5 class="form-control-static"><a href="<?php echo site_url() . 'Training/download/' . $classId . '/' . $contracts->tcontr_id ?>">Download File</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                    <a href="<?php echo site_url() . 'Training/table_participant/' . $classId ?>" class="btn waves-effect waves-light btn-dark" data-toggle="tooltip"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>