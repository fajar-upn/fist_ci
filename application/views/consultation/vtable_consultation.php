<div class="row">
    <div class="col-12">
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
                        <h2 class="card-title">Daftar Pengajuan</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <?php
                            $role = $this->session->userdata("role");
                            $uacc_id = $this->session->userdata("id");
                            $profile = $this->muser_profile->get_profile_by_id($uacc_id);
                            if ($role == 2 || $role == 5) {
                                if ($profile) { ?>
                                    <a href="<?php echo site_url() . 'consultation/form' ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Tambah pengajuan</a>

                                <?php } else { ?>
                                    <a href="<?php echo site_url() . 'user_management/account_profile/0' ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Lengkapi profile</a>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>


                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Paket</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $row) :
                                $delMessage = "Apakah anda yakin ingin menghapus pengajuan : " . $row->scons_thesis_title . "?"; ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo $row->uprof_full_name; ?> </td>
                                    <td><?php echo $row->scons_thesis_title; ?></td>
                                    <td><?php echo $row->scpack_code; ?></td>
                                    <td><?php echo $row->scperiod_desc; ?></td>
                                    <td><?php echo $row->scperiod_year; ?></td>
                                    <td class="text-center">
                                        <?php if ($row->sstatus_id == 1) : ?>
                                            <span class="col-md-10 label label-warning"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php elseif ($row->sstatus_id == 2) : ?>
                                            <span class="col-md-10 label label-danger"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php elseif ($row->sstatus_id == 3) : ?>
                                            <span class="col-md-10 label label-info"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php elseif ($row->sstatus_id == 4) : ?>
                                            <span class="col-md-10 label label-primary"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php elseif ($row->sstatus_id == 5) : ?>
                                            <span class="col-md-10 label label-success"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php elseif ($row->sstatus_id == 6) : ?>
                                            <span class="col-md-10 label label-inverse"><b><?php echo $row->sstatus_desc; ?></b></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $role = $this->session->userdata("role");
                                        //button for access file
                                        if ($role == '2' || $role == '3' || $role == '4' || $role == '5' || $role == '6' || $role == '7') :
                                        ?>
                                            <a href="<?php echo site_url() . 'files/index/' . $row->scons_id ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Files">
                                                <i class="far fa-list-alt"></i>
                                            </a>
                                        <?php endif ?>

                                        <?php
                                        //button for access edit consultation
                                        if ($role == '3' || $role == '7') : //button for role 3 & 7 (admin and pimpinan)
                                        ?>
                                            <a href="<?php echo site_url() . 'consultation/form/' . $row->scons_id; ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        <?php
                                        elseif ($role == '2') : //button for role 2 (developer)
                                        ?>
                                            <a href="<?php echo site_url() . 'consultation/form/' . $row->scons_id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Preview">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        <?php
                                        elseif ($role == '4') : //button for role 4 (analis) 
                                        ?>
                                            <?php if ($row->sstatus_id == '1' || $row->sstatus_id == '4') : ?>
                                                <a href="<?php echo site_url() . 'consultation/form/' . $row->scons_id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif ?>
                                        <?php
                                        elseif ($role == '5') : //button for role 5 (client) 
                                        ?>
                                            <?php if ($row->sstatus_id == '3' || $row->sstatus_id == '6') : ?>
                                                <a href="<?php echo site_url() . 'consultation/form/' . $row->scons_id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>

                                        <!-- button analyst schedule -->
                                        <?php if ($role == '4' || $role == '3') : ?>
                                            <?php if ($row->sstatus_id == '4') : ?>
                                                <a href="<?php echo site_url() . 'consultation/schedule/' . $row->scons_id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Penjadwalan">
                                                    <i class="fas fa-calendar-times"></i>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>

                                        <!-- Button Delete Role Admin-->
                                        <?php if ($role == '3') : ?>
                                            <?php if ($row->sstatus_id == '2') : ?>
                                                <a href="<?php echo site_url() . 'consultation/delete/' . $row->scons_id; ?>" class="btn btn-danger btn-sm sa-delete-cns" data-toggle="tooltip" title="Hapus Pengajuan">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>

                                        <!-- Button Delete Role Developer-->
                                        <?php if ($role == '2') : ?>
                                            <a href="<?php echo site_url() . 'consultation/delete/' . $row->scons_id; ?>" class="btn btn-danger btn-sm sa-delete-cns" data-toggle="tooltip" title="Hapus Pengajuan">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?php if ($row->sstatus_id == '4') : ?>
                                                <a href="<?php echo site_url() . 'consultation/schedule/' . $row->scons_id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Penjadwalan">
                                                    <i class="fas fa-calendar-times"></i>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>

                                    </td>
                                    <?php $no++; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>