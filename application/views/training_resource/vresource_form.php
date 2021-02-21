<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert p-3 mb-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <h5 id="alerttitle"></h5>
                        <span id="alertmessage"></span>
                        <i id="alerticon"></i>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4 class="card-title"> <?= $data->tres_id == 0 ? 'Tambah' : 'Ubah' ?> Training Resource</h4>
                        <form class="form-horizontal mt-4" method="POST" action="<?php echo site_url() . 'Training_resource/form_resource/' . $data->tres_id ?>">
                            <div class="form-body">
                                <div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Resource</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Nama Resource" name="resource_name" value="<?php echo $data->tres_name ?>" required>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        <input type="text" hidden id="tres_id" name="tres_id" value="<?php echo $data->tres_id; ?>">
                                        <input type="text" hidden id="submitRes" name="submitRes" value="submitRes">
                                        <a href="<?php echo site_url() . 'training_resource'; ?> " type="submit" class="btn btn-secondary">Batal</a>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
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