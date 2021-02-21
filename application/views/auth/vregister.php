<div class="auth-box">
	<div>
		<div class="logo">
			<span class="db"><img class="w-25 mb-3" src="<?php  echo base_url('includes/assets/images/fist-logo.png') ?>" alt="logo" /></span>
			<h5 class="font-medium m-b-20">Daftar ke Website Fist Effect</h5>
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
				<form class="form-horizontal m-t-20" action="<?php echo base_url('auth/register_account'); ?>" method="post">
					<div class="form-group row ">
						<div class="col-12 ">
							<input class="form-control form-control-lg" type="text" required=" " placeholder="Username" name="username">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12 ">
							<input class="form-control form-control-lg" type="email" required=" " placeholder="Email" name="email">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12 ">
							<input id="password" class="form-control form-control-lg" type="password" pattern=".{8,}" title="minimum 8 karakter" required=" " placeholder="Password" name="password">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12 ">
							<input id="confirm-password" class="form-control form-control-lg" type="password" required=" " placeholder="Ulangi Password" name="password-confirm">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12">
							<span class="d-block" id="message"></span>
						</div>
					</div>
					<div class="form-group text-center ">
						<div class="col-xs-12 p-b-20 ">
							<button id="btn-submit" class="btn btn-block btn-lg btn-info" type="submit" name="submit-login" value="1" disabled>DAFTAR</button>
						</div>
					</div>
					<div class="form-group m-b-0 m-t-10">
						<div class="col-sm-12 text-center">
							Sudah punya akun? <a href="<?php echo base_url('auth'); ?>" class="text-info m-l-5"><b>Masuk sekarang!</b></a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
