<script src="<?php echo base_url(); ?>includes/assets/libs/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>includes/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
	// Date Picker
	$(".mydatepicker, #datepicker, .input-group.date").datepicker({
		autoclose:true,
		startView:"days",
		minViewMode:"days",
		orientation: "bottom",
		format: "yyyy-mm-dd"
	}).on('changeDate', function(selected){
		startDate = new Date(selected.date.valueOf());
		startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
		$('.to').datepicker('setStartDate', startDate);
	});

	$('#datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true
	});
	$('#date-range').datepicker({
		toggleActive: true
	});
	$('#datepicker-inline').datepicker({
		todayHighlight: true
	});
</script>
