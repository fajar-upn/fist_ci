<script type="text/javascript">
$( document ).ready(function() {
	var typeNotif = '<?php echo $this->session->userdata('typeNotif'); ?>';
	var alertNotif = $('#alert-notif');
	var alertColor = '';
	var alertIcon = '';
	var alertTitle = '';
	var alertContent = '';
	switch (typeNotif) {
		case 'successAddData':
			alertColor = 'success';
			alertIcon = 'fa-check-circle';
			alertTitle = 'berhasil';
			alertContent = 'tambah';
		break;
		case 'errorAddData':
			alertColor = 'danger';
			alertIcon = 'fa-exclamation-triangle';
			alertTitle = 'gagal';
			alertContent = 'tambah';
		break;
		case 'successEditData':
			alertColor = 'success';
			alertIcon = 'fa-check-circle';
			alertTitle = 'berhasil';
			alertContent = 'ubah';
		break;
		case 'errorEditData':
			alertColor = 'danger';
			alertIcon = 'fa-exclamation-triangle';
			alertTitle = 'gagal';
			alertContent = 'ubah';
		break;
		case 'successDeleteData':
			alertColor = 'success';
			alertIcon = 'fa-check-circle';
			alertTitle = 'berhasil';
			alertContent = 'hapus';
		break;
		case 'errorDeleteData':
			alertColor = 'danger';
			alertIcon = 'fa-exclamation-triangle';
			alertTitle = 'gagal';
			alertContent = 'hapus';
		break;
	}
	alertNotif.addClass('alert alert-' + alertColor + ' alert-rounded');
	alertNotif.append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>');
	alertNotif.append('<h3 class="text-'+ alertColor +'"><i class="fa '+ alertIcon +'"></i> '+ alertTitle.substr(0,1).toUpperCase()+alertTitle.substr(1) +'</h3>');
	alertNotif.append('Data '+ alertTitle +' di<b>'+ alertContent +'</b>!');
	<?php $this->session->set_userdata('typeNotif', ''); ?>
});
</script>