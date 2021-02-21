<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert p-3 mb-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <h5 id="alerttitle"></h5>
                        <span id="alertmessage"></span>
                        <i id="alerticon"></i>
                    </div>
                <?php endif; ?>
                <h2 class="card-title">Jadwal Training</h2>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Paket</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($scheds as $sched) {
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $sched->tclass_name ?></td>
                                    <td><?php echo $sched->tpack_name ?></td>
                                    <td><?php echo $sched->tsched_date ?></td>
                                    <td><?php echo date("h:i A", strtotime($sched->tsched_time_start)) ?>-<?php echo date("h:i A", strtotime($sched->tsched_time_finish)) ?></td>
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