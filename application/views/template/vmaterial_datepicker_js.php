<script src="<?php echo base_url('includes/assets/libs/moment/moment.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js'); ?>"></script>

<script>
	// MAterial Date picker
	$('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
	$('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
	$('#time-start').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
	$('#time-end').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
	$('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

	$('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
	$('#date-fr').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', lang: 'fr', weekStart: 1, cancelText: 'ANNULER' });
	$('#date-end').bootstrapMaterialDatePicker({ weekStart: 0 });
	$('#date-start').bootstrapMaterialDatePicker({ weekStart: 0 }).on('change', function(e, date) {
		$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
	});

	$('#custom-date-start').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
	$('#custom-date-end').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
</script>
