<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>

<!-- Custom script -->
<script type="text/javascript">
	$(function() {

		/**
		 * aksi untuk konfirmasi modal delete user setelah melakukan klik tombol delete pada modal
		 * digunakan untuk mengirimkan value dari data pada tabel ke modal
		 * selain itu juga melakukan generate keterangan text pada modal-body
		 */
		$(document).on('click', '#btn-delete-user', function() {
			var id = $(this).data('id');
			var link = "<?php echo base_url('user_management/delete/') ?>" + id;
			var username = $(this).data('username');

			$('#modal-delete .modal-body p').empty(); // agar text tidak duplicate
			$('<p>Yakin ingin menghapus <span style="color: red;">' + username + '</span>?</p>').appendTo('#modal-delete .modal-body'); // menambahkan text ke modal-body
			$('#btn-confirm-delete').attr('href', link); // generate link
		});



		/**
		 * aksi saat menekan tombol edit pada tabel
		 * digunakan untuk mengirimkan value dari data pada tabel ke modal edit
		 * selain itu juga digunakan untuk generate link action pada form, link aktivasi dan link suspend
		 */
		$(document).on('click', '.open-modal', function() {
			var id = $(this).data('id');
			var name = $(this).data('name');
			var username = $(this).data('username');
			var email = $(this).data('email');
			var role = $(this).data('role');
			var role_id = $(this).data('value')
			var active = $(this).data('active');
			var suspend = $(this).data('suspend');
			var link = '<?php echo base_url('user_management/update/account/') ?>' + id;

			$("#modal-id").val(id);
			$("#modal-name").val(name);
			$("#modal-username").val(username);
			$("#modal-email").val(email);
			$("#modal-role").val(role);
			$("#modal-active").val(active);
			$('#form-modal-edit').attr('action', link);
			$('#select-role').val(role_id);
			$('#modal-name-edit').text(username);
			$('#btn-change-password').data('id', id);

			if (active == 1) {
				$("#button-edit-activate").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/nonactivate/') ?>" + id + "' class='btn btn-dark'>Nonaktifkan</a>";
				$("#button-edit-activate").append(html);
			} else {
				$("#button-edit-activate").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/activate/') ?>" + id + "' class='btn btn-success'>Aktifkan</a>";
				$("#button-edit-activate").append(html);
			}

			var from_user = 0;
			var is_suspend = 0;
			if (suspend == 1) {
				$("#button-edit-suspend").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/suspend/') ?>" + id + "/" + from_user + "/" + is_suspend + "' class='btn btn-success'>Unsuspend Akun</a>";
				$("#button-edit-suspend").append(html);
			} else {
				$("#button-edit-suspend").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/suspend/') ?>" + id + "/" + from_user + "' class='btn btn-warning'>Suspend Akun</a>";
				$('#button-edit-suspend').append(html);
			}
		});

	});
</script>