<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert p-3 mb-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <h5 id="alerttitle"></h5>
                        <span id="alertmessage"></span>
                        <i id="alerticon"></i>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="card-title">Penambahan Paket Pilihan </h2>
                    <h5 class="card-subtitle">Mohon lengkapi paket dibawah dengan <code>baik</code> dan <code>benar</code>.</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $data->scpack_id == 0 ? 'Tambah' : 'Ubah' ?> paket</h4>
                    <form method="POST" action="<?php echo site_url() ?>package/form_package">
                        <div class="form-group row">
                            <label for="scpack_code" class="col-sm-3 text-right control-label col-form-label">Kode Paket</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="scpack_code" id="scpack_code" placeholder="Kode Paket" value="<?php echo $data->scpack_code; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scpack_name" class="col-sm-3 text-right control-label col-form-label">Nama Paket</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="scpack_name" id="scpack_name" placeholder="Nama Paket" value="<?php echo $data->scpack_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scpack_desc" class="col-sm-3 text-right control-label col-form-label">Nama Deskripsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="scpack_desc" id="scpack_desc" placeholder="Nama Deskripsi" value="<?php echo $data->scpack_desc; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <input type="text" hidden id="scpack_id" name="scpack_id" value="<?php echo $data->scpack_id; ?>">
                            <input type="text" hidden id="submitConsult" name="submitConsult" value="submitConsult">
                            <div class="form-group m-b-0 text-right">
                                <a href="<?php echo site_url() . 'package/index_package'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>