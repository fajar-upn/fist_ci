<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert p-3 mb-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <h5 id="alerttitle"><i id="alerticon" class="mx-1"></i></h5>
                        <span id="alertmessage"></span>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md">
                        <h2 class="card-title">Daftar Periode Paket</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <a href="<?php echo site_url() . 'package'; ?> " type="submit" class="btn btn-outline-dark waves-effect waves-light">kembali</a>
                            <a href="<?php echo site_url() . 'package/form_periode' ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Periode</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="">No.</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Periode Aktif</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($Pperiode as $row) :
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row->scperiod_desc; ?></td>
                                    <td><?php echo $row->scperiod_year; ?></td>
                                    <td><?php echo $row->scperiod_active; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url() . 'package/form_periode/' . $row->scperiod_id; ?>" title="Edit" data-toogle="tooltip" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?php echo site_url() . 'package/deletePeriode/' . $row->scperiod_id; ?>" title="Hapus" data-toogle="tooltip" class="btn btn-danger btn-sm sa-hapus">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>