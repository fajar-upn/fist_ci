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
                    <h2 class="card-title">Penambahan Periode Pilihan </h2>
                    <h5 class="card-subtitle">Mohon lengkapi Periode dibawah dengan <code>baik</code> dan <code>benar</code>.</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $data->scperiod_id == 0 ? 'Tambah' : 'Ubah' ?> Periode</h4>
                    <form method="POST" action="<?php echo site_url() ?>package/form_periode">
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Pilih Bulan Awal</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="scperiod_desc1" aria-placeholder="Pilih Paket" required>
                                    <option value="">Pilih Bulan</option>
                                    <?php if ($data != null) { ?>
                                        <?php foreach ($month1 as $row) { ?>
                                            <?php if ($row == $data->scperiod_month1) { ?>
                                                <option value="<?php echo $row ?>" selected><?php echo $row; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row ?>"><?php echo $row; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Pilih Bulan Akhir</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="scperiod_desc2" aria-placeholder="Pilih Paket" required>
                                    <option value="">Pilih Bulan</option>
                                    <?php if ($data != null) { ?>
                                        <?php foreach ($month1 as $row) { ?>
                                            <?php if ($row == $data->scperiod_month2) { ?>
                                                <option value="<?php echo $row ?>" selected><?php echo $row; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row ?>"><?php echo $row; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scperiode_year" class="col-sm-3 text-right control-label col-form-label">Tahun</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="scperiod_year" id="scperiode_year" placeholder="Tahun " value="<?php echo $data->scperiod_year; ?>" required>
                            </div>
                        </div>


                        <hr>
                        <div class="card-body">
                            <input type="text" hidden id="scperiod_id" name="scperiod_id" value="<?php echo $data->scperiod_id; ?>">
                            <input type="text" hidden id="submitPeriode" name="submitPeriode" value="submitPeriode">
                            <div class="form-group m-b-0 text-right">
                                <a href="<?php echo site_url() . 'package/index_periode'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>