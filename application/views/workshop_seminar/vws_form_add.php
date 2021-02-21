<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body wizard-content">
				<?php if (isset($is_edit)) : ?>

					<h4 class="card-title">Workshop atau Seminar</h4>
					<form id="form-ws" action="<?php echo base_url('workshop_seminar/update/') . $workshop_seminar->ws_id; ?>" class="validation-wizard wizard-circle m-t-40" method="post">

						<!-- Informasi Umum -->
						<h6>Informasi Umum</h6>
						<section>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> Judul </label>
										<input type="text" class="form-control required" placeholder="Judul workshop atau seminar" name="title" value="<?php echo $workshop_seminar->ws_title; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Tempat </label>
										<input type="text" class="form-control required" placeholder="Tempat pelaksanaan" name="place" value="<?php echo $workshop_seminar->ws_place; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-3">
									<label> Jenis Kegiatan </label>
									<select class="form-control" required name="type">
										<option value="seminar" selected>Seminar</option>
										<option value="workshop">Workshop</option>
									</select>
								</div>
								<div class="col-3">
									<label> Biaya </label>
									<input type="text" class="form-control" required placeholder="Biaya dalam rupiah" name="price" value="<?php echo $workshop_seminar->ws_price; ?>">
								</div>
								<div class="col-6">
									<div class="form-group">
										<label> Tanggal </label>
										<div class="row">
											<div class="col"><input type="text" class="form-control" required placeholder="Tanggal mulai" id="custom-date-start" name="date_start" value="<?php echo $workshop_seminar->ws_date_start; ?>"></div>
											<div class="col"><input type="text" class="form-control" required placeholder="Tanggal selesai" id="custom-date-end" name="date_end" value="<?php echo $workshop_seminar->ws_date_done; ?>"></div>
										</div>
									</div>
									<div class="form-group">
										<label> Waktu </label>
										<div class="row">
											<div class="col"><input type="text" class="form-control" required placeholder="Waktu mulai" id="time-start" name="time_start" value="<?php echo $workshop_seminar->ws_time_start; ?>"></div>
											<div class="col"><input type="text" class="form-control" required placeholder="Waktu selesai" id="time-end" name="time_end" value="<?php echo $workshop_seminar->ws_time_done; ?>"></div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- Deskripsi -->
						<h6>Deskripsi</h6>
						<section>
							<div class="form-group row">
								<textarea id="mymce" name="description"><?php echo $workshop_seminar->ws_desc; ?></textarea>
							</div>
						</section>

						<!-- Pembicara -->
						<h6>Pembicara</h6>
						<section>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Pembicara</label>
										<input type="text" class="form-control required" placeholder="Nama pembicara" name="name" value="<?php echo $workshop_seminar->wsspeaker_name; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Identitas</label>
										<input type="text" class="form-control required" placeholder="Identitas pembicara" name="identity" value="<?php echo $workshop_seminar->wsspeaker_identity; ?>">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Topik</label>
										<textarea class="form-control required" name="theory"><?php echo $workshop_seminar->wsspeaker_theory; ?></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" value="<?php echo $workshop_seminar->wsspeaker_id; ?>" name="wsspeaker_id">
						</section>

						<!-- Registrasi -->
						<h6>Registrasi Peserta</h6>
						<section>
							<div id="user-data" class="form-group">
								<?php $id = 1; ?>
								<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
									<div id="alerttype" class="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
										<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
										<span id="alertmessage"></span>
									</div>
								<?php endif; ?>
								<?php foreach ($workshop_question as $val) : ?>
									<?php if ($id <= 4) : ?>
										<input type="hidden" id="question-id_<?php echo $id; ?>" value="<?php echo $val['question_id']; ?>" name="question_id[]">
										<div id="qid_<?php echo $id; ?>" class="m-b-15">
											<div class="row">

												<!-- Question -->
												<div class="col-sm-8">
													<div class="form-group">
														<input type="text" class="form-control" id="question<?php echo $id; ?>" name="question[]" placeholder="Pertanyaan" value="<?php echo $val['question']; ?>" readonly>
													</div>
												</div>

												<!-- Type selection -->
												<div class="col-sm-2">
													<div class="form-group">
														<select class="form-control type-question" name="type_question[]" readonly="">
															<option value="text" selected>Jawaban Singkat</option>
														</select>
													</div>
												</div>

												<!-- Page selection -->
												<div class="col-sm-1">
													<div class="form-group">
														<select class="form-control page-question" name="page[]" readonly="">
															<option value="1" selected>1</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									<?php else: ?>
										<input type="hidden" id="question-id_<?php echo $id; ?>" value="<?php echo $val['question_id']; ?>" name="question_id[]">
										<div id="qid_<?php echo $id; ?>" class="m-b-15 row">
											<!-- Question -->
											<div class="col-sm-8">
												<div class="form-group">
													<input type="text" class="form-control" id="question<?php echo $id; ?>" name="question[]" placeholder="Pertanyaan" value="<?php echo $val['question']; ?>">
												</div>
											</div>

											<!-- Type selection -->
											<div class="col-sm-2">
												<div class="form-group">
													<select class="form-control type-question" name="type_question[]">
														<?php foreach ($qtypes as $key => $qtype) : ?>
															<?php if (strcmp($val['question_type'], "$key") == 0) : ?>
																<option value='<?php echo "$key"; ?>' selected><?php echo $qtype; ?></option>
															<?php else : ?>
																<option value='<?php echo "$key"; ?>'><?php echo $qtype; ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													</select>
												</div>
											</div>

											<!-- Page selection -->
											<div class="col-sm-1">
												<div class="form-group">
													<select class="form-control page-question" name="page[]" readonly="">
														<?php foreach ($pages as $key => $page) : ?>
															<?php if ($val['page'] == $page) : ?>
																<option value="<?php echo $page; ?>" selected><?php echo $page; ?></option>
															<?php else : ?>
																<option value="<?php echo $page; ?>"><?php echo $page; ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-md-1"><button id="<?php echo $id; ?>" class="btn btn-danger waves-effect waves-light btn-delete-question" type="button"><i class="ti-close"></i></button></div>

											<!-- Question option -->
											<?php if ( !(strcmp($val['question_type'], "text")  == 0 or
													strcmp($val['question_type'], "textarea") == 0)) : ?>
												<div id="question-option_<?php echo $val['question_id']; ?>" class="col-md-8 ml-3 get-question-option">
													<div class="form-group">
														<input type="text" class="form-control" style="border:0" placeholder="tambah opsi" name="question_option[]" value="<?php echo $val['option']['option_text']; ?>">
														<input type="hidden" name="question_option_id[]" value="<?php echo $val['option']['option_id']; ?>">
													</div>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php $id++; ?>
								<?php endforeach; ?>
								<input type="hidden" id="list_delete_question" name="list_delete_question">
							</div>
							<button id="add-question" class="btn btn-success waves-effect waves-light" type="button"><i class="fa fa-plus pr-2"></i> Tambah Pertanyaan</button>
							<input type="hidden" id="last_id" value="<?php echo $id; ?>">
						</section>

					</form>
				<?php else : ?>

					<h4 class="card-title">Workshop atau Seminar</h4>
					<form id="form-ws" action="<?php echo base_url('workshop_seminar/insert/ws_add'); ?>" class="validation-wizard wizard-circle m-t-40" method="post">

						<!-- Informasi Umum -->
						<h6>Informasi Umum</h6>
						<section>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> Judul </label>
										<input type="text" class="form-control required" placeholder="Judul workshop atau seminar" name="title">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Tempat </label>
										<input type="text" class="form-control required" placeholder="Tempat pelaksanaan" name="place">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-3">
									<label> Jenis Kegiatan </label>
									<select class="form-control" required name="type">
										<option value="seminar" selected>Seminar</option>
										<option value="workshop">Workshop</option>
									</select>
								</div>
								<div class="col-3">
									<label> Biaya </label>
									<input type="text" class="form-control" required placeholder="Biaya dalam rupiah" name="price">
								</div>
								<div class="col-6">
									<div class="form-group">
										<label> Tanggal </label>
										<div class="row">
											<div class="col"><input type="text" class="form-control" required placeholder="Tanggal mulai" id="custom-date-start" name="date_start"></div>
											<div class="col"><input type="text" class="form-control" required placeholder="Tanggal selesai" id="custom-date-end" name="date_end"></div>
										</div>
									</div>
									<div class="form-group">
										<label> Waktu </label>
										<div class="row">
											<div class="col"><input type="text" class="form-control" required placeholder="Waktu mulai" id="time-start" name="time_start"></div>
											<div class="col"><input type="text" class="form-control" required placeholder="Waktu selesai" id="time-end" name="time_end"></div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<!-- Deskripsi -->
						<h6>Deskripsi</h6>
						<section>
							<div class="form-group row">
								<textarea id="mymce" name="description"></textarea>
							</div>
						</section>

						<!-- Pembicara -->
						<h6>Pembicara</h6>
						<section>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Pembicara</label>
										<input type="text" class="form-control required" placeholder="Nama pembicara" name="name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Identitas</label>
										<input type="text" class="form-control required" placeholder="Identitas pembicara" name="identity">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Topik</label>
										<textarea class="form-control required" name="theory"></textarea>
									</div>
								</div>
							</div>
						</section>

						<!-- Registrasi -->
						<h6>Registrasi Peserta</h6>
						<section>
							<div id="user-data" class="form-group">
								<?php $id = 1; ?>
								<?php foreach ($workshop_question as $val) : ?>
								<input type="hidden" id="question-id_<?php echo $id; ?>" value="<?php echo $val['question_id']; ?>" name="question_id[]">
								<div id="qid_<?php echo $id; ?>" class="m-b-15">
									<div class="row">

										<!-- Question -->
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" class="form-control" id="question<?php echo $id; ?>" name="question[]" placeholder="Pertanyaan" value="<?php echo $val['question']; ?>" readonly>
											</div>
										</div>

										<!-- Type selection -->
										<div class="col-sm-2">
											<div class="form-group">
												<select class="form-control type-question" name="type_question[]" readonly="">
													<option value="text" selected>Jawaban Singkat</option>
												</select>
											</div>
										</div>

										<!-- Page selection -->
										<div class="col-sm-1">
											<div class="form-group">
												<select class="form-control page-question" name="page[]" readonly="">
													<option value="1" selected>1</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<?php $id++; ?>
								<?php endforeach; ?>
							</div>
							<button id="add-question" class="btn btn-success waves-effect waves-light" type="button"><i class="fa fa-plus pr-2"></i> Tambah Pertanyaan</button>
							<input type="hidden" id="last_id" value="<?php echo $id; ?>">
						</section>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
