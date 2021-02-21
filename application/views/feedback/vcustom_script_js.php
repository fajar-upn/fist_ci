<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>
<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/sweet-alert.init.js"></script>

<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>includes/dist/js/pages/forms/select2/select2.init.js"></script>

<!-- Custom script -->
<script type="text/javascript">
	$('.delete').on('click', function(e) {

		e.preventDefault();
		const href = $(this).attr('href');

		Swal({
			title: "Apakah anda yakin ingin menghapus?",
			text: "Data anda akan dihapus !",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, hapus",
			cancelButtonText: 'Tidak, batalkan!',
			closeOnConfirm: false
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
			}
		})
	});
</script>