<div class="card">
	<div class="card-header border-0">
		<h3 class="card-title">PENGATURAN AKUN</h3>
	</div>


	<div class="card-body">
		<!-- Notifikasi -->
		<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
			<div id="alerttype" class="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
				<span id="alertmessage"></span>
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col col-md-6">

				<!-- Change username -->
				<div class="form-group">
					<h5>Username</h5>
					<div class="form-row">
						<div class="col-md-7">
							<input type="text" class="form-control" value="<?php echo $user->uacc_username; ?>" readonly>
						</div>
						<div class="col-md-3">
							<button id="btn-edit-username" class="btn btn-success form-control"
									data-id="<?php echo $user->uacc_id; ?>"
									data-username="<?php echo $user->uacc_username; ?>"
									data-toggle="modal"
									data-target="#modal-edit-username">Ganti username</button>
						</div>
					</div>
				</div>

				<!-- Change email -->
				<div class="form-group">
					<h5>Email</h5>
					<div class="form-row">
						<div class="col-md-7">
							<input type="text" class="form-control" value="<?php echo $user->uacc_email; ?>" readonly>
						</div>
						<div class="col-md-3">
							<button id="btn-edit-email" class="btn btn-success form-control"
									data-id="<?php echo $user->uacc_id; ?>"
									data-username="<?php echo $user->uacc_username; ?>"
									data-toggle="modal"
									data-target="#modal-edit-email">Ganti email</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col col-md-6">
				<!-- Change password -->
				<div class="row">
					<div class="form-group col-md-12">
						<h5>Password</h5>
						<button id="btn-edit-password" class="btn btn-success form-control col-md-3"
								data-id="<?php echo $user->uacc_id; ?>"
								data-toggle="modal"
								data-target="#modal-edit-password">Ganti password</button>
					</div>
				</div><!-- /.row -->
			</div>

		</div>
		<!-- Form for edit profile -->


		<!-- Modal change username -->
		<div class="modal fade" id="modal-edit-username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body m-auto">
						<form id="form-modal-edit-username" action="<?php echo base_url('user_management/update/username/') . $this->session->userdata('id'); ?>" method="post">
							<div class="row">
								<div class="col">
									<label>Username lama</label>
									<input id="modal-username" type="text" class="form-control" value="<?php echo $this->session->userdata('username'); ?>" readonly>
								</div>
								<div class="col">
									<label>Username baru</label>
									<input type="text" class="form-control" placeholder="Username baru" name="username">
								</div>
							</div>
							<div class="d-flex mt-4">
								<div class="ml-auto">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-success">Ganti username</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal change email -->
		<div class="modal fade" id="modal-edit-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ganti Email</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form-modal-edit-username" action="<?php echo base_url('user_management/update/email/') . $this->session->userdata('id'); ?>" method="post">
							<div class="row">
								<div class="col">
									<label>Email lama</label>
									<input type="text" class="form-control" value="<?php echo $this->session->userdata('email'); ?>" readonly>
								</div>
								<div class="col">
									<label>Email baru</label>
									<input type="text" class="form-control" placeholder="Email baru" name="email">
								</div>
							</div>
							<div class="d-flex mt-4">
								<div class="ml-auto">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-success">Ganti email</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal change password -->
		<div class="modal fade" id="modal-edit-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form-modal-edit-username" action="<?php echo base_url('user_management/update/password/') . $this->session->userdata('id'); ?>" method="post">
							<div class="row mb-3">
								<div class="col-md-6">
									<label>Password lama</label>
									<input type="password" class="form-control" placeholder="Password lama" name="recent_password">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<label>Password baru</label>
									<input id="password" type="password" pattern=".{8,}" title="minimum 8 karakter" class="form-control" placeholder="Password baru" name="password">
								</div>
								<div class="col">
									<label>Ulangi password</label>
									<input id="confirm-password" type="password" class="form-control" placeholder="Ulangi password" name="confirm-password">
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-12">
									<span id="message"></span>
								</div>
							</div>
							<div class="d-flex mt-4">
								<div class="ml-auto">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-success">Ganti password</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
