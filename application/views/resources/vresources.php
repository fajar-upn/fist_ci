<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="alert p-3 mb-2">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						<h5 id="alerttitle"><i id="alerticon" class="mx-1"></i></h5>
						<span id="alertmessage"></span>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md">
						<h2 class="card-title">Daftar Resources</h2>
					</div>
					<?php
					$role = $this->session->userdata("role");
					if ($role == '2' || $role == '3') : ?>
						<div class="col-md">
							<div class="text-right">
								<button type="button" class="btn btn-success mt-10 mb-2 float-right" data-toggle="modal" data-target="#add-resource"><i class="fas fa-plus mr-2"></i>Tambah Resources</button>
							</div>
						</div>
					<?php endif ?>
				</div>

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Resources</th>
								<th>Kode Resources</th>
								<?php
								$role = $this->session->userdata("role");
								if ($role == '2' || $role == '3') : ?>
									<th>Aksi</th>
								<?php endif ?>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($resources as $row) :
								$delMessage = "Apakah anda yakin ingin menghapus Resources : " . $row->res_name . " ?";
							?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td class="text-center"><?php echo $row->res_name; ?></td>
									<td class="text-center"><?php echo $row->res_code; ?></td>
									<?php
									$role = $this->session->userdata("role");
									if ($role == '2' || $role == '3') : ?>
										<td class="text-center">
											<button id="open-modal" type="button" class="btn btn-warning btn-sm" data-res_id="<?php echo $row->res_id; ?>" data-res_name="<?php echo $row->res_name; ?>" data-res_code="<?php echo $row->res_code; ?>" data-toggle="modal" data-target="#edit-resource" data-toggle="tooltip" title="Edit Resource">
												<i class="fas fa-pencil-alt"></i>
											</button>
											<a href="<?php echo site_url() . 'resources/delete/' . $row->res_id ?>" class="btn btn-danger btn-sm sa-delete-res" data-toggle="tooltip" title="Hapus Resource">
												<i class="fas fa-trash"></i>
											</a>

										</td>
									<?php endif ?>
									<?php $no++; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<!-- Modal add resource -->
				<div id="add-resource" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Tambah Resource</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>resources/form/0/" method="POST">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama Resource</label>
											<input class="form-control" type="text" required=" " placeholder="Masukkan Nama Resource" name="res_name">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<label>Kode Resource</label>
											<input class="form-control" type="text" required=" " placeholder="Masukkan Kode Resource" name="res_code">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<input type="text" hidden id="submitResources" name="submitResources" value="submitResources">
											<button type="button" class="btn btn-outline-dark waves-effect" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success waves-effect">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- Modal Edit base_app -->
				<div id="edit-resource" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Edit Data Resource</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama Resource</label>
											<input id="modal-res_name" class="form-control" type="text" required=" " placeholder="Nama Resource" name="res_name" value="">
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Kode Resource</label>
											<input id="modal-res_code" class="form-control" type="text" required=" " placeholder="Kode Resource" name="res_code" value="">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<input type="text" hidden id="submitResources" name="submitResources" value="submitResources">
											<button type="button" class="btn btn-outline-dark waves-effect" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success waves-effect">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->

				</div>
			</div>
		</div>
	</div>
</div>