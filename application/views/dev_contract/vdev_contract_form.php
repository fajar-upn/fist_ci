<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
		
						<form action="<?=base_url('dev_contract/form/'. $contract->dcontr_id)?>" method="POST">
							<div class="form-body">
							
                                    <div class="form-group row">
                                        <label for="com1" class="col-sm-3 text-right control-label col-form-label">Nama Agency</label>
                                        <div class="col-sm-9">
                                            <select type="text" class="form-control" name="file_id" placeholder=> 
                                            <option disabled selected>Pilih Agency...</option>
                                            <?php foreach ($file as $row) : ?>
                                            <?php if($row->dfiles_status == 'y') : ?>
                                                <?php if($row->dfiles_id == $contract->dcontr_files_fk) : ?>
                                                    <option selected value='<?php echo $row->dfiles_id ?>'><?php echo $row->dfiles_agency ?></option>
                                                <?php else : ?>
                                                    <option value='<?php echo $row->dfiles_id ?>'><?php echo $row->dfiles_agency ?></option>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="com1" class="col-sm-3 text-right control-label col-form-label">Nama Aplikasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="dcontr_appname" name="dcontr_appname" placeholder="Nama Aplikasi" value="<?php echo $contract->dcontr_appname ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">Tanggal Kontrak</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="dcontr_date" name="dcontr_date" placeholder="Tanggal Kontrak" value="<?php echo $contract->dcontr_date ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">Harga Kontrak</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="dcontr_price" name="dcontr_price" placeholder="Harga Kontrak" value="<?php echo $contract->dcontr_price ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Pilih File</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <input type="file" id="zip" name="zip" class="form-control" value="<?= set_value('zip');?>">
                                                   
                                                </div>
                                                
                                                   
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">Durasi Kontrak</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="dcontr_duration" name="dcontr_duration" placeholder="Durasi Kontrak" value="<?php echo $contract->dcontr_duration ?>">
                                        </div>
                                    </div>
                                
									</div>
									
									<input type="hidden" name="dcontr_id" value="<?php echo $contract->dcontr_id ?>">
									<input type="hidden" name="simpan_data" value="simpan"
							</div>
							<div align="right" class="form-actions m-t-30">
								<input type="button" class="btn btn-danger" onclick="history.back();" value="Batal" name="">
								<button type="submit" class="btn btn-success">Simpan</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>