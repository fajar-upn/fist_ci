<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alert-notif"></div>
				<?php endif; ?>
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>dev_module/form/0" class="btn btn-success"><i class="fa fa-plus"></i> Modul</a>
					</div>
				</div>
				<div class="table-responsive table-striped m-t-15">
					<table class="table product-overview" id="zero_config">
						<thead>
							<tr>
								<th></th>
								<th>Tingkat Kesulitan</th>
								<th>Estimasi Harga</th>
								<th>Estimasi Waktu</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							foreach ($cek as $row): ?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->dmodules_difficulties ?></td>
								<td><?php echo rupiah($row->dmodules_lowest_price) . ' - ' .  rupiah($row->dmodules_highest_price) ?></td>
								<td><?php echo $row->dmodules_shortestdur . ' - ' . $row->dmodules_longestdur . ' bulan' ?></td>
								<td>
									<a href="<?php echo base_url() ?>dev_module/form/<?php echo $row->dmodules_id?>" class="btn btn-warning btn-sm" title="Ubah" data-toggle="tooltip">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="<?php echo base_url() ?>dev_module/delete/<?php echo $row->dmodules_id?>" class="btn btn-danger btn-sm sa-hapus" title="Hapus" data-toggle="tooltip">
										<i class="fas fa-trash"></i>
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