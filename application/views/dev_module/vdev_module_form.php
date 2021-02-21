<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h4 class="card-title m-b-30"><?php echo $module->dmodules_id == 0 ? 'Tambah' : 'Ubah' ?> Modul Development</h4>
						<form action="<?=base_url('dev_module/form')?>" method="POST">
							<div class="form-body">

									<div>
										<div class="form-group">
											<label class="control-label">Tingkat Kesulitan</label>
											<input required name="dmodules_difficulties" type="text" id="dmodules_difficulties" class="form-control" placeholder="Tingkat Kesulitan" value="<?php echo $module->dmodules_difficulties ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Harga Terendah</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Rp.</span>
											</div>
											<input name="dmodules_lowest_price" id="low_price" type="number" value="<?php echo $module->dmodules_lowest_price ?>" class="form-control" placeholder="Harga Terendah" aria-label="price" aria-describedby="basic-addon1" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Harga Tertinggi</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Rp.</span>
											</div>
											<input name="dmodules_highest_price" id="high_price" type="number" value="<?php echo $module->dmodules_highest_price ?>" class="form-control" placeholder="Harga Tertinggi" aria-label="price" aria-describedby="basic-addon1" required>
										</div>
									</div>
									<div>
										<div class="form-group">
											<label class="control-label">Waktu Pengerjaan Tercepat</label>
											<input required name="dmodules_shortestdur" type="number" id="short_duration" class="form-control" placeholder="Pengerjaan Tercepat" value="<?php echo $module->dmodules_shortestdur ?>">
										</div>
									</div>

									<div>
										<div class="form-group">
											<label class="control-label">Waktu Pengerjaan Terlama</label>
											<input required name="dmodules_longestdur" type="number" id="long_duration" class="form-control" placeholder="Pengerjaan Terlama" value="<?php echo $module->dmodules_longestdur ?>">
										</div>
									</div>
									
									<input type="hidden" name="dmodules_id" value="<?php echo $module->dmodules_id ?>">
									<input type="hidden" name="simpan_data" value="simpan">
							</div>
							<div align="right" class="form-actions m-t-30">
							<a href="<?php echo base_url() ?>dev_module" type="button" class="btn btn-secondary waves-effect">Batal</a>
								<button type="submit" class="btn btn-success">Simpan</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>