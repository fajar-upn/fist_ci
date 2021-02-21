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
                        <h2 class="card-title">Daftar Kelas</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training/form_class' ?>"><i class="fas fa-plus mr-2"></i> Tambah Kelas</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Nama Mentor</th>
                                <th>Nama Paket</th>
                                <th>Pertemuan</th>
                                <th>Status Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($class as $class) : ?>
                                <tr class="text-center">
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo $class->tclass_name ?></td>
                                    <td><?php echo $class->uprof_full_name ?></td>
                                    <td><?php echo $class->tpack_name . ' - ' . $class->tptype_name ?></td>
                                    <?php if ($class->total == NULL) : ?>
                                        <td><?php echo "0/" . $class->tpack_meeting ?></td>
                                    <?php else : ?>
                                        <td><?php echo $class->total . "/" . $class->tpack_meeting ?></td>
                                    <?php endif ?>
                                    <td>
                                        <?php if ($class->tclass_status == 1) : ?>
                                            <button type="button" class="btn btn-outline-info rounded-pill" disabled>Belum Berlangsung</button>
                                        <?php elseif ($class->tclass_status == 2) : ?>
                                            <button type="button" class="btn btn-outline-success rounded-pill" disabled>Sedang Berlangsung</button>
                                        <?php elseif ($class->tclass_status == 3) : ?>
                                            <button type="button" class="btn btn-outline-danger rounded-pill" disabled>Sudah Selesai</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($class->tclass_status == 1) : ?>
                                            <a href="<?php echo site_url() . 'Training_Presence/get/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-success" title="Presensi" data-toggle="tooltip"> <i class="fa fa-calendar-check"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_schedule/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-info" title="Jadwal Kelas" data-toggle="tooltip"><i class="fa fa-calendar-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_participant/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Daftar Peserta" data-toggle="tooltip"><i class="far fa-list-alt"></i></i></a>
                                            <a href="<?php echo site_url() . 'Training/form_class/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/deleteClass/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-danger delete" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        <?php elseif ($class->tclass_status == 2) : ?>
                                            <a href="<?php echo site_url() . 'Training_Presence/get/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-success" title="Presensi" data-toggle="tooltip"> <i class="fa fa-calendar-check"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_schedule/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-info" title="Jadwal Kelas" data-toggle="tooltip"><i class="fa fa-calendar-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_participant/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Daftar Peserta" data-toggle="tooltip"><i class="far fa-list-alt"></i></i></a>
                                            <a href="<?php echo site_url() . 'Training/form_class/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="" class="btn-sm waves-effect waves-light btn-danger delete-disable" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        <?php elseif ($class->tclass_status == 3) : ?>
                                            <a href="<?php echo site_url() . 'Training_Presence/get/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-success" title="Presensi" data-toggle="tooltip"> <i class="fa fa-calendar-check"></i></a>
                                            <a href="" class="btn-sm waves-effect waves-light btn-info sched-disable" title="Jadwal Kelas" data-toggle="tooltip"><i class="fa fa-calendar-alt"></i></a>
                                            <a href="<?php echo site_url() . 'Training/table_participant/' . $class->tclass_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Daftar Peserta" data-toggle="tooltip"><i class="far fa-list-alt"></i></i></a>
                                            <a href="" class="btn-sm waves-effect waves-light btn-warning edit-disable" title="Ubah" data-toggle="tooltip"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="" class="btn-sm waves-effect waves-light btn-danger delete-disable" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        <?php endif; ?>
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