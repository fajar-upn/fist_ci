<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title">Detail Contract Development</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="300"><b>Nama Agency</b></td>
                                    <td> <?php echo $contract->file_agency ?> </td>
                                </tr>
                                <tr>
                                    <td><b>Nama Aplikasi</b></td>
                                    <td> <?php echo $contract->contract_appname ?> </td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Kontrak</b></td>
                                    <td> <?php echo $contract->contract_date ?> </td>
                                </tr>
                                <tr>
                                    <td><b>Harga Kontrak</b></td>
                                    <td> <?php echo rupiah($contract->contract_price) ?> </td>
                                </tr>
                                <tr>
                                    <td><b>Progress</b></td>
                                    <td><?php echo $contract->total_feature_selesai == NULL ? '0'. '/' . $contract->total_feature : $contract->total_feature_selesai . '/' . $contract->total_feature ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title">Detail Fitur</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>No.</th>
                                <th>Nama Fitur</th>
                                <th>Tingkat Kesulitan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($features as $f) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $f->dfeature_name ?></td>
                                        <td><?php echo $f->dmodules_difficulties ?></td>
                                        
                                        <?php if ($f->dfeature_done) { ?>
                                        <td>
                                            <button disabled class="btn-outline-success rounded-pill px-3">
                                                Selesai
                                            </button>                                            
                                        </td>
                                        <td>
                                        <a href="<?=base_url('dev_monitoring/changeFeatureStatus/') . $contract->contract_id . '/'. $f->dfeature_id ?>" class="btn btn-sm waves-effect waves-light btn-danger" title="Uncheck" data-toggle="tooltip">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                            <button disabled class="btn-outline-danger rounded-pill px-3">
                                                Belum Selesai
                                            </button>
                                        </td>
                                        <td>
                                        <a href="<?=base_url('dev_monitoring/changeFeatureStatus/') . $contract->contract_id . '/'. $f->dfeature_id ?>" class="btn btn-sm waves-effect waves-light btn-success" title="Check" data-toggle="tooltip">
                                            <i class="fas fa-check-square"></i>
                                        </a>
                                        </td>
                                        <?php } ?>                                    
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="m-t-30">
                    <a href="<?php echo base_url() ?>dev_contract" type="button" class="btn btn-secondary waves-effect">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>