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
                    <div class="col-md">
                        <h2 class="card-title text-center">Kelas <?php echo $details->tclass_name ?></h2>
                        <div class="">
                            <h5>Tentor : <?php echo $details->uprof_full_name ?></h5>
                            <h5>Paket : <?php echo $details->tpack_name ?></h5>
                        </div>
                        <?php if ($details->tclass_status != 3) : ?>
                            <div class="text-right">
                                <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training/form_participant/' . $id . '/0'  ?>"><i class="fas fa-plus mr-2"></i> Tambah Peserta</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Nama Instansi/Kampus</th>
                                <th>Total Tagihan</th>
                                <th>Sisa Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($participant as $part) {
                                $total = "Rp" . number_format($part->tptype_price - $part->tcontr_discount, 2, ',', '.');
                                $sisa = "Rp" . number_format($part->tptype_price - $part->tcontr_discount - $part->total_payment, 2, ',', '.');
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $part->client_name ?></td>
                                    <td><?php echo $part->uprof_institution ?></td>
                                    <td><?php echo $total ?></td>
                                    <td><?php echo $sisa ?></td>
                                    <td>
                                        <?php if ($details->tclass_status != 3) : ?>
                                            <a href="<?php echo site_url() . 'Training/table_payment/' . $part->tclass_id . '/' . $part->tcontr_id  ?>" class="btn-sm waves-effect waves-light btn-info" title="Detil Pembayaran" data-toggle="tooltip"><i class="fa fa-credit-card"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_contract/' . $part->tclass_id . '/' . $part->tcontr_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Detil Kontrak" data-toggle="tooltip"><i class="far fa-user"></i></a>
                                            <a href="<?php echo site_url() . 'Training/form_participant/' . $part->tclass_id . '/' . $part->client_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                        <?php else : ?>
                                            <a href="<?php echo site_url() . 'Training/table_payment/' . $part->tclass_id . '/' . $part->tcontr_id  ?>" class="btn-sm waves-effect waves-light btn-info" title="Detil Pembayaran" data-toggle="tooltip"><i class="fa fa-credit-card"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_contract/' . $part->tclass_id . '/' . $part->tcontr_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Detil Kontrak" data-toggle="tooltip"><i class="far fa-user"></i></a>
                                            <a href="<?php echo site_url() . 'Training/form_participant/' . $part->tclass_id . '/' . $part->client_id ?>" class="btn-sm waves-effect waves-light btn-warning edit-disable" title="Ubah" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <hr>
                    <a href="<?php echo site_url() . 'Training' ?>" class="btn waves-effect waves-light btn-dark" data-toggle="tooltip"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>