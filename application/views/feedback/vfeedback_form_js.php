<?php $this->load->view('template/vtemplate_notif') ?>

<script type="text/javascript">
	$(function() {

		/**
		 * mendapatkan value dari dropdown tipe pertanyaan
		 */
		$(document).on('change', '.type-question', function() {

			var type_question = $(this).val();
			var tag_id = "#" + $(this).parents(':eq(2)').attr('id');
			var id = $(this).parents(':eq(2)').attr('id');
			console.log(id);

			if (type_question == 'text') {
				$('#question-option_' + id).remove();
			} else if (type_question == 'textarea') {
				$('#question-option_' + id).remove();
			} else if (type_question == 'checkbox') {
				// show checkbox option
				$('#question-option_' + id).remove();
				var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3"><div class="form-group"><input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" required></div></div>';
				$(tag_id).append(tag);
			} else if (type_question == 'dropdown') {
				// show dropdown option
				$('#question-option_' + id).remove();
				var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3"><div class="form-group"><input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" required></div></div>';
				$(tag_id).append(tag);
			} else if (type_question == 'radio') {
				// show radio option
				$('#question-option_' + id).remove();
				var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3"><div class="form-group"><input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" required></div></div>';
				$(tag_id).append(tag);
			} else if (type_question == 'number') {
				// show input number
				$('#question-option_' + id).remove();
			}
		});

		$(document).on('click', '#add-option', function() {
			console.log('do something');
			var position = $(this).parents(':eq(1)');
			var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3"><div class="form-group"><input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" required></div></div>';
			$(tag).insertBefore(position);
		});

		$(document).on('click', '.delete-option', function() {
			console.log('delete');
			var element_remove = $(this).parents(':eq(1)');
			console.log(element_remove.attr('id'));
			$(element_remove).remove();
		});

		/**
		 * cek apakah tombol submit pada form terakhir ditekan atau belum
		 */
		$('a').filter(function(index) {
			if ($(this).text() === 'Submit') {
				$(this).attr("onclick", "this.closest('form').submit(); return false;");
			}
		});

		/**
		 * melakukan generate pertanyaan baru
		 */
		var id = document.getElementById("myInput").value;
		$(document).on('click', '#add-question', function() {
			var tag = '<div id="qid_' + id + '" class="row m-b-15"><div class="col-sm-8"><div class="form-group"><input type="text" class="form-control" id="question' + id + '" name="question[]" placeholder="Pertanyaan" required></div></div><div class="col-sm-3"><div class="form-group"><select class="form-control type-question" name="type_question[]"><option value="text" selected>Jawaban Singkat</option><option value="textarea">Jawaban Panjang</option><option value="number">Angka</option><option value="checkbox">Checkbox</option><option value="dropdown">Dropdown</option><option value="radio">Radio</option></select></div></div><div class="col-md-1"><button id="' + id + '" class="btn btn-danger waves-effect waves-light btn-delete-question" type="button"><i class="ti-close"></i></button></div></div>';
			$('#user-data').append(tag);
			id++;
		});

		/**
		 * menghapus pertanyaan
		 */
		$(document).on('click', '.btn-delete-question', function() {
			var id = $(this).attr("id");
			$('#qid_' + id).remove();
			$('#question-option_' + id).remove();
		});
	});
</script>