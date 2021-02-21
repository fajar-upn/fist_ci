<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Detail Jawaban Seminar & Workshop</h4>
				<hr>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label text-center col-md-12">Pertanyaan</label>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label text-center col-md-12">Jawaban</label>
							</div>
						</div>
					</div>
					<!--/row-->
					<?php foreach ($details as $detail) : ?>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label"><?php echo $detail->wsfque_question; ?></label>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label ml-2"><?php echo $detail->wsfans_answer; ?></label>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>