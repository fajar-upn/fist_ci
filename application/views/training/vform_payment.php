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
                        <h4 class="card-title"> <?= $data->tpymt_id == 0 ? 'Tambah' : 'Ubah' ?> Data Pembayaran</h4>
                        <form class="mt-4" method="POST" action="<?php echo site_url() . 'Training/form_payment/' . $classId . '/' . $id . '/' . $data->tpymt_id ?>">
                            <div class="form-body">
                                <div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <input type="text" class="form-control mdate" placeholder="Tanggal" name="pymt_date" value="<?php echo $data->tpymt_date ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">No. Kwitansi</label>
                                        <input type="text" class="form-control" placeholder="No. Kwitansi" name="pymt_receipt" value="<?php echo $data->tpymt_receipt ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <input type="text" class="form-control" placeholder="Keterangan" name="pymt_detail" value="<?php echo $data->tpymt_detail ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah</label>
                                        <input type="text" class="form-control" placeholder="Jumlah" name="pymt_amount" value="<?php echo $data->tpymt_amt ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Admin</label>
                                        <input type="text" class="form-control" placeholder="Admin" name="pymt_admin" value="<?php echo $data->tpymt_admin ?>" required>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" hidden id="tpymt_id" name="tpymt_id" value="<?php echo $data->tpymt_id; ?>">
                                    <input type="text" hidden id="tcontr_id" name="tcontr_id" value="<?php echo $id ?>">
                                    <input type="text" hidden id="tclass_id" name="tclass_id" value="<?php echo $classId ?>">
                                    <input type="text" hidden id="submitPayment" name="submitPayment" value="submitPayment">
                                    <div class="form-group m-b-0 text-right">
                                        <a href="<?php echo site_url() . 'training/table_payment/' . $classId . '/' . $id; ?> " type="submit" class="btn btn-secondary waves-effect waves-light">Batal</a>
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