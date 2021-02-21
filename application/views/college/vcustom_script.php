<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>

<script src="<?php echo base_url('includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/sweet-alert.init.js'); ?>"></script>

<!-- Custom script -->
<script type="text/javascript">

	$(function() {
		$(document).on('click', '#open-modal', function () {
			var id			= $(this).data('id');
			var name		= $(this).data('name');
			var inisial		= $(this).data('inisial');
			var link		= '<?php echo base_url('college/update_proses/') ?>' + id;

			$("#modal-id").val(id);
			$("#modal-name").val(name);
			$("#modal-inisial").val(inisial);
			$('#form-modal-edit').attr('action', link);
		});
		$("[data-tt=tooltip]").tooltip();
	});

</script>

<script type="text/javascript">
	$('.sa-hapus-college').click(function (event) {
		const href = $(this).attr("href");
		event.preventDefault();

		swal({
			title: "Apakah anda yakin ingin menghapus?",
			text: "Data ini akan dihapus",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, hapus",
			cancelButtonText: "Tidak, batalkan!",
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
			}
		});
	});
</script>
