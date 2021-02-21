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
                <h2 class="card-title">Riwayat Pembayaran</h2>
                <div class="p-20 mt-4">
                    <h5>Nama : <?php echo $detail->client_name ?></h5>
                    <h5>Paket : <?php echo $detail->tpack_name ?></h5>
                    <h5>Jumlah Tagihan : <?php echo "Rp" . number_format($detail->tptype_price - $detail->tcontr_discount, 2, ',', '.'); ?></h5>
                    <h5>Sisa Tagihan : <?php echo "Rp" . number_format($detail->tptype_price - $detail->tcontr_discount - $pymt->tpymt_total, 2, ',', '.'); ?></h5>
                </div>
                <div class="text-right">
                    <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training/form_payment/' . $classId . '/' . $id . '/0' ?>"><i class="fas fa-plus mr-2"></i>Tambah Pembayaran</a>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Kwitansi</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pymts as $pymt) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td><?php echo $pymt->tpymt_date ?></td>
                                    <td><?php echo $pymt->tpymt_receipt ?></td>
                                    <td><?php echo $pymt->tpymt_detail ?></td>
                                    <td><?php echo "Rp " . $pymt->tpymt_amt ?></td>
                                    <td><?php echo $pymt->tpymt_admin ?></td>
                                    <td>
                                        <center>
                                            <a href="<?php echo site_url() . 'training/form_payment/' . $classId . '/' . $id . '/' . $pymt->tpymt_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/deletePayment/' . $classId . '/' . $id . '/' . $pymt->tpymt_id ?>" class="btn-sm waves-effect waves-light btn-danger delete" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        </center>
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
                    <a href="<?php echo site_url() . 'Training/table_participant/' . $classId ?>" class="btn waves-effect waves-light btn-dark" data-toggle="tooltip"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>