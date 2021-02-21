<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<form action="<?php echo base_url('Development/insert_data') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-body">
                                <h4 class="card-title m-b-20">Data Personal</h4>
                                <div class="form-group">
                                    <label class="control-label">Nama Lengkap</label>
                                    <input required type="text" class="form-control" name="uprof_full_name" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="email1" class="control-label">Email</label>
                                    <input required type="email" class="form-control" name="uacc_email" placeholder="Email">
                                </div>
                                <div class="form-group m-b-30">
                                    <label for="cono1" class="control-label">No HP</label>
                                    <input required type="text" class="form-control" name="uprof_phone" placeholder="No HP">
                                </div>
                                <hr>
                                <h4 class="card-title m-b-20">Berkas</h4>
                                <div class="form-group">
                                    <label for="com1" class="control-label">Nama Perusahaan</label>
                                    <input required type="text" class="form-control" name="dfiles_agency" id="com1" placeholder="Nama Perusahaan">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Pilih File</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input required type="file" class="form-control" placeholder="file dalam bentuk zip" id="zip" name="zip" value="<?= set_value('zip'); ?>">
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group m-b-30">
                                    <label for="abpro" class="control-label">Deskripsi Aplikasi</label>
                                    <input required type="text" class="form-control" name="dfiles_appdesc" id="abpro" placeholder="Deskripsi Aplikasi">
                                </div>
							</div>
                            <hr>
							<div align="right" class="form-actions m-t-30">
							    <a href="<?php echo base_url() ?>development/readData" type="button" class="btn btn-secondary waves-effect">Batal</a>
								<button type="submit" class="btn btn-success">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>