<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php
				if (!empty($this->session->userdata('typeNotif'))) :
				?>
					<div id="alerttype" class="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
						<span id="alertmessage"></span>
					</div>
				<?php endif; ?>

				<h4 class="card-title">Manajemen Feedback Pelatihan</h4>
				<form id="form-ws" action="<?php echo base_url('feedback_management/training'); ?>" class="m-t-40" method="post">

					<!-- <h6>Feedback Peserta</h6> -->
					<section>
						<div id="user-data" class="form-group">
							<div id="qid_0" class="row m-b-15">
								<div class="col-sm-8">
									<div class="form-group">
										<input type="text" class="form-control" id="question0" name="question[]" placeholder="Pertanyaan" value="Nama Lengkap" readonly>
									</div>
								</div>

								<div class="col-sm-3">
									<div class="form-group">
										<select class="form-control type-question" name="type_question[]">
											<option value="text" selected>Jawaban Singkat</option>
										</select>
									</div>
								</div>
							</div>

							<?php $amount_question =  count($questions); ?>
							<input type="hidden" id="myInput" value="<?= $amount_question ?>">
							<?php
							if ($amount_question != 0) {
								for ($i = 2; $i <= $amount_question; $i++) {
									$que_id = $questions[$i - 1]->tfque_id; // Untuk menyimpan id pertanyaan dipakai sebagai kondisi while
							?>
									<div id="qid_<?= $i - 1 ?>" class="row m-b-15">
										<div class="col-sm-8">
											<div class="form-group"><input type="text" class="form-control" id="question<?= $i - 1 ?>" name="question[]" placeholder="Pertanyaan" value="<?= $questions[$i - 1]->tfque_question ?>" required></div>
										</div>
										<div class="col-sm-3">
											<div class="form-group"><select class="form-control type-question" name="type_question[]">
													<option value="text" <?= $questions[$i - 1]->tfque_type == "text" ? 'selected' : NULL ?>>Jawaban Singkat</option>
													<option value="textarea" <?= $questions[$i - 1]->tfque_type == "textarea" ? 'selected' : NULL ?>>Jawaban Panjang</option>
													<option value="number" <?= $questions[$i - 1]->tfque_type == "number" ? 'selected' : NULL ?>>Angka</option>
													<option value="checkbox" <?= $questions[$i - 1]->tfque_type == "checkbox" ? 'selected' : NULL ?>>Checkbox</option>
													<option value="dropdown" <?= $questions[$i - 1]->tfque_type == "dropdown" ? 'selected' : NULL ?>>Dropdown</option>
													<option value="radio" <?= $questions[$i - 1]->tfque_type == "radio" ? 'selected' : NULL ?>>Radio</option>
												</select></div>
										</div>
										<div class="col-md-1"><button id="<?= $i - 1 ?>" class="btn btn-danger waves-effect waves-light btn-delete-question" type="button"><i class="ti-close"></i></button></div>
										<?php if (($questions[$i - 1]->tfque_type == "radio") || ($questions[$i - 1]->tfque_type == "dropdown") || ($questions[$i - 1]->tfque_type == "checkbox")) { ?>
											<div id="question-option_qid_<?= $i - 1 ?>" class="col-md-8 ml-3">
												<?php $next = "";
												while ((isset($questions[$i - 1])) && ($questions[$i - 1]->tfque_id == $que_id)) {
													if (isset($questions[$i]) && ($questions[$i]->tfque_id == $que_id)) {
														$next .= $questions[$i - 1]->tfselect_selection . ';';
													} else {
														$next .= $questions[$i - 1]->tfselect_selection;
													}
													$i++;
												}

												$i--; ?>
												<div class="form-group"><input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" value="<?= $next ?>" required></div>
											</div>
										<?php } ?>
									</div>
							<?php }
							} ?>
						</div>
						<?php if ($user_role == 3) { // Kondisi untuk jika yang login adalah role admin 
						?>
							<button id="add-question" class="btn btn-success waves-effect waves-light" type="button"><i class="fa fa-plus pr-2"></i> Tambah Pertanyaan</button>
						<?php } ?>
					</section>
					<?php if ($user_role == 3) { ?>
						<div class="text-right">
							<button type="submit" name="process" value="process" class="btn btn-success waves-effect mr-4"><i class="fa fa-check"></i> Simpan</button>
						</div>
					<?php } ?>
				</form>
				<?php
				// endif; 
				?>
			</div>
		</div>
	</div>