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
                        <h4 class="card-title"> <?= $data->uacc_id == 0 ? 'Tambah' : 'Ubah' ?> Data Peserta</h4>
                        <form class="form-horizontal mt-4" method="POST" enctype="multipart/form-data" action="<?php echo site_url() . 'Training/form_participant/' . $data->tclass_id . '/' . $data->uacc_id ?>">
                            <div class="form-body">
                                <div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Nama Lengkap" name="name" value="<?php echo $data->uprof_full_name ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">NIK/No. KTA</label>
                                        <input type="text" class="form-control" id="fname" placeholder="NIK/No KTA" name="nik" value="<?php echo $data->uacc_username ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="abpro" placeholder="Tempat Lahir" name="birth_place" value="<?php echo $data->uprof_birth_place ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Tanggal Lahir</label>
                                                <input type="text" class="form-control mdate" placeholder="Tanggal Lahir" name="birth_date" value="<?php echo $data->uprof_birth_date ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jenis Kelamin</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation2" <?php if($data->uprof_gender == 'Laki-laki') echo 'checked'?> name="gender" value="Laki-laki" required>
                                            <label class="custom-control-label" for="customControlValidation2">Laki - laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="customControlValidation3" <?php if($data->uprof_gender == 'Perempuan') echo 'checked'?> name="gender" value="Perempuan" required>
                                            <label class="custom-control-label" for="customControlValidation3">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control" id="email1" placeholder="Email" name="email" value="<?php echo $data->uacc_email ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Nomor Telepon" name="phone" value="<?php echo $data->uprof_phone ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Instagram</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Instagram" name="sosmed" value="<?php echo $data->uprof_sosmed ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat</label>
                                        <textarea class="form-control" name="address" placeholder="Alamat" required><?php echo $data->uprof_address ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Instansi</label>
                                        <input class="typeahead form-control" type="text" placeholder="Nama Instansi" name="institution" value="<?php echo $data->uprof_institution ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Potongan Harga</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input class="typeahead form-control" type="text" placeholder="" name="discount" value="<?php echo $data->tcontr_discount ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Kontrak</label>
                                        <input type="text" class="form-control mdate" placeholder="Tanggal Kontrak" name="contr_date" value="<?php echo $data->tcontr_date ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFile" class="col-sm-4 form-control-label">File Kontrak</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="tfile_name" required>
                                                <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        <input type="text" hidden name="class_id" value="<?php echo $data->tclass_id; ?>">
                                        <input type="text" hidden name="uacc_id" value="<?php echo $data->uacc_id; ?>">
                                        <input type="text" hidden id="submitTraining" name="submitTraining" value="submitTraining">
                                        <a href="<?php echo site_url() . 'training/table_participant/' . $data->tclass_id ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
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