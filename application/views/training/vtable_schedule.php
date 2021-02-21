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
                <h2 class="card-title">Jadwal Training</h2>
                <div class="p-20 mt-4">
                    <h5>Kelas : <?php echo $detail->tclass_name ?></h5>
                    <h5>Paket : <?php echo $detail->tpack_name ?></h5>
                </div>
                <div class="text-right">
                    <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training/form_schedule/' . $id . '/0' ?>"><i class="fas fa-plus mr-2"></i>Tambah Jadwal</a>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($scheds as $sched) {
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $sched->tsched_date ?></td>
                                    <td><?php echo date("h:i A", strtotime($sched->tsched_time_start)) ?> - <?php echo date("h:i A", strtotime($sched->tsched_time_finish)) ?></td>
                                    <td>
                                        <center>
                                            <a href="<?php echo site_url() . 'training/form_schedule/' . $id . '/' . $sched->tsched_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/deleteSchedule/' . $sched->tsched_id . '/' . $id ?>" class="btn-sm waves-effect waves-light btn-danger delete" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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
                    <a href="<?php echo site_url() . 'Training' ?>" class="btn waves-effect waves-light btn-dark" data-toggle="tooltip"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>