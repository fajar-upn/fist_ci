<div class="auth-box">
	<div id="loginform">
		<!-- Form -->
		<div class="row">
			<div class="col-12">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
				<div id="alerttype">
					<h5 id="alerttitle"></h5>
					<span id="alertmessage"></span>
					<i id="alerticon"></i>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
