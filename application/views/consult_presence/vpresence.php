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
                <h2 class="card-title">Data Presensi Konsultasi</h2>
                <?php if ($this->session->flashdata('notif')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data presensi <strong>berhasil</strong> <?= $this->session->flashdata('notif') ;?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif; ?>
                <div class="row">
                    
                    <div class="col-md">
                        <div class="text-right">
                        <?php if ($user_role == 2 || $user_role == 3) { ?>
                        <a href="<?php echo site_url() . 'Consult_presence/form/0' ?>" class="btn waves-effect waves-light btn-success">Tambah</a>
                         <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="">No.</th>
                                <th scope="col">Nama Tentor / Mahasiswa</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Mulai</th> 
                                <th scope="col">Selesai</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($schedule as $Consult_presence) : ?>
                                <tr class="text-center" id = "<?php $Consult_presence->scattd_id ?>">
                                <td><?php echo $no ?></td>
                                <td><?php echo $Consult_presence->tentor ?><br><?php echo $Consult_presence->mahasiswa ?></td>
                                <td><?php echo $Consult_presence->scattd_date ?></td>
                                <td><?php echo $Consult_presence->scattd_time_start ?></td>
                                <td><?php echo $Consult_presence->scattd_time_end ?></td>
                                <td><?php echo $Consult_presence->scattd_status ?></td>
                                <td>
                                    <?php if ($user_role == 2 || $user_role == 3) { ?>

                                        <a href="<?php echo site_url() . '/Consult_presence/form/' . $Consult_presence->scattd_id ?>" class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?php echo site_url() . '/Consult_presence/delete/' . $Consult_presence->scattd_id ?>" class="btn btn-danger remove">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php }; ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>