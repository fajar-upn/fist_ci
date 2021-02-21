<?php $this->load->view('template/vform_wizard_js') ?>
<?php $this->load->view('template/veditor_tinymce_js') ?>
<?php $this->load->view('template/vmaterial_datepicker_js') ?>
<?php $this->load->view('template/vtemplate_notif') ?>
<?php $this->load->view('template/vdatatable_js') ?>



<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js" ></script>
<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.full.min.js" ></script>
<script>
	$('.remove').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href');

		Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan menghapus data presensi!",
				icon: 'warning',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya, Hapus!'
				}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
		});
	});
	// $(document).ready(function () {

	// 	$("#name").select2({

	// 		placeholder: "Silahkan Pilih"

	// 	});

	// 	});
</script>