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
                        <h4 class="card-title"> <?= $data->tclass_id == 0 ? 'Tambah' : 'Ubah' ?> Kelas Training</h4>
                        <form class="form-horizontal mt-4" method="POST" action="<?php echo site_url() . 'Training/form_class/' . $data->tclass_id ?>">
                            <?php if ($data->tclass_status == 1 || $data->tclass_status == NULL) : ?>
                                <div class="form-body">
                                    <div>
                                        <div class="form-group">
                                            <label class="control-label">Nama Kelas</label>
                                            <input type="text" class="form-control" id="fname" placeholder="Nama Kelas" name="class_name" value="<?php echo $data->tclass_name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nama Paket</label>
                                            <div class="form-group">
                                                <select class="select2 form-control custom-select" name="packtype_id" style="width: 100%; height: 36px;" required>
                                                    <option hidden selected disabled>Nama Paket</option>
                                                    <?php foreach ($class as $class) :  ?>
                                                        <?php if ($data->tptype_id == $class->tptype_id) : ?>
                                                            <option value="<?php echo $class->tptype_id ?>" selected><?php echo $class->tpack_name . " - " . $class->tptype_name ?></option>
                                                        <?php else : ?>
                                                            <option value="<?php echo $class->tptype_id ?>"><?php echo $class->tpack_name . " - " . $class->tptype_name ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nama Tentor</label>
                                            <div class="form-group">
                                                <select class="select2 form-control custom-select" name="tentor_id" style="width: 100%; height: 36px;" required>
                                                    <option hidden selected disabled>Nama Tentor</option>
                                                    <?php foreach ($users as $user) :  ?>
                                                        <?php if ($data->uacc_id == $user->uacc_id) : ?>
                                                            <option value="<?php echo $user->uacc_id ?>" selected><?php echo $user->uprof_full_name ?></option>
                                                        <?php else : ?>
                                                            <option value="<?php echo $user->uacc_id ?>"><?php echo $user->uprof_full_name ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Status Kelas</label>
                                            <div class="form-group">
                                                <select class="select2 form-control custom-select" name="status" style="width: 100%; height: 36px;" required>
                                                    <?php if ($data->tclass_status != 1) : ?>
                                                        <option hidden selected disabled>Pilih Status Kelas</option>
                                                        <option value="1">Belum Berlangsung</option>
                                                        <option value="2">Sedang Berlangsung</option>
                                                        <option value="3">Sudah Selesai</option>
                                                    <?php else : ?>
                                                        <option hidden disabled>Pilih Status Kelas</option>
                                                        <option value="1" selected>Belum Berlangsung</option>
                                                        <option value="2">Sedang Berlangsung</option>
                                                        <option value="3">Sudah Selesai</option>
                                                    <?php endif ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="form-body">
                                        <div>
                                            <div class="form-group">
                                                <label class="control-label">Nama Kelas</label>
                                                <input type="text" class="form-control" id="fname" placeholder="Nama Kelas" name="class_name" value="<?php echo $data->tclass_name ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nama Paket</label>
                                                <div class="form-group">
                                                    <?php foreach ($class as $class) :  ?>
                                                        <?php if ($data->tptype_id == $class->tptype_id) : ?>
                                                            <input type="text" class="form-control" placeholder="Nama Paket" name="packtype_id" value="<?php echo $class->tptype_id ?>" hidden>
                                                            <input type="text" class="form-control" value="<?php echo $class->tpack_name . " - " . $class->tptype_name ?>" readonly>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nama Tentor</label>
                                                <div class="form-group">
                                                    <?php foreach ($users as $user) :  ?>
                                                        <?php if ($data->uacc_id == $user->uacc_id) : ?>
                                                            <input type="text" class="form-control" name="tentor_id" value="<?php echo $user->uacc_id ?>" hidden>
                                                            <input type="text" class="form-control" value="<?php echo $user->uprof_full_name ?>" readonly>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Status Kelas</label>
                                                <div class="form-group">
                                                    <select class="select2 form-control custom-select" name="status" style="width: 100%; height: 36px;">
                                                        <option hidden disabled>Pilih Status Kelas</option>
                                                        <?php foreach ($status as $row) : ?>
                                                            <?php if ($row['value'] == $data->tclass_status) : ?>
                                                                <option value="<?php echo $row['value'] ?>" selected><?php echo $row['desc'] ?></option>
                                                            <?php else : ?>
                                                                <option value="<?php echo $row['value'] ?>"><?php echo $row['desc'] ?></option>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <input type="text" hidden id="tclass_id" name="tclass_id" value="<?php echo $data->tclass_id; ?>">
                                    <input type="text" hidden id="submitClass" name="submitClass" value="submitClass">
                                    <a href="<?php echo site_url() . 'training'; ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>