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
                        <form class="form-horizontal mt-4" method="POST" action="<?php echo site_url() . 'Training_package/form_packresource/'. $data->tpack_id . '/' . $data->tpdetail_id . '/' . $data->tres_id ?>">
                            <div class="form-body">
                                <div>
                                    <label class="control-label">Nama Resource</label>
                                    <div class="form-group">
                                        <select name="res_id" class="select2 form-control custom-select" style="width: 100%">
                                            <option selected disabled>Pilih Nama Resource</option>
                                            <?php foreach ($res as $res) :  ?>
                                                <?php if($data->tres_id == $res->tres_id) : ?>
                                                <option value="<?php echo $res->tres_id ?>" selected><?php echo $res->tres_name ?></option>
                                                <?php else : ?>
                                                <option value="<?php echo $res->tres_id ?>"><?php echo $res->tres_name ?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        <input type="text" hidden id="tpack_id" name="tpack_id" value="<?php echo $data->tpack_id; ?>">
                                        <input type="text" hidden id="tres_id" name="tres_id" value="<?php echo $data->tres_id; ?>">
                                        <input type="text" hidden id="tres_id" name="tres_id" value="<?php echo $data->tpdetail_id; ?>">
                                        <input type="text" hidden id="submitRes" name="submitRes" value="submitRes">
                                        <a href="<?php echo site_url() . 'training_package/table_packresource/' . $data->tpack_id ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>