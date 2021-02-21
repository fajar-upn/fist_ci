<script src="<?php echo base_url() ?>includes/assets/libs/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>includes/dist/js/pages/forms/select2/select2.init.js"></script>
<script>
	$( document ).ready(function() {
		$('#datepicker-autoclose').datepicker({
			language: 'id',
			format: 'yyyy-mm-dd',
			immediateUpdates: true,
			autoclose: true,
			todayHighlight: true
		});
	});
</script>