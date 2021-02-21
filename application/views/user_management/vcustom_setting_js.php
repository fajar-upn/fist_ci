<?php $this->load->view('template/vtemplate_notif') ?>

<script type="text/javascript">
	$(function() {
		/**
		 * muncul saat tombol dengan id btn-delete-user diklik
		 * melakukan pengambilan beberapa data melalui atribut [data]
		 * melakukan generate text yang nantinya akan diload di tag <p> pada .modal-body
		 */
		$(document).on('click', '#btn-delete-user', function () {
			var id			= $(this).data('id');
			var link		= '<?php echo base_url('user_management/delete/') ?>' + id;
			var username	= $(this).data('username');

			$('#modal-delete .modal-body p').empty();  // agar text tidak duplicate
			$('<p>Yakin ingin menghapus <span style="color: red;">'+ username +'</span>?</p>').appendTo('#modal-delete .modal-body');  // menambahkan text ke modal-body
			$('#btn-confirm-delete').attr('href', link);  // generate link
		});

		/**
		 * Cek apakah antara password dan confirm-password sama atau tidak
		 * jika tidak sama maka akan memunculkan notifikasi bahwa password tidak sama
		 */
		$('#password, #confirm-password').on('keyup', function () {
			if ($('#password').val() !== $('#confirm-password').val()) {
				$('#message').html('Password berbeda');
				$('#message').addClass('alert-danger p-2');
				$('#btn-submit').prop('disabled', true);
			} else {
				$('#message').html('');
				$('#message').removeClass('alert-danger p-2');
				$('#btn-submit').prop('disabled', false);
			}
		});
	});
</script>
