<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title m-b-30"><?php echo $data->payment_id == 0 ? 'Tambah' : 'Ubah' ?> Data Pembayaran</h4>
				<form action="<?php echo base_url('consult_payment/form')?>" method="POST">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label">Kode Mahasiswa</label>
							<div class="form-group">
								<select name="id_contract" class="select2 form-control custom-select" style="width: 100%; height:36px;" required> 
                                    <option selected="" disabled="">Pilih Mahasiswa</option>
                                    <?php foreach($contract as $row) :  ?>
									<?php if ($data->contract_id == $row->contract_id) : ?>
									<option value=" <?php echo $row->contract_id ?>" selected>
										<?php echo $row->user_code . ' - ' . $row->user_fullname; ?>
									</option>
									<?php else : ?>
									<option value=" <?php echo $row->contract_id ?>">
										<?php echo $row->user_code . ' - ' . $row->user_fullname; ?>
									</option>
									<?php endif ?>
									<?php endforeach ?>
                                </select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">No. Kwitansi</label>
							<input name="receipt" type="text" class="form-control" placeholder="No. Kwitansi" value="<?php echo $data->payment_receipt ?>" required>
						</div>
						<div class="form-group">
							<label class="control-label">Tanggal Pembayaran</label>
							<input name="date" type="text" id="datepicker-autoclose" class="form-control" placeholder="tttt-bb-hh" value="<?php echo $data->payment_date?>" required>
						</div>
						<div class="form-group">
							<label class="control-label">Jumlah Pembayaran</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Rp.</span>
								</div>
								<input name="fee" type="number" value="<?php echo $data->payment_amount?>" class="form-control" placeholder="Jumlah Pembayaran" aria-label="price" aria-describedby="basic-addon1" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Keterangan</label>
							<input name="keterangan" type="text" class="form-control" placeholder="Keterangan" value="<?php echo $data->payment_keterangan ?>">
						</div>
						<input type="hidden" name="payment_id" value="<?php echo $data->payment_id ?>">
						<input type="hidden" name="simpan_data" value="simpan">
					</div>
					<div align="right" class="form-actions m-t-30">
						<a href="<?php echo base_url() ?>consult_payment" type="button" class="btn btn-secondary waves-effect">Batal</a>
						<button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>