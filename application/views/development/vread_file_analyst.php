<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Submit File Develop</h4>
                <table class="table">
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
                        $no = 1;
                        foreach ($files as $row) : ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $row->dfiles_agency ?></td>

                                <?php if ($row->dfiles_status == 'y') { ?>
                                    <td>
                                        <button disabled class="btn-outline-success rounded-pill px-3">
                                        Sudah dicek
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('development/download/') . $row->dfiles_id ?>"><i class="fas fa-arrow-circle-down"></i></a>
                                        <a class="btn btn-sm btn-danger" href="<?php echo base_url('development/uncheck/') . $row->dfiles_id ?>"><i class="fas fa-window-close"></i></a>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <button disabled class="btn-outline-danger rounded-pill px-3">
                                        Belum dicek
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('development/download/') . $row->dfiles_id ?>"><i class="fas fa-arrow-circle-down"></i></a>
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url('development/check/') . $row->dfiles_id ?>"><i class=" fas fa-check"></i></a>
                                    </td>
                                <?php } ?>

                            </tr>
                        <?php $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>