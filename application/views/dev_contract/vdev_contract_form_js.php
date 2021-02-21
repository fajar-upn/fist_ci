<script src="<?php echo base_url() ?>includes/assets/libs/moment/moment.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>includes/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script>
// Date Picker
jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
jQuery('#datepicker-autoclose').datepicker({
	autoclose: true,
	todayHighlight: true
});
jQuery('#date-range').datepicker({
	toggleActive: true
});
jQuery('#datepicker-inline').datepicker({
	todayHighlight: true
});
</script>