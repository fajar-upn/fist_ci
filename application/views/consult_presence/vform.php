<script src="<?php echo base_url(); ?>assets/ajax.js"></script>

<div class="row">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?php $data->scattd_id == 0 ? 'Tambah' : 'Ubah' ?> Data Presensi Konsultasi</h5>
                <form method="POST" action="<?php echo site_url() ?>Consult_presence/form/" >
                <div class="form-group">
                        <label class="col-sm-4 form-control-label"> Nama Tentor / Mahasiswa:</label>                        
                        <?php if($data->scattd_id !=0) { ?>
                            <input type="text" class="form-control required" placeholder="<?php echo $data->tentor ;echo ' / ' ; echo $data->mahasiswa;?>" id="name"name="name" readonly> 
                        <?php }else{ ?>
                            <select class="select2 form-control custom-select required" style="width: 100%; height:55px;" name="name" id="name" placeholder="Nama Tentor / Mahasiswa" >
                            <option disabled selected>Pilih Mahasiswa...</option>
                        <?php foreach ($kelas as $b) { ?>
                            <option value="<?php echo $b->scclass_id;?>"><?php echo $b->tentor;?> / <?php  echo $b->mahasiswa; ?></option>
                                 <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label" >Tanggal :</label>
                        <input type="text" class="form-control custom-select required" placeholder="Tanggal Konsultasi" id="custom-date-start" name="date" value="<?php echo $data->scattd_date; ?>">
                    </div>                                      
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Mulai Pukul :</label>
                        <input type="text" class="form-control required" placeholder="Mulai Pukul" id="time-start"  name="TimeStart" value="<?php echo $data->scattd_time_start; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Selesai Pukul :</label>
                        <input type="text" class="form-control required" placeholder="Selesai Pukul" id="time-end"  name="TimeFinish" value="<?php echo $data->scattd_time_end; ?>">
                    </div>  
                    <div class="form-groupo">
                        <label class="col-sm-4 form-control-label" >Status :</label>
                        <select class="custom-select mb-3 required" id="status" name="status"  >
                            <?php if($data->scattd_id !=0) {  ?>
                            <option  value="<?php echo $data->scattd_status; ?>"><?php echo $data->scattd_status; ?></option>
                            <?php } else{ ?>
                            <option disabled selected>Pilih Status...</option>
                            <?php } if ($data->scattd_status == "Masuk"){ ?>
                            <option  value="Tanpa Keterangan">Tanpa Keterangan</option>
                        <?php }else if ($data->scattd_status == "Tanpa Keterangan"){ ?>                           
                            <option  value="Masuk">Masuk</option>
                        <?php } else if ($data->scattd_status != "Tanpa Keterangan" && $data->scattd_status != "Masuk" ) { ?>
                            <option  value="Masuk">Masuk</option>
                            <option  value="Tanpa Keterangan">Tanpa Keterangan</option>
                        <?php } ?>
                        </select>                    
                    </div>  
                    <div class="text-right">
                    <!-- <input type="button" class="btn btn-warning" onclick="history.back();" value="Batal"> -->
                    <button type="button" class="btn btn-secondary" onclick="history.back();">Batal</button>
                    <input type="text" hidden id="id_Presence" name="id_Presence" value="<?php echo $data->scattd_id; ?>">
                    <?php if($data->scattd_id !=0) { ?>
                    <input type="text" hidden id="name" name="name" value="<?php echo $data->scclass_id; ?>">
                    <?php } ?>
                    <input type="text" hidden id="submitPresence" name="submitPresence" value="submitPresence">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>      
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>includes/assets/libs/bootstrap/dist/js/bootstrap.js" ></script>
<script src="<?php echo base_url(); ?>includes/assets/libs/jquery/dist/jquery.min.js" ></script>
<script src="<?php echo base_url(); ?>includes/assets/libs/select2/dist/js/select2.full.min.js" ></script>
<script src="<?php echo base_url(); ?>includes/assets/libs/select2/dist/js/select2.min.js" ></script>
<script src="<?php echo base_url(); ?>includes/assets/libs/select2/dist/js/select2.init.js" ></script>