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
                        <h4 class="card-title"> <?= $data->tptype_id == 0 ? 'Tambah' : 'Ubah' ?> Paket Training</h4>
                        <form class="form-horizontal mt-4" method="POST" action="<?php echo site_url() . 'Training_package/form_package/' . $data->tptype_id . '/' . $data->tpack_id ?>">
                            <div class="form-body">
                                <div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Paket</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Nama Paket" name="pack_name" value="<?php echo $data->tpack_name ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Pertemuan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fname" placeholder="Jumlah Pertemuan" name="pack_meeting" value="<?php echo $data->tpack_meeting ?>" aria-describedby="basic-addon2" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Pertemuan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lama Pertemuan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fname" placeholder="Lama Pertemuan" name="pack_time" value="<?php echo $data->tpack_time ?>" aria-describedby="basic-addon2" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Jam</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tipe Paket</label>
                                        <div class="form-group">
                                            <select class="form-control custom-select" name="type_name" style="width: 100%; height: 36px;">
                                                <?php if ($data->tptype_id == 0) : ?>
                                                    <option hidden selected disabled>Pilih Tipe Paket</option>
                                                    <option value="Basic">Basic</option>
                                                    <option value="Private">Private</option>
                                                <?php else : ?>
                                                    <?php if ($data->tptype_name == "Basic") { ?>
                                                        <option value="Basic" selected>Basic</option>
                                                        <option value="Private">Private</option>
                                                    <?php } else { ?>
                                                        <option value="Basic">Basic</option>
                                                        <option value="Private" selected>Private</option>
                                                    <?php } ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Harga Paket</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                            <input type="text" class="form-control" id="fname" placeholder="" name="type_price" value="<?php echo $data->tptype_price ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        <input type="text" hidden id="tpack_id" name="tpack_id" value="<?php echo $data->tpack_id; ?>">
                                        <input type="text" hidden id="tptype_id" name="tptype_id" value="<?php echo $data->tptype_id; ?>">
                                        <input type="text" hidden id="submitPackage" name="submitPackage" value="submitPackage">
                                        <a href="<?php echo site_url() . 'training_package' ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
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