<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">

				<!-- Dropdown Konsultasi -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-open"></i><span class="hide-menu">Konsultasi</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url() ?>consultation" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Pengajuan</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>consult_contract" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Kontrak</span></a></li>
						<li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu">Penjadwalan</span></a>
							<ul aria-expanded="false" class="collapse second-level">
								<li class="sidebar-item"><a href="<?php echo base_url() ?>consult_class" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> Kelas Konsultasi</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url() ?>consult_schedule" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> Jadwal Konsultasi</span></a></li>
							</ul>
						</li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>consult_payment" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Pembayaran</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url('consult_presence') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Presensi</span></a></li>
					</ul>
				</li>

				<!-- Dropdown Training -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-lead-pencil"></i><span class="hide-menu">Training</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url('training') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Kelas</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>includes/docs/documentation.html" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Penggajian</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>includes/docs/documentation.html" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Laporan</span></a></li>
					</ul>
				</li>

				<!-- Dropdown DEV -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-code-tags"></i><span class="hide-menu">DEV</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url('dev_module') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Modul</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url('development/readData') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Berkas</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url('dev_calculator') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Kalkulator Biaya</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url('dev_contract') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Kontrak</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url('dev_payment') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Pembayaran</span></a></li>
					</ul>
				</li>

				<!-- Dropdown Seminar dan Workshop -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">Seminar & Workshop</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url('workshop_seminar') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Event</span></a></li>
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

				<!-- Dropdown Setting -->
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Pengaturan</span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="<?php echo base_url() ?>user_management" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Pengguna</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>college" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Kampus</span></a></li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>Module_management" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Modul</span></a></li>
						<li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu">Manajemen Resource</span></a>
							<ul aria-expanded="false" class="collapse second-level">
								<li class="sidebar-item"><a href="<?php echo base_url('training_resource') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Resource Training</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url() ?>resources" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Resource Konsultasi</span></a></li>
							</ul>
						</li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>b_Application" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Jenis Aplikasi</span></a></li>
						<li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu">Manajemen Paket</span></a>
							<ul aria-expanded="false" class="collapse second-level">
								<li class="sidebar-item"><a href="<?php echo base_url('training_package') ?>" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Paket Training</span></a></li>
								<li class="sidebar-item"><a href="<?php echo base_url() ?>package" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Paket Konsultasi</span></a></li>
							</ul>
						</li>
						<li class="sidebar-item"><a href="<?php echo base_url() ?>b_Application" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">Manajemen Trainer/Tentor</span></a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>