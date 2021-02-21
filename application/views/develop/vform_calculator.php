<div class = "row">
	<div class = "col-lg-12">
		<div class = "card">
			<div class = "card-body">
				<h4  class = "card-title">Kalkulator Biaya</h4>
				<div   class = "control-group after-add-more">
					<div   class = "form-group">
						<label class="control-label">Nama Fitur</label>
						<input type  = "text" class = "form-control" id = "nama-fitur" name = "nama-fitur" placeholder = "">
					</div>
					<div>
						<label class="control-label">Tingkat Kesulitan</label>
						<select name = "dmodules_id" id = "kesulitan" class = "form-control">
						<option disabled = "" selected>Pilih Tingkat Kesulitan...</option>
						<?php foreach($dificulties as $f): ?>
							<option value = "<?php echo $f->dmodules_id ?>">
								<?php echo $f->dmodules_difficulties ?>
							</option>
						<?php endforeach ?>
						</select>
					</div>
					<div id = "dom-target" style = "display: none;"></div>
				</div>
				<div class="m-t-20">			
					<button id = 'btn-tambah' class = "btn btn-success waves-effect waves-light"> <i class = "fa fa-plus"></i> Tambah</button>
				</div>
				<hr>
				<div class = "d-flex no-block align-items-center">
					<div    class = "ml-auto">
						<button type  = "button" id = 'btn-hapus-semua-fitur' class = "btn btn-danger"><i class = "fa fa-trash"></i> Hapus Semua</button>
					</div>
				</div>
				<div   class = "table-responsive table-striped m-t-15">
					<table class = "table product-overview" id = "zero_config">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Fitur</th>
								<th>Tipe Modul</th>
								<th>Rentang Harga</th>
								<th>Rentang Waktu</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id = 'table-fitur'>
							
						</tbody>
					</table>
				</div>
				<hr>
				<h4  class = "card-title">Submit Kontrak</h4>
				<form class="form" id="form-submit" action="<?=base_url('dev_calculator/insert')?>" method="POST" enctype="multipart/form-data">
					<div  class  = "form-body">
					
						<div class = "form-group">
							<label class="control-label">Nama Agency</label>
							<select name = "dcontr_files_fk" id="dcontr_files_fk" class = "form-control">
							<option disabled = "" selected value='0'>Pilih Agency...</option>
							<?php foreach($dev_files as $r): ?>
								<option value = "<?php echo $r->dfiles_id ?>">
									<?php echo $r->dfiles_agency ?>
								</option>
							<?php endforeach ?>
							</select>
						</div>

						<div   class = "form-group">
							<label class = "control-label">Nama Aplikasi</label>
							<input type  = "text" class = "form-control" id = "dcontr_appname" name = "dcontr_appname" placeholder = "Nama Aplikasi" >
						</div>

						<div   class = "form-group">
							<label class = "control-label">Tanggal Kontrak</label>
							<input type  = "date" class = "form-control" id = "dcontr_date" name = "dcontr_date" placeholder = "Tanggal Kontrak" >
						</div>
								
						<div   class = "form-group">
							<label class = "control-label">Harga Kontrak</label>
							<input type  = "number" class = "form-control" id = "dcontr_price" name = "dcontr_price" placeholder = "Harga Kontrak" >
						</div>
						<div   class = "form-group">
							<label class = "control-label">Durasi Kontrak</label>
							<input type  = "number" class = "form-control" id = "dcontr_duration" name = "dcontr_duration" placeholder = "Durasi Kontrak" >
						</div>
								
						<div class = "form-group">
							<label class = "control-label">Pilih File Kontrak</label>
							<input type="file" class="custome file-input" name="zip" id="zip">
						</div>
						<input type = "hidden" name = "dcontr_id" >
						<input type = "hidden" name = "simpan_data" value = "simpan">
					</div>
					<hr>
					<div align="right" class="form-actions m-t-30">
						<a href="<?php echo base_url() ?>dev_contract" type="button" class="btn btn-secondary waves-effect">Batal</a>
						<button id="btn-submit" type="submit" class="btn btn-success">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>