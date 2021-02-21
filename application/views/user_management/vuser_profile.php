<div class="card">
	<div class="card-header border-0">
		<h3 class="card-title">PROFIL ANDA</h3>
	</div>

	<div class="card-body">
		<!-- Form for edit profile -->
		<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
			<div id="alerttype" class="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
				<span id="alertmessage"></span>
			</div>
		<?php endif; ?>
		<form action="<?php echo base_url('user_management/update/profile/') . $user->uprof_uacc_fk; ?>" method="POST">
			<div class="row">

				<div class="col col-md-6">
					<div class="row">
						<div class="form-group col-md-10">
							<label>Nama Lengkap</label>
							<input type="text" value="<?php echo $user->uprof_full_name; ?>" class="form-control" name="name" placeholder="Nama lengkap">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label>Jenis Kelamin</label>
							<select id="gender" class="form-control" name="gender">
								<?php foreach ($gender as $value) : ?>
									<?php if (strcmp($value, $user->uprof_gender) == 0) : ?>
										<option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
									<?php else : ?>
										<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
							<label>Tempat dan Tanggal Lahir</label>
							<div class="input-group">
								<input type="text" value="<?php echo $user->uprof_birth_place; ?>" class="form-control col-md-6" name="birth_place" placeholder="Tempat lahir">
								<input type="text" value="<?php echo $user->uprof_birth_date; ?>" class="form-control" placeholder="2017-06-04" id="mdate" name="birth_date">
								<div class="input-group-append">
									<span class="input-group-text"><i class="icon-calender"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
							<label>Institusi</label>
							<input type="text" value="<?php echo $user->uprof_institution; ?>" class="form-control" name="institution" placeholder="Institusi">
						</div>
					</div>
				</div>
				<div class="col col-md-6">
					<div class="row">
						<div class="form-group col-md-6">
							<label>Nomor telepon</label>
							<input type="text" value="<?php echo $user->uprof_phone; ?>" class="form-control" name="phone" placeholder="Nomor Telepon">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
							<label>Alamat</label>
							<textarea class="form-control" rows="4" name="address"><?php echo $user->uprof_address; ?></textarea>
						</div>
					</div>
					<div class="form-group col-md-3">
						<button type="submit" class="btn btn-success form-control">Update Profile</button>
					</div>
				</div>
			</div>
		</form>
		<!-- /.form -->
	</div>
	<!-- /.col-md-6 -->
</div>
