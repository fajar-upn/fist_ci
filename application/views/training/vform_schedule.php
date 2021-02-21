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
                        <h4 class="card-title"> <?= $data->tsched_id == 0 ? 'Tambah' : 'Ubah' ?> Jadwal Training</h4>
                        <form class="mt-4" method="POST" action="<?php echo site_url() . 'Training/form_schedule/' . $data->tsched_tclass_fk . '/' . $data->tsched_id ?>">
                            <div class="form-body">
                                <div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <input type="text" class="form-control mdate" placeholder="Tanggal" name="class_date" value="<?php echo $data->tsched_date ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jam Mulai</label>
                                        <input type="text" class="form-control timepicker" placeholder="Jam Mulai" name="time_start" value="<?php echo $data->tsched_time_start ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jam Selesai</label>
                                        <input type="text" class="form-control timepicker" placeholder="Jam Selesai" name="time_finish" value="<?php echo $data->tsched_time_finish ?>" required>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" hidden name="class_id" value="<?php echo $data->tsched_tclass_fk; ?>">
                                    <input type="text" hidden id="submitSchedule" name="submitSchedule" value="submitSchedule">
                                    <div class="form-group m-b-0 text-right">
                                        <a href="<?php echo site_url() . 'training/table_schedule/' . $data->tsched_tclass_fk; ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
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