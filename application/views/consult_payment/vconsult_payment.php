<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alert-notif"></div>
				<?php endif; ?>
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>consult_payment/form/0" class="btn btn-success"><i class="fa fa-plus"></i> Pembayaran</a>
					</div>
				</div>
				<div class="table-responsive table-striped m-t-15">
					<table class="table product-overview" id="zero_config">
						<thead>
							<tr>
								<th>No.</th>
								<th>Tgl. Pembayaran</th>
								<th>No. Kwitansi</th>
								<th>Kode Mahasiswa</th>
								<th>Nama Mahasiswa</th>
								<th>Jumlah</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($payments as $row): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $row->payment_date ?></td>
								<td><?php echo $row->payment_receipt ?></td>
								<td><?php echo $row->user_code ?></td>
								<td><?php echo $row->user_full_name ?></td>
								<td>
									<?php echo "Rp. "; echo number_format($row->payment_amount, 0,',', '.'); ?>
								</td>
								<td>
									<?php 
										if ($row->payment_keterangan) {
											echo $row->payment_keterangan;
										}
										else {
											echo '-';
										}
									?>
								</td>
								<td>
									<a href="<?php echo base_url() ?>consult_payment/form/<?php echo $row->payment_id?>" class="btn btn-warning btn-sm" title="Ubah" data-toggle="tooltip">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="<?php echo base_url() ?>consult_payment/delete/<?php echo $row->payment_id?>" class="btn btn-danger btn-sm sa-hapus" title="Hapus" data-toggle="tooltip">
										<i class="fas fa-trash"></i>
									</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>