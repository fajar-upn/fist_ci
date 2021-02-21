<div class="row">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= $obj->scfile_id == 0 ? 'Tambah' : 'Ubah' ?> Data Dokumen</h5>
                <?php echo form_open_multipart('files/form/' . $obj->scfile_id . '/' . $scons_id)  ?>
                <div class="form-group">
                    <label for="inputCategory" class="col-sm-4 form-control-label">Tipe Dokumen</label>
                    <select class="form-control" name="fcategory_id"> //ktmnya diilangin, jadi bisa uploadnya proposal sama ktm aja
                        <?php
                        foreach ($categories as $c) {
                            if ($obj->scfile_fcategory_fk == $c->fcategory_id) { ?>
                                <option value="<?php echo $c->fcategory_id; ?>" selected><?php echo $c->fcategory_name; ?> </option>
                            <?php
                            } else { ?>
                                <?php if ($c->fcategory_id == '1' || $c->fcategory_id == '2') { ?>
                                    <option value="<?php echo $c->fcategory_id; ?>"><?php echo $c->fcategory_name; ?> </option>
                                <?php } ?>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">

                    <label class="col-sm-4 form-control-label">Deskripsi Dokumen :</label>
                    <input type="text" class="form-control" placeholder="Masukkan Keterangan Dokumen" id="item_name" name="scfile_desc" value="<?php echo $obj->scfile_desc; ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputFile" class="col-sm-4 form-control-label">Pilih File</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custome file-input" name="scfile_name">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <!-- <input type="button" class="btn btn-outline-dark waves-effect waves-light" onclick="history.back();" value="Batal"> -->
                    <a href="<?php echo site_url() . 'files/index/' . $scons_id; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                    <input type="text" hidden id="id_files" name="scfile_id" value="<?php echo $obj->scfile_id; ?>">
                    <input type="text" hidden id="submitFiles" name="submitFiles" value="submitFiles">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>