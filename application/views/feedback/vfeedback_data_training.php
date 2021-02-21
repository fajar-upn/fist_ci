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
				<h4 class="card-title">Data Jawaban Pelatihan</h4>
				<hr>
				<div class="table-responsive">

					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($lists as $list) : ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $list->tfans_answer; ?></td>
									<td class="text-center">
										<a href="<?= base_url('feedback_management/detail_training/' . $list->tfans_tfeed_fk) ?>" title="Detail" data-toggle="tooltip" class="btn waves-effect waves-light btn-primary"><i class="far fa-list-alt"></i></a>
										<?php if ($user_role == 3) { // Kondisi untuk jika yang login adalah role admin 
										?>
											<a href="<?php echo base_url('feedback_management/delete_answer/training/' . $list->tfans_tfeed_fk) ?>" class="btn waves-effect waves-light btn-danger text-inverse delete" title="Hapus" data-toggle="tooltip">
												<i class="fa fa-trash"></i>
											</a>
										<?php } ?>
									</td>
									<?php $no++; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>