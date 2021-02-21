<div class="col-12">
	<div class="card">
		<div class="card-body">
		<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alert-notif"></div>
				<?php endif; ?>
			<h4 class="card-title">Kontrak</h4>

		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="zero_config" class="table table-striped table-bordered">

					<thead>
						<tr>
							<th>No.</th>
							<th scope="col">Kode Peserta</th>
							<th scope="col">Nama Peserta</th>
							<th scope="col">Judul Skripsi</th>
							<th scope="col">Paket</th>
							<th scope="col">Harga Paket</th>
							<th scope="col">Biaya Tambahan</th>
							<th scope="col">Diskon</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>

						</tr>
					</thead>
					<tbody>

						<?php 
						$i = 1;
						foreach($contract as $row) { 
							?>
							<tr>

								<td><?php echo $i; $i++;?></td>
								<td><?php echo $row->user_code; ?></td>
								<td><?php echo $row->user_fullname; ?></td>
								<td><?php echo $row->thesis_title; ?></td>

								<?php 
								if($row->contract_id){ ?>
								<td><?php echo $row->package_code; ?></td>
								<td><?php echo "Rp"; echo number_format($row->package_price, 0,',', '.'); ?></td>
								<td><?php echo "Rp"; echo number_format($row->add_fee_total, 0,',', '.'); ?></td>
								<td><?php echo "Rp"; echo number_format($row->contract_discount, 0,',', '.'); ?></td>
								<?php } 
								else{ ?>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<!-- user yang belum mengisi tabel profil tidak bisa mendaftarkan kontrak -->
								<?php } ?>
								<?php 
								switch ($row->consultation_status_id) {
									case 4:?>
									<td class="text-center">
										<button disabled class="btn-outline-info rounded-pill px-3">
										Belum Dibuat
										</button>
									</td>
									<td class="text-center">
										<a href="<?=base_url('consult_contract/submit/') . $row->consultation_id?>" class="btn btn-success btn-sm" title="Submit Kontrak" data-toggle="tooltip">
															<i class="fa fa-file"></i>
										</a>
									</td>
									<?php
									break;
									case 5:
									if($row->contract_end == 1)
										{ ?>
									<td class="text-center">
										<button disabled class="btn-outline-secondary rounded-pill px-3">
										Berakhir
										</button>
									</td>
									<td class="text-center">
										<div class="button-group">
											<a href="<?=base_url('consult_contract/detail/') . $row->contract_id?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Detail" data-toggle="tooltip">
												<i class="fas fa-eye"></i>
											</a>
									</td>
										<?php } 
										
										//else if($row->contract_end == 0 && )

									else 
										{ 
											if($row->contract_cancel == 1){ ?>
												<td class="text-center">
													<button disabled class="btn-outline-danger rounded-pill px-3">
													Dibatalkan
													</button>
												</td>
												<td class="text-center">
													<a href="<?=base_url('consult_contract/detail/') . $row->contract_id?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Lihat Detail" data-toggle="tooltip">
														<i class="fas fa-eye"></i>
													</a>
												</td>	
												<?php } 
											else{
												if($row->total_attendances >= 1) { ?>
													<td class="text-center">
														<button disabled class="btn-outline-success rounded-pill px-3">
														Berjalan
														</button>
													</td>
													<td class="text-center">
														<a href="<?=base_url('consult_contract/detail/') . $row->contract_id?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Lihat Detail" data-toggle="tooltip">
															<i class="fas fa-eye"></i>
														</a>
														<a href="<?=base_url('consult_contract/end/'). $row->contract_id?>" class="btn btn-sm waves-effect waves-light btn-danger" title="Akhiri Kontrak" data-toggle="tooltip">
															<i class="fa fa-ban"></i>
														</a> 
													</td> 

												<?php } 
												else { ?>
													<td class="text-center">
														<button disabled class="btn-outline-warning rounded-pill px-3">
														Booked
														</button>
													</td>
													<td class="text-center">
														<a href="<?=base_url('consult_contract/detail/') . $row->contract_id?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Lihat Detail" data-toggle="tooltip">
															<i class="fas fa-eye"></i>
														</a>
													</td>	
													<?php } 
												 	}?>
										
										<?php }
										break;
									}
								}	 ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>