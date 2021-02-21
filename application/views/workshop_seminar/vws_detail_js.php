<script src="<?php echo base_url('includes/dist/js/pages/samplepages/jquery.PrintArea.js'); ?>"></script>
<?php $this->load->view('template/vtemplate_notif'); ?>
<?php $this->load->view('template/vdatatable_js'); ?>

<script>
	$(function() {
		$("#print").click(function() {
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = {
				mode: mode,
				popClose: close
			};
			$("div.printableArea").printArea(options);
		});
	});

	$(document).on('click', '#btn-participant-edit', function () {
		var id				= $(this).data('id');
		var ws_id			= $(this).data('ws_id');
		var name			= $(this).data('name');
		var link_payment	= "<a href='<?php echo base_url('workshop_seminar/update_payment/') ?>" + ws_id + "/" + id + "' class='btn btn-success'>Status pembayaran</a>";
		var link_attendance	= "<a href='<?php echo base_url('workshop_seminar/update_attendance/') ?>" + ws_id + "/" + id + "' class='btn btn-success'>Status kedatangan</a>";

		$('#payment-status a').remove();
		$('#attendance-status a').remove();

		$('.modal-title').text('Aksi untuk ' + name);
		$("#modal-id").val(id);
		$("#modal-name").val(name);
		$('#payment-status').append(link_payment);
		$('#attendance-status').append(link_attendance);
	});
</script>
