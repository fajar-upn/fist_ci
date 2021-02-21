<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>

<!-- Custom script -->
<script type="text/javascript">
	$(function() {
		// $(document).on('click', '#btn-delete-module', function () {
		// 	var id			= $(this).data('id');
		// 	var link		= '<?php echo base_url('module_management/delete_module/') ?>' + id;
		// 	var name		= $(this).data('name');

		// 	$('#modal-delete .modal-body p').empty();  // agar text tidak duplicate
		// 	$('<p>Yakin ingin menghapus <span style="color: red;">'+ name +'</span>?</p>').appendTo('#modal-delete .modal-body');  // menambahkan text ke modal-body
		// 	$('#btn-confirm-delete').attr('href', link);  // generate link
		// });

		$(document).on('click', '#btn-edit-module', function () {
			var id			= $(this).data('id');
			var nama		= $(this).data('name');
			// var file		= $(this).data('file');
			var penulis		= $(this).data('author');
			var link		= '<?php echo base_url('module_management/update_proses/') ?>' + id;

			$("#modal-id").val(id);
			$("#modal-nama").val(nama);
			// $("#modal-file").val(file);
			$("#modal-penulis").val(penulis);
			$('#form-modal-edit').attr('action', link);
		});
	});
</script>

<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    $('.sa-hapus').click(function(event) {
        const href = $(this).attr('href');
        event.preventDefault();
        swal({
            title: "Apakah anda yakin ? ",
            text: "Anda tidak akan dapat mengembalikan data ini !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus !",
            cancelButtonText: "Tidak, batalkan !"
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
