<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>dev_calculator" class="btn btn-success"><i class="fa fa-plus"></i> Kontrak</a>
					</div>
				</div>
				<div class="table-responsive table-striped m-t-15">
				<table class="table product-overview" id="zero_config">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Agensi</th>
                            <th>Nama Aplikasi</th>
                            <th>Pembayaran</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($cek as $c) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $c->file_agency ?></td>
                            <td><?php echo $c->contract_appname ?></td>
                            <td><?php echo $c->total_payment == NULL ? rupiah(0). ' / ' . rupiah($c->contract_price) : rupiah($c->total_payment) . ' / ' . rupiah($c->contract_price) ?></td>
                            <td><?php echo $c->total_feature_selesai == NULL ? '0'. '/' . $c->total_feature : $c->total_feature_selesai . '/' . $c->total_feature ?></td>
                            <td>
                                <a href="<?=base_url('dev_monitoring/contract/') . $c->contract_id?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Monitoring Progress" data-toggle="tooltip">
                                <i class="fas fa-tasks"></i>
                                </a>
                                <a href="<?php echo base_url() ?>dev_contract/form/<?php echo $c->contract_id?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url() ?>dev_contract/delete/<?php echo $c->contract_id?>" class="btn btn-danger btn-sm" title="Hapus" data-toggle="tooltip" alt="alert" id="sa-hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        }
                        ?>       
                    </tbody>
                </table>
				</div>
			</div>
		</div>
	</div>
</div>