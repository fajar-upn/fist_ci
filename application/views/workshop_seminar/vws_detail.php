<div class="row">
	<div class="col-md-12">
		<div class="card card-body printableArea">
			<h3><b>Peserta <?php echo $workshop_seminar->ws_type; ?> <?php echo $workshop_seminar->ws_title; ?></b></h3>
			<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alerttype" class="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
					<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
					<span id="alertmessage"></span>
				</div>
			<?php endif; ?>
			<hr>

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
						<tr class="text-center">
							<th>No</th>
							<th>Nama</th>
							<th>Pembayaran</th>
							<th>Tanggal Pembayaran</th>
							<th>No Kuitansi</th>
							<th>Kedatangan</th>
							<?php if ($this->session->userdata('role') != 7): ?>
							<th>Aksi</th>
							<?php endif; ?>
						</tr>
						</thead>
						<tbody>
						<?php $no = 1; ?>
							<?php foreach ($participants as $participant) : ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $participant->wspart_name; ?></td>
								<?php if (strcmp(strtolower($participant->wspart_paid_status),'ya') == 0) : ?>
									<td class="text-center"><span class="badge badge-success">Dibayar</span></td>
									<td class="text-center"><?php echo $participant->wspart_pay_date; ?></td>
									<td class="text-center"><?php echo $participant->wspart_receipt_number; ?></td>
								<?php else: ?>
									<td class="text-center"><span class="badge badge-danger">Belum Dibayar</span></td>
									<td>-</td>
									<td>-</td>
								<?php endif; ?>
								<?php if (strcmp(strtolower($participant->wspart_attendance), "ya") == 0) : ?>
									<td class="text-center"><span class="badge badge-info">Datang</span></td>
								<?php else: ?>
									<td class="text-center"><span class="badge badge-dark">Tidak datang</span></td>
								<?php endif; ?>
								<?php if ($this->session->userdata('role') != 7): ?>
								<td class="text-center">
									<button id="btn-participant-edit" class="btn btn-warning"
											data-ws_id="<?php echo $ws_id; ?>"
											data-id="<?php echo $participant->wspart_id; ?>"
											data-name="<?php echo $participant->wspart_name; ?>"
											data-toggle="modal"
											data-target="#modal-edit">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</td>
								<?php endif; ?>
							</tr>
							<?php $no++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
		</div>
	</div>
</div>

<!-- Modal ubah status kedatangan dan pembayaran -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<label>Ubah status pembayaran</label>
						<div class="m-2">
							<div id="payment-status" class="form-group">
							</div>
						</div>
					</div>
					<div class="col-6">
						<label>Ubah status kedatangan</label>
						<div class="m-2">
							<div id="attendance-status" class="form-group">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
