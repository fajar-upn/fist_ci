<?php $this->load->view('template/vtemplate_notif') ?>
<?php $this->load->view('template/vdatatable_js') ?>
<?php $this->load->view('template/vmaterial_datepicker_js') ?>
<?php $this->load->view('template/vsweetalert_js') ?>

<script type="text/javascript">
	$('.sa-nonactive-ws').click(function (event){
		var link = $(this) .attr("href");
		event.preventDefault();

		swal({
			title: "Apakah Anda yakin ingin menonaktifkan?",
			text: "Dengan menonaktifkan, form ini tidak dapat diakses",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, nonaktifkan",
			cancelButtonText: "Tidak, batalkan!",
		}).then((result) => {
			if (result.value) {
				document.location.href = link;
			}
		});
	});
</script>

<script type="text/javascript">
	$('.sa-active-ws').click(function (event){
		var link = $(this) .attr("href");
		event.preventDefault();

		swal({
			title: "Apakah Anda yakin ingin mengaktifkan?",
			text: "Dengan mengaktifkan, form ini dapat diakses oleh umum dan tidak dapat diedit lagi",
			type: "success",
			showCancelButton: true,
			confirmButtonColor: "#4BDD17",
			confirmButtonText: "Ya, aktifkan",
			cancelButtonText: "Tidak, batalkan!",
		}).then((result) => {
			if (result.value) {
				document.location.href = link;
			}
		});
	});
</script>
