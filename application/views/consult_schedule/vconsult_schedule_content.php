<!-- Row -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Lihat Jadwal Tentor</h4>
				<select class="form-control" id="select-mentor" style="width: 100%; height:10px;">
					<option selected disabled>Pilih nama mentor</option>
					<?php foreach ($mentor as $row): ?>
						<?php if ($row->uacc_active == 1 && $row->uacc_suspend == 0): ?>
						<option value="<?php echo $row->uacc_id ?>"><?php echo $row->uprof_full_name ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
</div>
<!-- End Row -->
<div id="content-spinner">
	<div class="lds-ripple">
		<div class="lds-pos"></div>
		<div class="lds-pos"></div>
	</div>
</div>
<!-- Row -->
<div class="row" id="cal-content">
	<!-- Column -->
	<div class="col-sm-12 col-md-4">
		<div class="card">
			<div id="list-class-spinner">
				<div class="lds-ripple">
					<div class="lds-pos"></div>
					<div class="lds-pos"></div>
				</div>
			</div>
			<div class="card-body">
				<h4 class="card-title" id="title-table-class">Kelas Berlangsung</h4>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama Mhs</th>
							<th>Paket</th>
							<th>Total Sesi</th>
							<th>Dijadwalkan</th>
						</tr>
					</thead>
					<tbody id="list-class">
						<tr>
							<td colspan="4" class="text-center">Tidak Ada Data Ditampilkan</td>
						</tr>
					</tbody>
				</table>
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>consult_class" class="btn btn-info m-t-20"><i class="fa fa-eye"></i> Lihat Semua Kelas</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<div class="col-sm-12 col-md-8">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title" id="title-calendar">Jadwal Konsultasi </h4>
				<div class="card-body b-l calender-sidebar">
					<div id="calendar"></div>
				</div>
			</div>
			<div id="cal-spinner">
				<div class="lds-ripple">
					<div class="lds-pos"></div>
					<div class="lds-pos"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Row -->
<!-- BEGIN MODAL -->
<div class="modal none-border" id="my-event">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger delete-event waves-effect waves-light">Hapus</button>
				<button type="button" class="btn btn-success save-event waves-effect waves-light"> <i class="fa fa-check"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->
