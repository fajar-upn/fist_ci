<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Penjadwalan Konsultasi Berkas</h2>
                    <h5 class="card-subtitle">Mohon lengkapi penjadwalan dibawah dengan <code>baik</code> dan <code>benar</code>.</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $data->scons_id != 0 ? 'Tambah' : 'Ubah' ?> Kebutuhan penjadwalan</h4>
                    <form method="POST" action="<?php echo site_url() ?>consultation/schedule/<?php echo $data->scons_id; ?> ">
                        <div class="form-group row">
                            <label for="graduationtarget" class="col-sm-3 text-right control-label col-form-label">Tanggal Penjadwalan</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="schedule" id="schedule" placeholder="schedule" value="<?php echo $data->scons_consultation_date; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graduationtarget" class="col-sm-3 text-right control-label col-form-label">Catatan Penjadwalan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note_schedule" id="note_schedule" rows="3" placeholder="catatan penjadwalan"><?php echo $data->scons_note_schedule; ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <input type="text" hidden id="scons_id" name="scons_id" value="<?php echo $data->scons_id ?>">
                            <input type="text" hidden id="submitSchedule" name="submitSchedule" value="submitSchedule">
                            <div class="form-group m-b-0 text-right">
                                <a href="<?php echo site_url() . 'consultation'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Kirim </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>