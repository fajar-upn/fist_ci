<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h4 class="card-title m-b-30"><?php echo $data->dpymt_id == 0 ? 'Tambah' : 'Ubah' ?> Data Pembayaran</h4>
						<form action="<?=base_url('dev_payment/form')?>" method="POST">
							<div class="form-body">
									<div>
										<div class="form-group">
											<label class="control-label">Nama Agency</label>
											<div class="form-group">
												<select name="id_contract" class="select2 form-control custom-select" style="width: 100%; height:36px;" required> 
													<option selected="" disabled="">Pilih Agency...</option>
													<?php foreach($contract as $row) :  ?>
													<?php if ($data->dpymt_dcontr_fk == $row->dcontr_id) : ?>
														<option selected value="<?php echo $row->dcontr_id ?>"><?php echo $row->dfiles_agency ?></option>
													<?php else : ?>
														<option value="<?php echo $row->dcontr_id ?>"><?php echo $row->dfiles_agency ?></option>
													<?php endif ?>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<div>
										<div class="form-group">
											<label class="control-label">No. Kwitansi</label>
											<input name="receipt" type="text" id="firstName" class="form-control" placeholder="No. Kwitansi" value="<?php echo $data->dpymt_receipt ?>">
										</div>
									</div>
									<div>
										<div class="form-group">
											<label class="control-label">Tanggal Pembayaran</label>
											<input name="date" type="date" id="lastName" class="form-control" placeholder="tttt-bb-hh" value="<?php echo $data->dpymt_date?>">
										</div>
									</div>
									<div>
										<div class="form-group">
											<label class="control-label">Jumlah Pembayaran</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">Rp.</span>
												</div>
												<input name="fee" type="number" value="<?php echo $data->dpymt_amt?>" class="form-control" placeholder="Jumlah Pembayaran" aria-label="price" aria-describedby="basic-addon1">
											</div>
										</div>
									</div>
									<input type="hidden" name="payment_id" value="<?php echo $data->dpymt_id ?>">
									<input type="hidden" name="simpan_data" value="simpan">
							</div>
							<div align="right" class="form-actions m-t-30">
								<input type="button" class="btn btn-outline-dark" onclick="history.back();" value="Batal" name="">
								<button type="submit" class="btn btn-success">Simpan</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>