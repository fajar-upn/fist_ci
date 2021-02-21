<?php $this->load->view('template/vmaterial_datepicker_js'); ?>
<?php $this->load->view('template/vtemplate_notif'); ?>

<script>
	$(function () {
		var gender = "<?php echo $user['uprof_gender']; ?>";
		$('#gender').val(gender);
	});
</script>
