<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
            
				<div class="d-flex no-block align-items-center">
					<div class="ml-auto">
						<a href="<?php echo base_url() ?>development" class="btn btn-success"><i class="fa fa-plus"></i> Berkas</a>
					</div>
				</div>
                <div class="table-responsive table-striped m-t-15">
				<table class="table product-overview" id="zero_config">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Instansi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1;
        foreach ($files as $row): ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->dfiles_agency ?></td>
                <?php if($row->dfiles_status=='y'){?>
                    <td>
                        <button disabled class="btn-outline-success rounded-pill px-3">
                        Sudah dicek
                        </button>
                    </td>
                <?php } else{ ?>
                    <td>
                        <button disabled class="btn-outline-danger rounded-pill px-3">
                        Belum dicek
                        </button>
                    </td>
                <?php } ?>
                <td><a class="btn btn-sm btn-info" href="<?php echo base_url('development/download/') . $row->dfiles_id ?>"><i class="fas fa-arrow-circle-down"></i></a></td>
                
            </tr>
            <?php $no++; endforeach ?>
    </tbody>
</table>
</div>
            </div>
        </div>
    </div>
</div>
</div>