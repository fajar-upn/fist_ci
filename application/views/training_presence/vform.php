<script src="<?php echo base_url(); ?>assets/ajax.js"></script>

<div class="row">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?php $data->tattd_id == 0 ? 'Tambah' : 'Ubah' ?> Data Presensi </h5>
                <form method="POST" action="<?php echo site_url() ?>Training_Presence/formschedules/" >
                <?php $data->tclass_id ?>
                <div class="form-group">
                        <label class="col-sm-4 form-control-label"> Nama Mahasiswa :</label>                        
                        <?php if($data->tattd_id !=0) { ?>
                            <input type="text" class="form-control required" placeholder="<?php echo $data->mahasiswa?>" id="names"name="names" readonly  > 
                        <?php }else{ ?>
                        <select class="select2 form-control block" multiple="multiple" style="width: 100%; height:55px;" name="name[]" id="name" placeholder="Nama Tentor / Mahasiswa" >
                        
                        <?php foreach ($kelas as $b) { ?>
                              <option value="<?php echo $b->tcontr_id;?>"><?php  echo $b->mahasiswa; ?></option>
                                 <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label" >Tanggal :</label>
                        <input type="text" class="form-control custom-select required" placeholder="Tanggal Training" id="custom-date-start"name="date" value=<?php echo $data->tattd_date; ?> >
                        
                    </div>                                      
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Mulai Pukul :</label>
                        <input type="text" class="form-control required" placeholder="Mulai Pukul" id="time-start"  name="TimeStart" value=<?php echo $data->tattd_timestart; ?>>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 form-control-label">Selesai Pukul :</label>
                        <input type="text" class="form-control required" placeholder="Selesai Pukul" id="time-end"  name="TimeFinish" value=<?php echo $data->tattd_timefinish; ?>>
                    </div>  
                    <div class="form-groupo">
                        <label class="col-sm-4 form-control-label" >Status :</label>
                        <select class="custom-select mb-3 required" id="status" name="status"  value=<?php echo $data->tattd_date; ?>>
                        <?php if($data->tattd_id !=0) { ?>
                            <option  value=<?php echo $data->tattd_status; ?>><?php echo $data->tattd_status; ?></option>                            
                        <?php }else{ ?>
                            <option disabled selected>Pilih Status...</option>
                        <?php } if ($data->tattd_status == "Masuk"){ ?>
                            <option  value="Tanpa Keterangan">Tanpa Keterangan</option>
                        <?php }else if ($data->tattd_status == "Tanpa Keterangan"){ ?>                           
                            <option  value="Masuk">Masuk</option>
                        <?php } else if ($data->tattd_status != "Tanpa Keterangan" && $data->tattd_status != "Masuk" ) { ?>
                            <option  value="Masuk">Masuk</option>
                            <option  value="Tanpa Keterangan">Tanpa Keterangan</option>
                        <?php } ?>
                        </select>                    
                    </div>  
                    <div class="text-right">
                    <!-- <input type="button" class="btn btn-warning" onclick="history.back();" value="Batal"> -->
                    <button type="button" class="btn btn-secondary" onclick="history.back();">Batal</button>
                    <input type="text" hidden id="id_Presence" name="id_Presence" value="<?php echo $data->tattd_id; ?>">
                    <input type="text" hidden id="id_Class" name="id_Class" value="<?php echo $data->tclass_id; ?>">
                    <?php if($data->tattd_id !=0) { ?>
                    <input type="text" hidden id="name" name="name" value="<?php echo $data->tcontr_id; ?>">
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