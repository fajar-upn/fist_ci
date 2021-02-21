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
				<h4 class="card-title">Data Jawaban Seminar & Workshop</h4>
				<div class="form-group">
					<select class="select2 form-control custom-select" style="width: 100%; height: 36px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
						<option value="<?php echo base_url() . 'feedback_management/data_worksem/0'; ?>" selected disabled>Pilih</option>
						<?php foreach ($title as $row) : ?>
							<option <?= $id_select == $row->ws_id ? 'selected' : NULL ?> value="<?php echo base_url() . 'feedback_management/data_worksem/' . $row->ws_id; ?>"><?= $row->ws_title ?></option>
						<?php endforeach; ?>
					</select>
				</div>

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
									<td><?php echo $list->wsfans_answer; ?></td>
									<td class="text-center">
										<a href="<?= base_url('feedback_management/detail_worksem/' . $list->wsfans_wsfeed_fk) ?>" class="btn waves-effect waves-light btn-primary" title="Detail" data-toggle="tooltip"><i class="far fa-list-alt"></i></a>
										<?php if ($user_role == 3) { // Kondisi untuk jika yang login adalah role admin 
										?>
											<a href="<?php echo base_url('feedback_management/delete_answer/worksem/' . $list->wsfans_wsfeed_fk) ?>" class="btn waves-effect waves-light btn-danger text-inverse delete" title="Hapus" data-toggle="tooltip">
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