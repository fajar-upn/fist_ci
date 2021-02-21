<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
						<span id="alertmessage"></span>
					</div>
				<?php endif; ?>

				<?php if ($this->session->userdata('role') != 7): ?>
				<div class="row">
					<h4 class="col card-title">Daftar Kegiatan Seminar dan Workshop</h4>
					<a href="<?php echo base_url('workshop_seminar/add'); ?>" class="col-md-2 btn btn-success mt-10 mb-2 float-left"><i class="fas fa-plus mr-2"></i>Tambah Kegiatan</a>
				</div>
				<hr>
				<?php endif; ?>

				<td class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
						<tr class="text-center">
							<th>No</th>
							<th>Nama Kegiatan</th>
							<th>Tipe</th>
							<th>Waktu</th>
							<th>Tempat</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($workshop_seminars as $workshop_seminar) : ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $workshop_seminar->ws_title; ?></td>
								<td class="text-center"><?php echo $workshop_seminar->ws_type; ?></td>
								<td class="text-center">
									<div class="">
										<?php if ($workshop_seminar->ws_date_start == $workshop_seminar->ws_date_done) :?>
											<span><?php echo $workshop_seminar->ws_date_start; ?></span>
										<?php else : ?>
											<span><?php echo $workshop_seminar->ws_date_start; ?> - <?php echo $workshop_seminar->ws_date_done; ?></span>
										<?php endif; ?>
									</div>
									<div class="row">

									</div>
								</td>
								<td class="text-center"><?php echo $workshop_seminar->ws_place; ?></td>
								<?php if ($workshop_seminar->ws_active == 'Y') : ?>
									<td class="text-center"><span class="badge badge-success">Aktif</span></td>
								<?php else: ?>
									<td class="text-center"><span class="badge badge-info">Nonaktif</span></td>
								<?php endif; ?>
								<?php if ($this->session->userdata('role') == 7): ?>
									<td class="text-center">
										<a href="<?php echo base_url('workshop_seminar/detail/') . $workshop_seminar->ws_id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Detail peserta"><i class="far fa-list-alt"></i></a>
									</td>
								<?php else: ?>
								<td class="text-center">
									<a href="<?php echo base_url('workshop_seminar/detail/') . $workshop_seminar->ws_id; ?>" class="btn btn-primary" data-toggle="tooltip" title="Detail peserta"><i class="far fa-list-alt"></i></a>
									<?php if ($workshop_seminar->ws_active == 'Y') : ?>
										<span data-toggle="tooltip" title="Tidak dapat mengedit workshop/seminar">
											<a href="<?php echo base_url('workshop_seminar/edit/') . $workshop_seminar->ws_id; ?>" class="btn btn-warning" style="pointer-events: none"><i class="fas fa-pencil-alt"></i></a>
										</span>
									<?php else : ?>
										<a href="<?php echo base_url('workshop_seminar/edit/') . $workshop_seminar->ws_id; ?>" class="btn btn-warning" data-toggle="tooltip" title="Edit workshop/seminar"><i class="fas fa-pencil-alt"></i></a>
									<?php endif; ?>
									<a href="<?php echo base_url('workshop_seminar/registration/') . $workshop_seminar->ws_id; ?>" class="btn btn-secondary" data-toggle="tooltip" title="Preview"><i class="fas fa-eye"></i></a>
									<?php if ($workshop_seminar->ws_active == 'Y') : ?>
										<a href="<?php echo base_url('workshop_seminar/deactivate_worksem/') . $workshop_seminar->ws_id; ?>" class="btn btn-danger sa-nonactive-ws" data-toggle="tooltip" title="Nonaktifkan workshop/seminar"><i class="fas fa-times"></i></a>
									<?php else : ?>
										<a href="<?php echo base_url('workshop_seminar/activate_worksem/') . $workshop_seminar->ws_id; ?>" class="btn btn-success sa-active-ws" data-toggle="tooltip" title="Aktifkan workshop/seminar"><i class="fas fa-check"></i></a>
									<?php endif; ?>
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
</div>
