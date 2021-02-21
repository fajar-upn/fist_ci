<script src="<?php echo base_url() ?>includes/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url() ?>includes/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/sweet-alert.init.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		// sweet alert hapus
		$('#sa-hapus').click(function(event){
			const href = $(this).attr('href');
			event.preventDefault();
			swal({   
				title: "Apakah anda yakin?",
				text: "Anda tidak akan dapat mengembalikan data ini!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ya, hapus!",   
				cancelButtonText: "Tidak, batalkan!"
			}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			});
		});
	});
</script>