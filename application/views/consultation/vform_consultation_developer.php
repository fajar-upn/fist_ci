<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Pengajuan Konsultasi</h2>
                    <h5 class="card-subtitle">Mohon lengkapi berkas dibawah dengan <code>baik</code> dan <code>benar</code>.</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $data->scons_id == 0 ? 'Tambah' : 'Ubah' ?> Kebutuhan Pengajuan</h4>
                    <form method="POST" action="<?php echo site_url() ?>consultation/form">
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Pemilihan Paket</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="package" aria-placeholder="Pilih Paket">
                                    <option value="">Pilih Paket</option>
                                    <?php
                                    foreach ($package1 as $row1) {
                                        if ($data->scpack_id == $row1->pack_id) { ?>
                                            <option value="<?php echo $row1->pack_id; ?>" selected><?php echo $row1->package_code; ?> </option>
                                        <?php
                                        } else { ?>
                                            <option value="<?php echo $row1->pack_id; ?>"><?php echo $row1->package_code; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="university" class="col-sm-3 text-right control-label col-form-label">Tempat Kuliah</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="select2-with-placeholder" name="university" aria-placeholder="Pilih Universitas" style="width: 100%; height:36px;">
                                    <option value="">Pilih Universitas</option>
                                    <?php foreach ($university as $row) :
                                        if ($data->college_id == $row->college_id) { ?>
                                            <option value="<?php echo $row->college_id; ?>" selected><?php echo $row->college_name; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $row->college_id; ?>"><?php echo $row->college_name; ?> </option>
                                    <?php }
                                    endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="batch_year" class="col-sm-3 text-right control-label col-form-label">Angkatan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="batch_year" id="batchyear" placeholder="Angkatan" value="<?php echo $data->scons_batch_year; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="thesis_title" class="col-sm-3 text-right control-label col-form-label">Judul Skripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="thesis_title" id="thesis_title" rows="3" placeholder="Judul Skripsi"><?php echo $data->scons_thesis_title; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="thesis_description" class="col-sm-3 text-right control-label col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="thesis_decription" id="thesis_description" rows="3" placeholder="Deskripsi"><?php echo $data->scons_thesis_desc; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supervisor" class="col-sm-3 text-right control-label col-form-label">Dosen Pembimbing</label>
                            <div class="col-sm-9">
                                <input type="type" class="form-control" name="supervisor" id="supervisor" placeholder="Dosen Pembimbing" value="<?php echo $data->scons_supervisor; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graduationtarget" class="col-sm-3 text-right control-label col-form-label">Target lulus</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="graduation_target" id="graduation_target" placeholder="Target lulus" value="<?php echo $data->scons_graduation_target; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="proposal_target" class="col-sm-3 text-right control-label col-form-label">TA. 1</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="proposal_target" id="proposal_target" placeholder="TA. 1" value="<?php echo $data->scons_proposal_target; ?>">
                            </div>
                            <label for="proposal_target" class="col-sm-2 text-right control-label col-form-label">TA. 2</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="thesis_target" id="thesis_target" placeholder="TA. 2" value="<?php echo $data->scons_thesis_target; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" aria-placeholder="Pilih Status">
                                    <option value="">Pilih Status</option>
                                    <?php
                                    foreach ($status as $row) {
                                        if ($data->sstatus_id == $row->sstatus_id) { ?>
                                            <option value="<?php echo $row->sstatus_id; ?>" selected><?php echo $row->sstatus_desc; ?> </option>
                                        <?php
                                        } else { ?>
                                            <option value="<?php echo $row->sstatus_id; ?>"><?php echo $row->sstatus_desc; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-sm-3 text-right control-label col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note" id="note" rows="3" placeholder="Deskripsi"><?php echo $data->scons_note; ?></textarea>
                                <small id="name" class="form-text text-muted">Revisi : Masukkan berkas - berkas yang perlu direvisi</small>
                                <small id="name" class="form-text text-muted">Batal : Masukkan alasan pembatalan berkas</small>
                                <small id="name" class="form-text text-muted">Penjadwalan Konsultasi: Masukkan hal yang perlu dipersiapkan</small>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <input type="text" hidden id="scons_id" name="scons_id" value="<?php echo $data->scons_id ?>">
                            <input type="text" hidden id="submitConsultation" name="submitConsultation" value="submitConsultation">
                            <div class="form-group m-b-0 text-right">
                                <a href="<?php echo site_url() . 'consultation'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>