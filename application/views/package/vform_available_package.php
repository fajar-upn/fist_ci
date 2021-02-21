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
                    <h2 class="card-title">Penambahan Paket Tersedia </h2>
                    <h5 class="card-subtitle">Mohon lengkapi ketersediaan paket dibawah dengan <code>baik</code> dan <code>benar</code>.</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $data->scavailpkg_id == 0 ? 'Tambah' : 'Ubah' ?> paket</h4>
                    <form method="POST" action="<?php echo site_url() ?>package/form">
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Pemilihan Paket</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="package" aria-placeholder="Pilih Paket" required>
                                    <option value="">Pilih Paket</option>
                                    <?php
                                    foreach ($Apackage as $row) {
                                        if ($data->scavailpkg_scpack_fk == $row->scpack_id) { ?>
                                            <option value="<?php echo $row->scpack_id; ?>" selected><?php echo $row->scpack_code; ?> </option>
                                        <?php
                                        } else { ?>
                                            <option value="<?php echo $row->scpack_id; ?>"><?php echo $row->scpack_code; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Pemilihan Periode</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="periode" aria-placeholder="Pilih Periode" required>
                                    <option value="">Pilih Periode</option>
                                    <?php
                                    foreach ($Aperiode as $row) {
                                        if ($data->scavailpkg_scperiod_fk == $row->scperiod_id) { ?>
                                            <option value="<?php echo $row->scperiod_id; ?>" selected><?php echo $row->scperiod_desc . ' ' . $row->scperiod_year; ?> </option>
                                        <?php
                                        } else { ?>
                                            <option value="<?php echo $row->scperiod_id; ?>"><?php echo $row->scperiod_desc . ' ' . $row->scperiod_year; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 text-right control-label col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Harga" value="<?php echo $data->scavailpkg_price; ?>" required>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="text" hidden id="scavailpkg_id" name="scavailpkg_id" value="<?php echo $data->scavailpkg_id; ?>">
                            <input type="text" hidden id="submitAvailable" name="submitAvailable" value="submitAvailable">
                            <div class="form-group m-b-0 text-right">
                                <a href="<?php echo site_url() . 'package'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>