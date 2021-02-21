<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						<h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
						<span id="alertmessage"></span>
					</div>
				<?php endif; ?>
				<div class="row">
					<h4 class="col card-title">Daftar Universitas</h4>
					<button type="button" class="col-md-2 btn btn-success mt-10 mb-2 float-left" data-toggle="modal" data-target="#add-user"><i class="fas fa-plus mr-2"></i>Tambah Universitas</button>
				</div>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th>Nomor</th>
								<th>Nama Universitas</th>
								<th>Inisial Universitas</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($college['used_college'] as $row) : ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td><?php echo $row->college_name; ?></td>
									<td><?php echo $row->college_abbr; ?></td>
									<td class="text-center">
										<button id="open-modal" type="button" class="btn btn-sm waves-effect waves-light btn-warning"
														title="Ubah"
														data-id="<?php echo $row->college_id; ?>"
														data-name="<?php echo $row->college_name; ?>"
														data-inisial="<?php echo $row->college_abbr; ?>"
														data-toggle="modal"
														data-tt="tooltip"
														data-target="#edit-user">
											<i class="fas fa-pencil-alt"></i></button>
										<span data-toggle="tooltip" title="Tidak dapat dihapus karena sedang digunakan">
											<a href="<?php echo site_url() . 'college/delete_college/' . $row->college_id ?>"
													class="btn btn-danger btn-sm sa-hapus-college"
													 style="pointer-events: none;">
												<i class="fas fa-trash"></i></a>
										</span>
									</td>
								</tr>
							<?php
								$no++;
							endforeach; ?>
							<?php foreach ($college['not_used_college'] as $row) : ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $row->college_name; ?></td>
								<td><?php echo $row->college_abbr; ?></td>
								<td class="text-center">
									<button id="open-modal" type="button" class="btn btn-sm waves-effect waves-light btn-warning"
													title="Ubah"
													data-id="<?php echo $row->college_id; ?>"
													data-name="<?php echo $row->college_name; ?>"
													data-inisial="<?php echo $row->college_abbr; ?>"
													data-toggle="modal"
													data-tt="tooltip"
													data-target="#edit-user">
										<i class="fas fa-pencil-alt"></i></button>
									<a href="<?php echo site_url() . 'college/delete_college/' . $row->college_id ?>"
										 class="btn btn-danger btn-sm sa-hapus-college"
										 data-toggle="tooltip" title="Hapus">
										<i class="fas fa-trash"></i></a>
								</td>
							</tr>
							<?php
								$no++;
							endforeach; ?>
						</tbody>
					</table>
				</div>


				<!-- Modal add college -->
				<div id="add-user" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Tambah Data Universitas</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>college/insert_college" method="POST">
									<div class="form-group row ">
										<div class="col-12 ">
											<input class="form-control" type="text" required=" " placeholder="Nama Universitas" name="nama">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 ">
											<input class="form-control" type="text" required=" " placeholder="Inisial Universitas" name="inisial">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- Modal Edit college -->
				<div id="edit-user" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Edit Data Universitas</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post">
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Nama Universitas</label>
											<input id="modal-name" class="form-control" type="text" required=" " placeholder="Nama Universitas" name="name" value="">
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-12 ">
											<label>Inisial Univ</label>
											<input id="modal-inisial" class="form-control" type="text" required=" " placeholder="Inisial Universitas" name="inisial" value="">
										</div>
									</div>
									<div class="row d-flex">
										<div class="ml-auto mr-2">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- Modal Confirm Delete college -->
				<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Hapus Data Universitas</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- generate text ada di js-->
							</div>
							<div class="modal-footer">
								<div class="row d-flex">
									<div class="ml-auto mr-2">
										<a id="btn-confirm-delete" href="" class="btn btn-danger">Hapus</a>
										<button type="button" class="btn btn-outline-dart" data-dismiss="modal">Batal</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
