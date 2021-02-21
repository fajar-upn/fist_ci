<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Wilio Survey, Quotation, Review and Register form Wizard by Ansonika.">
	<meta name="author" content="Ansonika">
	<title>Registrasi | <?php echo $workshop_seminar->ws_title; ?></title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?php echo base_url('includes/dist/wilio/img/fist-logo.png'); ?>" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url('includes/dist/wilio/img/apple-touch-icon-57x57-precomposed.png'); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url('includes/dist/wilio/img/apple-touch-icon-72x72-precomposed.png'); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url('includes/dist/wilio/img/apple-touch-icon-114x114-precomposed.png'); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url('includes/dist/wilio/img/apple-touch-icon-144x144-precomposed.png'); ?>">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="<?php echo base_url('includes/dist/wilio/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('includes/dist/wilio/css/menu.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('includes/dist/wilio/css/style.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('includes/dist/wilio/css/vendors.css'); ?>" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="<?php echo base_url('includes/dist/wilio/css/custom.css'); ?>" rel="stylesheet">

	<!-- MODERNIZR MENU -->
	<script src="<?php echo base_url('includes/dist/wilio/js/modernizr.js'); ?>"></script>

</head>

<body>

<div id="preloader">
	<div data-loader="circle-side"></div>
</div><!-- /Preload -->

<div id="loader_form">
	<div data-loader="circle-side-2"></div>
</div><!-- /loader_form -->

<div class="container-fluid full-height">
	<div class="row row-height">
		<div class="col-lg-6 content-left">
			<div class="content-left-wrapper">
				<a href="index.html" id="logo"><img src="<?php echo base_url('includes/dist/wilio/img/fist-logo.png'); ?>" alt="" style="width: 30px;"></a>
				<div>
					<figure><img src="<?php echo base_url('includes/dist/wilio/img/fist-logo.png'); ?>" alt="" class="img-fluid"></figure>
					<h2>FIST EFFECT</h2>
					<p>Fist Effect merupakan perusahaan yang bergerak dibidang pengembangan sumberdaya manusia dan pengembangan aplikasi. Fokus dari pengembangan sumberdaya manusia di perusahaan kami berada dalam lingkup Teknologi Informasi..</p>
				</div>
				<div class="copy">© 2018 Wilio</div>
			</div>
			<!-- /content-left-wrapper -->
		</div>
		<!-- /content-left -->

		<div class="col-lg-6 content-right" id="start">
			<div id="wizard_container">
				<div id="top-wizard">
					<div id="progressbar"></div>
				</div>
				<!-- /top-wizard -->
				<form id="wrapped" method="POST">
					<input id="website" name="website" type="text" value="">
					<!-- Leave for security protection, read docs for details -->
					<div id="middle-wizard">
						<?php $length = count($ws_question); $count = 0; $index = 1;?>
						<!-- /step-->
						<?php $page_length = count($pages); ?>
						<?php foreach ($pages as $key => $page) : ?>
							<?php if ($index == $page_length) : ?>
								<div class="submit step">
								<h3 class="main_question"><strong><?php echo $page; ?>/<?php echo $page_length; ?></strong> Isi form berikut untuk mendaftar <?php echo $workshop_seminar->ws_type; ?> <b><?php echo $workshop_seminar->ws_title; ?></b></h3>
							<?php else : ?>
								<div class="step">
								<h3 class="main_question"><strong><?php echo $page; ?>/<?php echo $page_length; ?></strong> Isi form berikut untuk mendaftar <?php echo $workshop_seminar->ws_type; ?> <b><?php echo $workshop_seminar->ws_title; ?></b></h3>
							<?php endif; ?>

							<?php for ($iter = $count; $iter <  $length; $iter++) : ?>
								<?php if ($ws_question[$iter]['page'] == $page) : ?>
							<input type="hidden" name="question_id[]" value="<?php echo $ws_question[$iter]['question_id']; ?>">
								<?php if (strcmp($ws_question[$iter]['question_type'], "text") == 0) : ?>
									<div class="form-group">
										<label><?php echo $ws_question[$iter]['question']; ?></label>
										<input type="text" name="answer[]" class="form-control required">
									</div>
								<?php elseif (strcmp($ws_question[$iter]['question_type'], "textarea") == 0) : ?>
									<div class="form-group">
										<label><?php echo $ws_question[$iter]['question']; ?></label>
										<textarea name="answer[]" class="form-control required" cols="30" rows="10"></textarea>
									</div>
								<?php elseif (strcmp($ws_question[$iter]['question_type'], "dropdown") == 0) : ?>
									<div class="form-group">
										<label><?php echo $ws_question[$iter]['question']; ?></label>
										<div class="styled-select clearfix">
											<select class="wide required" name="answer[]">
												<?php foreach ($ws_question[$iter]['option']['option_text'] as $key_option => $option) : ?>
													<option value="<?php echo $ws_question[$iter]['option']['option_id'][$key_option]; ?>"><?php echo $option; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								<?php elseif (strcmp($ws_question[$iter]['question_type'], "checkbox") == 0) : ?>
									<label><?php echo $ws_question[$iter]['question']; ?></label>
									<div class="form-group terms">
										<?php foreach ($ws_question[$iter]['option']['option_text'] as $key_option => $option) : ?>
											<label class="container_check"><?php echo $option; ?></a>
												<input type="checkbox" name="answer[]" value="<?php echo $ws_question[$iter]['option']['option_id'][$key_option]; ?>" class="required">
												<span class="checkmark"></span>
											</label>
										<?php endforeach; ?>
									</div>

								<?php elseif (strcmp($ws_question[$iter]['question_type'], "radio") == 0) : ?>
									<label><?php echo $ws_question[$iter]['question']; ?></label>
									<?php foreach ($ws_question[$iter]['option']['option_text'] as $key_option => $option) : ?>
										<div class="row">
											<div class="form-group radio_input">
												<label class="container_radio"><?php echo $option; ?>
													<input type="radio" name="answer[]" value="<?php echo $ws_question[$iter]['option']['option_id'][$key_option]; ?>" class="required">
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
								<?php $count++; ?>
									<?php endif; ?>
							<?php endfor; ?>
						</div>
						<?php $index++; ?>
						<?php endforeach; ?>
						<!-- /step-->
					</div>
					<!-- /middle-wizard -->
					<div id="bottom-wizard">
						<button type="button" name="backward" class="backward">Sebelumnya</button>
						<button type="button" name="forward" class="forward">Selanjutnya</button>
						<button type="submit" name="process" class="submit">Daftar</button>
					</div>
					<!-- /bottom-wizard -->
				</form>
			</div>
			<!-- /Wizard container -->
		</div>
		<!-- /content-right-->
	</div>
	<!-- /row-->
</div>
<!-- /container-fluid -->

<!-- COMMON SCRIPTS -->
<script src="<?php echo base_url('includes/dist/wilio/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/dist/wilio/js/common_scripts.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/dist/wilio/js/velocity.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/dist/wilio/js/functions.js'); ?>"></script>

<!-- Wizard script -->
<script src="<?php echo base_url('includes/dist/wilio/js/survey_func.js'); ?>"></script>
<script type="text/javascript">
	$(function () {
		"use strict";

		$('form#wrapped').attr('action', '<?php echo base_url("workshop_seminar/register/$ws_id")?>');
	})
</script>
</body>
</html>
