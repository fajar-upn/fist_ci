<?php $this->load->view('template/vform_wizard_js') ?>
<?php $this->load->view('template/veditor_tinymce_js') ?>
<?php $this->load->view('template/vmaterial_datepicker_js') ?>
<?php $this->load->view('template/vsweetalert_js') ?>
<?php $this->load->view('template/vtemplate_notif') ?>

<script type="text/javascript">
	$(function () {

		/**
		 * melakukan cek apakah sudah ada participant atau belum
		 * melakukan disable pada beberapa atribut question jika sudah ada participant
		 * melakukan remove attribut "name" agar tidak dapat diedit ketika ada participant
		 */
		var any_participant = <?php echo $any_participant; ?>;
		if (any_participant) {
			$("#user-data :input").attr("readonly", true);
			$("#add-question").remove();
			$(".btn-delete-question").remove();
			$("#user-data [name]").removeAttr("name");
		}

		/**
		 * mendapatkan value dari dropdown tipe pertanyaan
		 */
		$(document).on('change', '.type-question', function () {
			var type_question	= $(this).val();
			var tag_id 				= "#" + $(this).parents(':eq(2)').attr('id');
			var id 						= $(this).parents(':eq(2)').attr('id');
			var id_on_db			= $(this).parents()

			// deklarasi variable untuk value pada fungsi jquery
			var parent_level_first	= 1;
			var index_of_id					= 1;

			// mendapatkan id dari question-option yang ada pada DB
			var id_question = $(this).parents(':eq('+ parent_level_first +')').siblings(".get-question-option").attr('id');

			// jika id_question tidak 'undefined' maka option tersebut akan diremove
			if (typeof id_question !== 'undefined') {
				var id_question = id_question.split("_")[index_of_id];
				$('#question-option_' + id_question).remove();
			}

			// digunakan untuk menambahkan option jika type_question yang digunakan bertipe checkbox atau dropdown atau radio
			if (type_question === 'checkbox' || type_question === 'dropdown' || type_question === 'radio') {
				$('#question-option_' + id).remove();
				var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3">' +
										'<div class="form-group">' +
											'<input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]">' +
										'</div>' +
									'</div>';
				$(tag_id).append(tag);
			}
		});

		$(document).on('click', '.page-question', function () {
			var page	= $(this).val();
			var page_selection = $('.page-question');
		});

		/**
		 * Digunakan untuk menambah opsi jawaban
		 */
		$(document).on('click', '#add-option', function () {
			var position = $(this).parents(':eq(1)');
			var tag = '<div id="question-option_' + id + '" class="col-md-8 ml-3">' +
									'<div class="form-group">' +
										'<input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]">' +
									'</div>' +
								'</div>';
			$(tag).insertBefore(position);
		});

		$(document).on('click', '.delete-option', function () {
			var element_remove = $(this).parents(':eq(1)');
			$(element_remove).remove();
		});


		/**
		 * cek apakah tombol submit pada form terakhir ditekan atau belum
		 */
		$('a[href="#finish"]').on('click', function () {
			var page2 = 0, page3 = 0,
				page4 = 0, page5 = 0;

			var list_page = []
			var page_selection = $('.page-question');
			for (var i = 0; i < page_selection.length; i++) {
				list_page.push(page_selection[i].value);
			}

			list_page.sort();
			var page_one	= "1";
			var current 	= null;
			var count 		= 0,
				max_count 	= 0;
			for (var i = 0; i < list_page.length; i++) {
				if (list_page[i] === page_one) { continue; }
				else if (list_page[i] !== current) {
					current = list_page[i];
					count = 1;
				}
				else { count++; }

				if (count > max_count) {
					max_count = count;
				}
			}

			if (max_count > 3) {
				swal("Halaman berlebih", "Terdapat halaman yang memiliki lebih dari 3 pertanyaan.");
			} else {
				// Submit form
				if ($(this).text() === 'Simpan') {
					$("#form-ws").submit();
				}
			}
		});


		/**
		 * melakukan generate pertanyaan baru
		 */
		var id = $('#last_id').val();
		$(document).on('click', '#add-question', function () {
			var tag = '<input type="hidden" id="question-id_' + id +'" value="0" name="question_id[]">';
			tag += '<div id="qid_'+ id +'" class="row m-b-15">' +
					'<div class="col-sm-8">' +
						'<div class="form-group">' +
							'<input type="text" class="form-control" id="question' + id + '" name="question[]" placeholder="Pertanyaan" >' +
						'</div>' +
					'</div>' +
					'<div class="col-sm-2">' +
						'<div class="form-group">' +
							'<select class="form-control type-question" name="type_question[]">' +
								'<option value="text" selected>Jawaban Singkat</option>' +
								'<option value="textarea">Jawaban Panjang</option>' +
								'<option value="checkbox">Checkbox</option>' +
								'<option value="dropdown">Dropdown</option>' +
								'<option value="radio">Radio</option>' +
							'</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-sm-1">' +
						'<div class="form-group">' +
							'<select class="form-control page-question" name="page[]" readonly="">' +
								'<option value="2" selected>2</option>' +
								'<option value="3">3</option>' +
								'<option value="4">4</option>' +
								'<option value="5">5</option>' +
							'</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-md-1">' +
						'<button id="' + id + '" class="btn btn-danger waves-effect waves-light btn-delete-question" type="button">' +
							'<i class="ti-close"></i>' +
						'</button>' +
					'</div>' +
				'</div>';
			$('#user-data').append(tag);
			id++;
		});

		/**
		 * menghapus pertanyaan
		 */
		$(document).on('click', '.btn-delete-question', function () {
			var id										= $(this).attr("id");
			var question_id						= $("#question-id_" + id).val();
			var list_delete_question	= $("#list_delete_question").val();

			// mendapatkan id untuk dihapus
			list_delete_question += question_id + ";";

			$('#list_delete_question').val(list_delete_question);
			$('#qid_' + id).remove();
			$('#question-option_' + id).remove();
		});
	});

</script>

<script src="<?php echo base_url('includes/assets/libs/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/select2/dist/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/dist/js/pages/forms/select2/select2.init.js'); ?>"></script>
