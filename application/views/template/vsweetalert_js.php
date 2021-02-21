<script src="<?php echo base_url('includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/sweet-alert.init.js'); ?>"></script>

<script>
$(document).ready(function() {


	$('.sa-active-user').click(function (event) {
		var link = $(this).attr("href");
		event.preventDefault();

		swal({
			title: "Apakah Anda yakin ingin mengaktifkan?",
			text: "Dengan mengaktifkan, pengguna dapat memiliki akses ke sistem sesuai dengan role-nya",
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

	$('.sa-nonactive-user').click(function (event) {
		console.log("clicked");
		var link = $(this).attr("href");
		event.preventDefault();

		swal({
			title: "Apakah Anda yakin ingin menonaktifkan akun ini?",
			text: "Dengan menonaktifkan, pengguna tidak dapat mengakses akun ini sampai akun ini kembali diaktifkan",
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
})
</script>
