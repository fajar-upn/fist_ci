<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">

				<!-- Dropdown Konsultasi -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-open"></i><span class="hide-menu">Konsultasi</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url() ?>consultation" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Daftar Pengajuan</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url("consult_payroll") ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Penggajian</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url("consult_report") ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Laporan</span></a></li>
					</ul>
				</li>

				<!-- Dropdown Training -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-lead-pencil"></i><span class="hide-menu">Training</span></a>
					<ul aria-expanded="false" class="collapse first-level">
					<li class="sidebar-item"><a href="<?php echo base_url("training_payroll") ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Penggajian</span></a></li>
					<li class="sidebar-item"><a href="<?php echo base_url("training_report") ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Laporan</span></a></li>
					</ul>
				</li>

				<!-- Dropdown Seminar dan Workshop -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">Seminar & Workshop</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url() ?>workshop_seminar" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Laporan</span></a></li>
					</ul>
				</li>

				<!-- Dropdown Feedback -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-notification-clear-all"></i><span class="hide-menu">Feedback</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu">Manajemen Feedback</span></a>
							<ul aria-expanded="false" class="collapse second-level">
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Seminar & Workshop</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management/training') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Pelatihan</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management/consult') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Konsultasi</span></a></li>
							</ul>
						</li>
						<li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu">Data Feedback</span></a>
							<ul aria-expanded="false" class="collapse second-level">
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management/data_worksem') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Seminar & Workshop</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management/data_training') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Pelatihan</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url('feedback_management/data_consult') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Konsultasi</span></a></li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- Dropdown Module-->
				<li class="sidebar-item"><a href="<?php echo base_url('Module_management') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Module</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
