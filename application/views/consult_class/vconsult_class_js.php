<script src="<?php echo base_url() ?>includes/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url() ?>includes/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		// modal ubah
		$('.button-edit').click(function() {
			var classID = this.getAttribute("data-classID");
			var contractID = this.getAttribute("data-contractID");
			var mentorID = this.getAttribute("data-mentorID");
			var selectedOptionText = this.getAttribute("data-optionSelected");
			console.log(classID  + ' ' + contractID  + ' ' + mentorID + ' ' + selectedOptionText);

			var modal = $('#modal-edit');
			modal.modal({
				backdrop: 'static'
			});

			modal.find('#selectContract').empty()
			.append('<option disabled>Pilih mahasiswa...</option>')
			.append('<option selected value="' + contractID + '">' + selectedOptionText + '</option>');
			<?php foreach ($unassigned_classes as $row): ?>
				modal.find('#selectContract')
				.append('<option value="<?php echo $row->contract_id ?>"><?php echo ($row->client_code . ' - ' . $row->client_name) ?></option>');
			<?php endforeach ?>

			modal.find('#selectMentor').empty();
			<?php foreach ($mentor as $row): ?>
				if (mentorID == <?php echo $row->uacc_id ?>) {
					modal.find('#selectMentor')
					.append('<option selected value="<?php echo $row->uacc_id ?>"><?php echo $row->uprof_full_name ?></option>');
				}
				else {
					modal.find('#selectMentor')
					.append('<option value="<?php echo $row->uacc_id ?>"><?php echo $row->uprof_full_name ?></option>')
				}
			<?php endforeach ?>

			modal.find("input[name='class_id']").val(classID);
		});

		// sweet alert hapus
		$('.sa-hapus').click(function(event){
			const href = $(this).attr('href');
			event.preventDefault();
			swal({   
				title: "Apakah anda yakin?",
				text: "Anda tidak akan dapat mengembalikan data ini!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ya, hapus!",   
				cancelButtonText: "Tidak, batalkan!"
			}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			});
		});
	});
</script>
<!-- load vtemplate-notif2 -->
<?php 
$this->load->view('template/vtemplate_notif2.php');
?>