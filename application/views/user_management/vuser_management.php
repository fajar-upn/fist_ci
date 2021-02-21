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
				<div class="row">
					<h4 class="col card-title">Daftar Pengguna</h4>
					<button type="button" class="col-md-2 btn btn-success mt-10 mb-2 float-left" data-toggle="modal" data-target="#add-user"><i class="fas fa-plus mr-2"></i>Tambah Pengguna</button>
				</div>
				<hr>

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
						<tr class="text-center">
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Email</th>
							<th>Hak Akses</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach($users as $user) : ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $user->uprof_full_name; ?></td>
								<td><?php echo $user->uacc_username; ?></td>
								<td><?php echo $user->uacc_email; ?></td>
								<td class="text-center">
									<?php if ($user->urole_id == 1) : ?>
										<span class="badge badge-primary"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 2) : ?>
										<span class="badge badge-secondary"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 3) : ?>
										<span class="badge badge-success"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 4) : ?>
										<span class="badge badge-danger"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 5) : ?>
										<span class="badge badge-warning"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 6) : ?>
										<span class="badge badge-info"><b><?php echo $user->urole_name; ?></b></span>
									<?php elseif ($user->urole_id == 7) : ?>
										<span class="badge badge-light"><b><?php echo $user->urole_name; ?></b></span>
									<?php endif; ?>
								</td>
								<td class="text-center">
									<?php if ($user->uacc_suspend == 1) : ?>
										<button disabled type="button" class="btn btn-outline-dark rounded-pill " >Suspend</button>
									<?php elseif ($user->uacc_active == 1) : ?>
										<button disabled type="button" class="btn btn-outline-success rounded-pill px-4" >Aktif</button>
									<?php elseif ($user->uacc_active == 0) : ?>
										<button disabled type="button" class="btn btn-outline-danger rounded-pill " >Nonaktif</button>
									<?php endif; ?>
								</td>
								<td class="text-center">
									<button type="button" class="open-modal btn btn-warning"
											title="Ubah"
											data-id="<?php echo $user->uacc_id; ?>"
											data-name="<?php echo $user->uprof_full_name; ?>"
											data-username="<?php echo $user->uacc_username; ?>"
											data-email="<?php echo $user->uacc_email; ?>"
											data-role="<?php echo $user->urole_name; ?>"
											data-value="<?php echo $user->urole_id; ?>"
											data-active="<?php echo $user->uacc_active; ?>"
											data-suspend="<?php echo $user->uacc_suspend; ?>"
											data-csalary="<?php echo number_format($user->uacc_csalary, 2, ",", ".") ?>"
											data-tsalary="<?php echo number_format($user->uacc_tsalary, 2, ",", ".") ?>"
											data-toggle="modal"
											data-tt="tooltip"
											data-target="#edit-user"><i class="fas fa-pencil-alt"></i></button>
								</td>
								<?php $no++; ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<!-- Modal add user -->
				<div id="add-user" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>user_management/insert" method="post">
									<div class="form-group row ">
										<div class="col-12 ">
											<input class="form-control" type="text" required=" " placeholder="Username" name="username">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<input class="form-control" type="email" required=" " placeholder="Email" name="email">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<input id="password" class="form-control" type="password" pattern=".{8,}" title="minimum 8 karakter" required=" " placeholder="Password" name="password">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<select class="form-control" id="role" name="role" onChange="salary()">
												<option value="5" selected> --- Pilih hak akses ---</option>
												<?php foreach ($roles as $role) : ?>
													<option value="<?php echo $role->urole_id; ?>"><?php echo $role->urole_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 input-group-prepend" id="csalary">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 input-group-prepend" id="tsalary">
										</div>
									</div>									
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- Modal Edit User -->
				<div id="edit-user" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Edit untuk akun <span id="modal-name-edit" style="color: red;"></span></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama</label>
											<input id="modal-name" class="form-control" type="text" placeholder="Nama" name="name" value="">
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Username</label>
											<input id="modal-username" class="form-control" type="text" required=" " placeholder="Username" name="username" value="">
										</div>
									</div>

									

									<div class="form-group row">
										<div class="col-12 ">
											<label>Email</label>
											<input id="modal-email" class="form-control" type="email" required=" " placeholder="Email" name="email" value="">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<label>Role</label>
											<select id="select-role" class="form-control" name="role" onChange="salary2()">
												<?php foreach ($roles as $role) : ?>
													<option value="<?php echo $role->urole_id; ?>"><?php echo $role->urole_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									 
									<div class="form-group row ">
										<div class="col-12 input-group-prepend"  id= "dcsalary">											
										</div>
										<div class="col-12 input-group-prepend" id= "dcaddons" >
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-12 input-group-prepend" id= "dtsalary">
										</div>
										<div class="col-12 input-group-prepend" id= "dtaddons" >
										</div>
									</div>					
									
									<div class="row">
										<div class="col-12">
											<label>Ganti Password</label>
											<div class="m-2">
												<button id="btn-change-password" class="btn btn-info"
														data-toggle="modal"
														data-dismiss="modal"
														data-target="#edit-change-password">Ganti password</button>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<label>Status Aktivasi Akun</label>
											<div class="m-2">
												<h6 class="card-subtitle">Ubah status dengan menekan tombol.</h6>
												<div id="button-edit-activate"">
													<!-- Generate link ada di js -->
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<label>Status Suspend Akun</label>
											<div class="m-2">
												<h6 class="card-subtitle">Ubah status dengan menekan tombol.</h6>
												<div id="button-edit-suspend" class="m-b-30">
													<!-- Generate link ada di js -->
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<?php if ($this->session->userdata('role') == 2) : ?><!-- Cek apakah yang login memiliki role developer atau tidak -->
											<label>Status Hapus Akun</label>
											<div class="m-2">
												<h6 class="card-subtitle">Hapus akun dengan menekan tombol. Disarankan untuk tidak menghapus akun karena berpotensi kehilangan data.</h6>
												<div id="button-edit-suspend" class="m-b-30">
													<button id="btn-delete-user" type="button" class="btn btn-danger"
															data-id="<?php echo $user->uacc_id; ?>"
															data-username="<?php echo $user->uacc_username; ?>"
															data-dismiss="modal"
															data-toggle="modal"
															data-target="#modal-delete">Hapus</button>
												</div>
											</div>
											<?php endif; ?>
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- Modal Confirm Delete User -->
				<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Hapus Pengguna</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- generate text ada di js-->
							</div>
							<div class="modal-footer">
								<div class="row d-flex">
									<div class="ml-auto mr-2">
										<a id="btn-confirm-delete" href="" class="btn btn-danger">Hapus</a>
										<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Change Password -->
				<div class="modal fade" id="edit-change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Ganti password</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
								<form id="form-change-password" action="" method="post">
									<div class="row">
										<div class="col">
											<label>Password baru</label>
											<div class="row">
												<div class="col-md-9">
													<input id="input-generate-password" type="text" class="form-control" placeholder="Password baru" name="password" readonly>
												</div>
												<div class="col-md-3">
													<button type="button" id="btn-generate-password" class="btn btn-outline-dark">Generate</button>
												</div>
											</div>
										</div>
									</div>
									<div class="d-flex mt-4">
										<div class="ml-auto">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" id="btn-submit-password" class="btn btn-success" >Ganti password</button>
										</div>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
