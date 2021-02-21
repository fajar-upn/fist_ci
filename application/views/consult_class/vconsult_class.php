<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alert-notif"></div>
				<?php endif; ?>
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#insertModal"><i class="fa fa-plus"></i> Kelas Konsultasi</button>
					</div>
				</div>
				<div class="table-responsive table-striped m-t-15">
					<table class="table product-overview" id="zero_config">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Mhs.</th>
								<th>Nama Mahasiswa</th>
								<th>Nama Tentor</th>
								<th>Total Sesi</th>
								<th>Total Jadwal</th>
								<th>Total Presensi</th>
								<th>Status Kontrak</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($classes as $row): ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $row->client_code ?></td>
								<td><?php echo $row->client_name ?></td>
								<td><?php echo $row->mentor_name ?></td>
								<td><?php echo $row->total_sesion + $row->total_add_session ?></td>
								<!-- untuk kolom Dijadwalkan -->
								<?php if ($row->total_schedule == null): ?>
								<td>0</td>
								<?php else: ?>
								<td><?php echo $row->total_schedule ?></td>
								<?php endif ?>
								<!-- untuk kolom total presensi -->
								<?php if ($row->total_attendances == null): ?>
								<td>0</td>
								<?php else: ?>
								<td><?php echo $row->total_attendances ?></td>
								<?php endif ?>
								<!-- untuk kolom status kontrak -->
								<?php if ($row->contract_end == 1): ?>
								<td class="text-center">
									<button disabled class="btn-outline-secondary rounded-pill px-3">
									Berakhir
									</button>
								</td>
								<td class="text-center">-</td>
								<?php elseif ($row->contract_cancel == 1): ?>
								<td class="text-center">
									<button disabled class="btn-outline-danger rounded-pill px-3">
									Dibatalkan
									</button>
								</td>
								<td class="text-center">-</td>
								<?php elseif ($row->total_attendances == null): ?>
								<td class="text-center">
									<button disabled class="btn-outline-warning rounded-pill px-3">
									Booked
									</button>
								</td>
									<?php if ($row->total_schedule == null): ?>
									<td class="text-center">
										<a href="#" class="btn btn-sm waves-effect waves-light btn-warning button-edit" title="Ubah" data-toggle="tooltip" data-contractID="<?php echo $row->contract_id ?>" data-mentorID="<?php echo $row->mentor_id ?>" data-optionSelected="<?php echo $row->client_code . ' - ' . $row->client_name ?>" data-classID="<?php echo $row->class_id ?>">
											<i class="fas fa-pencil-alt"></i>
										</a>
										<a href="<?php echo base_url() ?>consult_class/delete/<?php echo $row->class_id ?>" class="btn btn-sm waves-effect waves-light btn-danger sa-hapus" title="Hapus" data-toggle="tooltip">
											<i class="fas fa-trash"></i>
										</a>
									</td>
									<?php else: ?>
									<td class="text-center">-</td>
									<?php endif ?>
								<?php else: ?>
								<td class="text-center">
									<button disabled class="btn-outline-success rounded-pill px-3">
									Berjalan	
									</button>
								</td>
								<td class="text-center">-</td>
								<?php endif ?>
							</tr>							
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Tambah Data-->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="insertModalLabel1">Tambah Kelas Konsultasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="<?php echo base_url() ?>consult_class/save">
				<div class="modal-body">
					<div class="form-group">
						<label for="contract_id">Mahasiswa</label>
					    <select class="form-control" name="contract_id" required>
					    	<option selected disabled>Pilih mahasiswa...</option>
					    	<?php foreach ($unassigned_classes as $row): ?>
					    	<option value="<?php echo $row->contract_id ?>"><?php echo ($row->client_code . ' - ' . $row->client_name) ?></option>
					    	<?php endforeach ?>
					    </select>
					</div>
					<div class="form-group">
						<label for="mentor_id">Tentor</label>
					    <select class="form-control" name="mentor_id" required>
					    	<option selected disabled>Pilih tentor...</option>
					    	<?php foreach ($mentor as $row): ?>
						    	<?php if ($row->uacc_active == 1 && $row->uacc_suspend == 0): ?>
							    <option value="<?php echo $row->uacc_id ?>"><?php echo $row->uprof_full_name ?></option>
							    <?php endif ?>
					    	<?php endforeach ?>
					    </select>
					</div> 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End modal -->
<!-- MODAL Untuk Edit -->
<div class="modal none-border" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Kelas Konsultasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="POST" action="<?php echo base_url() ?>consult_class/save">
				<div class="modal-body">
					<div class="form-group">
						<label for="contract_id">Mahasiswa</label>
					    <select class="form-control" name="contract_id" id="selectContract" required>
					    </select>
					</div>
					<div class="form-group">
						<label for="mentor_id">Tentor</label>
					    <select class="form-control" name="mentor_id" id="selectMentor" required>
					    </select>
					</div>
					<input type="hidden" name="class_id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL -->