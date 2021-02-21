<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Pembayaran Develop</h4>
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>dev_payment/form/0" class="btn btn-success">Tambah</a>
					</div>
				</div>
				<div class="table-responsive table-striped m-t-15">
					<table class="table product-overview" id="zero_config">
						<thead>
							<tr>
								<th>No.</th>
								<th>Tgl. Pembayaran</th>
								<th>No. Kwitansi</th>
								<th>Nama Agensi</th>
								<th>Jumlah</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							foreach ($payments as $row): ?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->dpymt_date ?></td>
								<td><?php echo $row->dpymt_receipt ?></td>
								<td><?php echo $row->dfiles_agency ?></td>
								<td>
									<?php echo "Rp"; echo number_format($row->dpymt_amt, 0,',', '.'); ?>
								<td>
									<a href="<?php echo base_url() ?>dev_payment/form/<?php echo $row->dpymt_id?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
										<i class="fa fa-edit"></i>
									</a>
									<a href="<?php echo base_url() ?>dev_payment/delete/<?php echo $row->dpymt_id?>" class="btn btn-danger btn-sm" title="Hapus" data-toggle="tooltip" alt="alert" id="sa-params">
										<i class="fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
							<?php 
							$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>