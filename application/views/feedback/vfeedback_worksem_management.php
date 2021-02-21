<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
						<span id="alertmessage"></span>
					</div>
				<?php endif; ?>
				<div class="row">
					<h4 class="col card-title">Daftar Kegiatan Seminar dan Workshop</h4>
				</div>
				<hr>

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Kegiatan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($workshop_seminars as $workshop_seminar) : ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $workshop_seminar->ws_title; ?></td>
									<td class="text-center">
										<a href="<?= base_url('feedback_management/workshop_seminar/' . $workshop_seminar->ws_id) ?>" class="btn waves-effect waves-light btn-warning" data-toggle="tooltip" title="Ubah">
											<i class="fas fa-pencil-alt"></i>
										</a>
									</td>
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