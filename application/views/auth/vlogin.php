<div class="auth-box">
	<div id="loginform">
		<div class="logo">
			<span class="db"><img class="w-25 mb-3" src="<?php  echo base_url('includes/assets/images/fist-logo.png') ?>" alt="logo" /></span>
			<h4 class="font-medium m-b-25">Masuk</h4>
		</div>
		<!-- Form -->
		<div class="row">
			<div class="col-12">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="py-3">
						<h5 id="alerttitle"></h5>
						<span id="alertmessage"></span>
						<i id="alerticon"></i>
					</div>
				<?php endif; ?>
				<form class="form-horizontal m-t-20" id="loginform" action="<?php echo base_url('auth/login'); ?>" method="post">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
						</div>
						<input type="text" class="form-control form-control-lg" placeholder="Username atau Email" aria-label="Username" aria-describedby="basic-addon1" name="account">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
						</div>
						<input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Ingat saya</label>
								<a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i>Lupa password?</a>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<div class="col-xs-12 p-b-20">
							<button class="btn btn-block btn-lg btn-info" type="submit">Masuk</button>
						</div>
					</div>
					<div class="form-group m-b-0 m-t-10">
						<div class="col-sm-12 text-center">
							Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>" class="text-info m-l-5"><b>Daftar Sekarang!</b></a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Form for send email to reset password -->
	<div id="recoverform">
		<div class="logo">
			<span class="db"><img class="w-25 mb-3" src="<?php echo base_url('includes/assets/images/fist-logo.png') ?>" alt="logo" /></span>
			<h5 class="font-medium m-b-20">Reset Password</h5>
			<span>Masukkan email Anda dan instruksi reset password akan dikirim!</span>
		</div>
		<div class="row m-t-20">
			<!-- Form -->
			<form class="col-12" action="<?php echo base_url('auth/email_set_password'); ?>" method="post">
				<!-- email -->
				<div class="form-group row">
					<div class="col-12">
						<input class="form-control form-control-lg" type="email" required="" placeholder="Email" name="email">
					</div>
				</div>
				<!-- password -->
				<div class="row m-t-20">
					<div class="col-12">
						<button class="btn btn-block btn-lg btn-warning" type="submit" name="action">Reset Password</button>
						<a class="btn btn-block btn-lg btn-info" href="<?php echo base_url('auth')?>">Kembali</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
