<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>
<?php $this->load->view('template/vsweetalert_js') ?>
<script src="<?php echo base_url() ?>includes/assets/libs/autoNumeric/autoNumeric.js" ></script>
<!-- Custom script -->
<script type="text/javascript">

	$(function() {
		/**
		 * aksi untuk konfirmasi modal delete user setelah melakukan klik tombol delete pada modal
		 * digunakan untuk mengirimkan value dari data pada tabel ke modal
		 * selain itu juga melakukan generate keterangan text pada modal-body
		*/
		$(document).on('click', '#btn-delete-user', function () {
			var id			= $(this).data('id');
			var link		= "<?php echo base_url('user_management/delete/') ?>" + id;
			var username	= $(this).data('username');

			$('#modal-delete .modal-body p').empty();  // agar text tidak duplicate
			$('<p>Yakin ingin menghapus <span style="color: red;">'+ username +'</span>?</p>').appendTo('#modal-delete .modal-body');  // menambahkan text ke modal-body
			$('#btn-confirm-delete').attr('href', link);  // generate link
		});


		/**
		 * aksi untuk konfirmasi modal suspend user setelah melakukan klik tombol suspend pada model
		 * digunakan untuk mengirimkan value dari data pada tabel ke modal
		 * selain itu juga melakukan generate keterangan text pada modal-body
		 */
		$(document).on('click', '#btn-suspend-user', function () {
			var id			= $(this).data('id');
			var link		= "<?php echo base_url('user_management/suspend/') ?>" + id;
			var username	= $(this).data('username');

			$('#modal-suspend .modal-body p').empty();
			$('<p>Yakin ingin men-suspend<span style="color: red">' + username + '</span>?</p>').appendTo('#modal-suspend .modal-body');  // menambahkan text ke modal-body
			$('#btn-confirm-suspend').attr('href', link);
		});


		/**
		 * aksi saat menekan tombol edit pada tabel
		 * digunakan untuk mengirimkan value dari data pada tabel ke modal edit
		 * selain itu juga digunakan untuk generate link action pada form, link aktivasi dan link suspend
		 *
		 * modal edit user bersifat dinamis, data seolah-olah realtime, meskipun tidak realtime juga
		 * jadi ketika melakukan klik edit, maka data akan disesuaikan dengan user mana yang diklik
		 * hal ini didapat melalui atribut "data" yang diletakkan pada button (silahkan cek vuser_management.php bagian .open-modal)
		 * dengan atribut "data", JavaScript dapat menangkap data yang dikirimkan meski tanpa melakukan reload page
		 */
		$(document).on('click', '.open-modal', function () {
			/**
			 * menerima data dari view vuser_management.php
			 * selanjutnya dikonversi kedalam variabel JavaScript
			 */
			var id				= $(this).data('id');
			var name			= $(this).data('name');
			var username	= $(this).data('username');
			var email			= $(this).data('email');
			var role			= $(this).data('role');
			var role_id		= $(this).data('value')
			var active		= $(this).data('active');
			var suspend		= $(this).data('suspend');
			var ts				= $(this).data('tsalary');
			var cs				= $(this).data('csalary');
			var link			= '<?php echo base_url('user_management/update/account/') ?>' + id;


			/**
			 * mengirim kembali variable JavaScript kedalam view vuser_management
			 * hal ini dikarenakan data dalam modal bersifat dinamis sehingga setiap membuka modal akan berbeda datanya
			 */
			$("#modal-id").val(id);
			$("#modal-name").val(name);
			$("#modal-username").val(username);
			$("#modal-email").val(email);
			$("#modal-role").val(role);
			$("#modal-active").val(active);
			$("#modal-tsalary").val(ts);
			$("#modal-csalary").val(cs);
			$('#form-modal-edit').attr('action', link);
			$('#select-role').val(role_id);
			$('#modal-name-edit').text(username);
			$('#btn-change-password').data('id', id);

			if (role_id == 6) {
				document.getElementById('dcsalary').innerHTML="<label>Gaji Konsultasi</label>";
				document.getElementById('dtsalary').innerHTML="<label>Gaji Training</label>";
				document.getElementById('dcaddons').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Konsultasi' id='Csalary' name='csalary' value="+ cs + ">";
				document.getElementById('dtaddons').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Training' id='Tsalary' name='tsalary' value="+ ts + ">";
			} else {
				document.getElementById('dcsalary').innerHTML="";
				document.getElementById('dtsalary').innerHTML="";
				document.getElementById('dcaddons').innerHTML="";
				document.getElementById('dtaddons').innerHTML="";
			}

			$(document).ready(function(){
				$('#Csalary').autoNumeric('init');
				$('#Tsalary').autoNumeric('init');
			});

			/**
			 * jika user aktif, maka hilangkan field untuk aktivasi akun
			 * jika user tidak aktif, maka tampilkan field untuk aktivasi akun serta lakukan generate link untuk aktivasi
			 */
			if (active == 1) {
				$("#button-edit-activate").empty();
				// generate link
				$("#button-edit-activate").closest('.row').hide();
			} else {
				$("#button-edit-activate").empty();
				$("#button-edit-activate").closest('.row').show();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/activate/')?>"+ id +"' class='btn btn-success'>Aktifkan</a>";
				$("#button-edit-activate").append(html);
			}

			var from_user		= 0;
			var is_suspend	= 0;
			if (suspend == 1) {
				$("#button-edit-suspend").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/suspend/') ?>" + id  + "/" + from_user + "/" + is_suspend + "' class='btn btn-success'>Unsuspend Akun</a>";
				$("#button-edit-suspend").append(html);
			} else {
				$("#button-edit-suspend").empty();
				// generate link
				var html = "<a href='<?php echo base_url('user_management/suspend/')?>" + id + "/" + from_user + "' class='btn btn-warning'>Suspend Akun</a>";
				$('#button-edit-suspend').append(html);
			}
		});


		$("#btn-change-password").click(function () {
			var id = $(this).data('id');
			var link = "<?php echo base_url('user_management/update/user_password/') ?>" + id;
			$("#form-change-password").attr('action', link);
		});


		/**
		 * aksi saat menekan tombol ganti password
		 * digunakan untuk melakukan generate password kemudian mengirimkan value generatenya ke form input password
		 * hanya dapat diakses oleh developer atau admin
		 */
		$("#btn-generate-password").click(function () {
			var key = '';
			var characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
			var length_key = 6;

			for (var i = 0; i < length_key; i++) {
				key += characters.charAt(Math.floor(Math.random() * characters.length));
			}

			$("#input-generate-password").val(key);
		});
	});


	function salary(){
		var a=document.getElementById('role').value;
		if (a == 6) {
			document.getElementById('csalary').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Konsultasi' id='Csalary'  name='Csalary' >";
			document.getElementById('tsalary').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Training' id='Tsalary' name='Tsalary' >";
		} else {
			document.getElementById('csalary').innerHTML="";
			document.getElementById('tsalary').innerHTML="";
		}

		$(document).ready(function() {
			$('#Csalary').autoNumeric('init');
			$('#Tsalary').autoNumeric('init');
		});
	};

	function salary2() {
		var a = document.getElementById('select-role').value;
		if (a == 6) {
			document.getElementById('dcsalary').innerHTML="<label>Gaji Konsultasi</label>";
			document.getElementById('dtsalary').innerHTML="<label>Gaji Training</label>";
			document.getElementById('dcaddons').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Konsultasi' id='Csalary' name='csalary' >";
			document.getElementById('dtaddons').innerHTML="<span class='input-group-text' id='basic-addon1'>Rp.</span><input class=form-control placeholder='Gaji Training' id='Tsalary' name='tsalary' >";
		} else {
			document.getElementById('dcsalary').innerHTML="";
			document.getElementById('dtsalary').innerHTML="";
			document.getElementById('dcaddons').innerHTML="";
			document.getElementById('dtaddons').innerHTML="";
		}

		$(document).ready(function() {
			$('#Csalary').autoNumeric('init');
			$('#Tsalary').autoNumeric('init');
		});
	};
	$("[data-tt=tooltip").tooltip();

</script>
