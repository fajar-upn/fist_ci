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
						<h2 class="card-title">Daftar Aplikasi</h2>
					</div>
					<?php
					$role = $this->session->userdata("role");
					if ($role == '2' || $role == '3') : ?>
						<div class="col-md">
							<div class="text-right">
								<button type="button" class="btn btn-success mt-10 mb-2 float-right" data-toggle="modal" data-target="#add-base_app"><i class="fas fa-plus mr-2"></i>Tambah Aplikasi</button>
							</div>
						</div>
					<?php endif ?>
				</div>

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Aplikasi</th>
								<th>Kode Aplikasi</th>
								<?php
								$role = $this->session->userdata("role");
								if ($role == '2' || $role == '3') : ?>
									<th>Aksi</th>
								<?php endif ?>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($application as $row) :
							?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td class="text-center"><?php echo $row->baseapp_name; ?></td>
									<td class="text-center"><?php echo $row->baseapp_code; ?></td>
									<?php
									$role = $this->session->userdata("role");
									if ($role == '2' || $role == '3') : ?>
										<td class="text-center">
											<button id="open-modal" type="button" class="btn btn-warning btn-sm" data-baseapp_id="<?php echo $row->baseapp_id; ?>" data-baseapp_name="<?php echo $row->baseapp_name; ?>" data-baseapp_code="<?php echo $row->baseapp_code; ?>" data-toggle="modal" data-target="#edit-base_app" data-toggle="tooltip" title="Edit aplikasi">
												<i class="fas fa-pencil-alt"></i>
											</button>
											<a href="<?php echo site_url() . 'b_Application/delete/' . $row->baseapp_id ?>" class="btn btn-danger btn-sm sa-delete-bap" data-toggle="tooltip" title="Hapus Aplikasi">
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

				<!-- Modal add base_app -->
				<div id="add-base_app" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Tambah Data Aplikasi</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>b_Application/form/0/" method="POST">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama Aplikasi</label>
											<input class="form-control" type="text" required=" " placeholder="Masukkan Nama Aplikasi" name="baseapp_name">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<label>Kode Aplikasi</label>
											<input class="form-control" type="text" required=" " placeholder="Masukkan Kode Aplikasi" name="baseapp_code">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<input type="text" hidden id="submitApplication" name="submitApplication" value="submitApplication">
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
				<div id="edit-base_app" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Edit Data Aplikasi</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama Aplikasi</label>
											<input id="modal-baseapp_name" class="form-control" type="text" required=" " placeholder="Nama Aplikasi" name="baseapp_name" value="">
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Kode Aplikasi</label>
											<input id="modal-baseapp_code" class="form-control" type="text" required=" " placeholder="Kode Aplikasi" name="baseapp_code" value="">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<input type="text" hidden id="submitApplication" name="submitApplication" value="submitApplication">
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