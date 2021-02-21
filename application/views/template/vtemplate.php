<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>includes/assets/images/fist-logo.png">
	<title>Fist Effect Information System</title>
	<!-- CSS tambahan untuk halaman tertentu -->
	<?php
	if (isset($css)) {
		$this->load->view($css);
	}
	?>
	<!-- Custom CSS -->
	<link href="<?php echo base_url() ?>includes/dist/css/style.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header">
					<!-- This is for the sidebar toggle which is visible on mobile only -->
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<a class="navbar-brand" href="<?php echo base_url('dashboard') ?>">
						<!-- Logo icon -->
						<b class="logo-icon">
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon (default logo-icon.png)-->
							<img src="<?php echo base_url() ?>includes/assets/images/fist-logo.png" alt="homepage" class="dark-logo" style="width: 50px;" />
							<!-- Light Logo icon (default logo-light-icon.png)-->
							<img src="<?php echo base_url() ?>includes/assets/images/fist-logo.png" alt="homepage" class="light-logo" style="width: 50px;" />
						</b>
						<!--End Logo icon -->
						<!-- Logo text -->
						<span class="logo-text">
							<!-- dark Logo text -->
							<img src="<?php echo base_url() ?>includes/assets/images/fist-text.png" alt="homepage" class="dark-logo" style="width: 140px;" />
							<!-- Light Logo text -->
							<img src="<?php echo base_url() ?>includes/assets/images/fist-text.png" class="light-logo" alt="homepage" style="width: 140px;" />
						</span>
					</a>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- Toggle which is visible on mobile only -->
					<!-- ============================================================== -->
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse collapse" id="navbarSupportedContent">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-left mr-auto">
						<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
						<!-- ============================================================== -->
						<!-- Search -->
						<!-- ============================================================== -->
						<li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
							<form class="app-search position-absolute">
								<input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
							</form>
						</li>
					</ul>
					<!-- ============================================================== -->
					<!-- Right side toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-right">
						<!-- ============================================================== -->
						<!-- Notifications -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>

							</a>
							<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
								<span class="with-arrow"><span class="bg-primary"></span></span>
								<ul class="list-style-none">
									<li>
										<div class="drop-title bg-primary text-white">
											<h4 class="m-b-0 m-t-5">4 New</h4>
											<span class="font-light">Notifications</span>
										</div>
									</li>
									<li>
										<div class="message-center notifications">
											<!-- Message -->
											<a href="javascript:void(0)" class="message-item">
												<span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
												<div class="mail-contnet">
													<h5 class="message-title">Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
												</div>
											</a>
											<!-- Message -->
											<a href="javascript:void(0)" class="message-item">
												<span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
												<div class="mail-contnet">
													<h5 class="message-title">Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span>
												</div>
											</a>
											<!-- Message -->
											<a href="javascript:void(0)" class="message-item">
												<span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
												<div class="mail-contnet">
													<h5 class="message-title">Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span>
												</div>
											</a>
											<!-- Message -->
											<a href="javascript:void(0)" class="message-item">
												<span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
												<div class="mail-contnet">
													<h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
												</div>
											</a>
										</div>
									</li>
									<li>
										<a class="nav-link text-center m-b-5 text-dark" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
									</li>
								</ul>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- End Notifications -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
						<!-- End Topbar header -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() ?>includes/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
								<span class="with-arrow"><span class="bg-primary"></span></span>
								<div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
									<div class=""><img src="<?php echo base_url() ?>includes/assets/images/users/1.jpg" alt="user" class="img-circle" width="60"></div>
									<div class="m-l-10">
										<h4 class="m-b-0"><?php echo $this->session->userdata('username') ?></h4>
										<p class=" m-b-0"><?php echo $this->session->userdata('email') ?></p>
									</div>
								</div>
								<a class="dropdown-item" href="<?php echo base_url('user_management/account_profile/') . $this->session->userdata('id'); ?>"><i class="ti-user m-r-5 m-l-5"></i>Profil Saya</a>
								<a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>Kotak Masuk</a>
								<a class="dropdown-item" href="<?php echo base_url('user_management/account_setting/') . $this->session->userdata('id'); ?>"><i class="ti-settings m-r-5 m-l-5"></i>Pengaturan Akun</a>
								<a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i>Keluar</a>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- Left Sidebar - style you can find in sidebar.scss  -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<?php
		switch ($user_role) {
			case 1: //public
				$this->load->view('template/navbar/vnavbar_public.php');
				break;
			case 2: //developer
				$this->load->view('template/navbar/vnavbar_developer.php');
				break;
			case 3: //admin
				$this->load->view('template/navbar/vnavbar_admin.php');
				break;
			case 4: //analyst
				$this->load->view('template/navbar/vnavbar_analyst.php');
				break;
			case 5: //client
				$this->load->view('template/navbar/vnavbar_client.php');
				break;
			case 6: //tentor
				$this->load->view('template/navbar/vnavbar_mentor.php');
				break;
			case 7: //tentor
				$this->load->view('template/navbar/vnavbar_director.php');
				break;
		}


		?>
		<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<!-- Breadcrumb here-->
				<?php if (isset($breadcrumb)) {
					$this->load->view($breadcrumb);
				} ?>
			</div>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<div class="container-fluid">
				<!-- Content here-->
				<?php if (isset($content)) {
					$this->load->view($content);
				}
				?>
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			<footer class="footer text-center">
				Developed by Fist Effect Team 2K20.<br>
				All Rights Reserved by Xtreme admin. Designed by <a href="https://wrappixel.com">WrapPixel</a>.
			</footer>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Customizer Panel -->
	<!-- ============================================================== -->
	<aside class="customizer">
		<a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
		<div class="customizer-body">
			<div class="tab-content" id="pills-tabContent">
				<!-- Tab 1 -->
				<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<div class="p-15 border-bottom">
						<!-- Sidebar -->
						<h5 class="font-medium m-b-10 m-t-10">Pengaturan Layout</h5>
						<div class="custom-control custom-checkbox m-t-10">
							<input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
							<label class="custom-control-label" for="theme-view">Dark Theme</label>
						</div>
						<div class="custom-control custom-checkbox m-t-10">
							<input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
							<label class="custom-control-label" for="sidebar-position">Fixed Navbar</label>
						</div>
						<div class="custom-control custom-checkbox m-t-10">
							<input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
							<label class="custom-control-label" for="header-position">Fixed Topbar</label>
						</div>
						<div class="custom-control custom-checkbox m-t-10">
							<input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
							<label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
						</div>
					</div>
					<div class="p-15 border-bottom">
						<!-- Topbar BG -->
						<h5 class="font-medium m-b-10 m-t-10">Topbar Backgrounds</h5>
						<ul class="theme-color">
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1" data-navbarbg="skin1"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2" data-navbarbg="skin2"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3" data-navbarbg="skin3"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4" data-navbarbg="skin4"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5" data-navbarbg="skin5"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6" data-navbarbg="skin6"></a></li>
						</ul>
						<!-- Topbar BG -->
					</div>
					<div class="p-15 border-bottom">
						<!-- Navbar BG -->
						<h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
						<ul class="theme-color">
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
							<li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
						</ul>
						<!-- Navbar BG -->
					</div>
				</div>
			</div>
		</div>
	</aside>
	<div class="chat-windows"></div>
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="<?php echo base_url() ?>includes/assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo base_url() ?>includes/assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- apps -->
	<script src="<?php echo base_url() ?>includes/dist/js/app.min.js"></script>
	<!-- Theme settings -->
	<script src="<?php echo base_url() ?>includes/dist/js/app.init.horizontal.js"></script>
	<script src="<?php echo base_url() ?>includes/dist/js/app-style-switcher.horizontal.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="<?php echo base_url() ?>includes/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="<?php echo base_url() ?>includes/assets/extra-libs/sparkline/sparkline.js"></script>
	<!--Wave Effects -->
	<script src="<?php echo base_url() ?>includes/dist/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?php echo base_url() ?>includes/dist/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="<?php echo base_url() ?>includes/dist/js/custom.min.js"></script>
	<!--Javascript tambahan untuk halaman tertentu -->
    <script src="<?php echo base_url(); ?>includes/dist/js/pages/samplepages/jquery.PrintArea.js"></script>
    <script>
    $(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>
	<?php

	if (isset($js)) {

		$this->load->view($js);
	}
	?>

</body>

</html>