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
                        <h2 class="card-title">Daftar File</h2>
                    </div>
                    <?php
                    $role = $this->session->userdata("role");
                    if ($role == '2') : //button tambah berkas untuk developer (selalu ada mau statusnya apaaja) 
                    ?>
                        <div class="col-md">
                            <div class="text-right">
                                <a href="<?php echo site_url() . 'files/form/0/' . $scons_id ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Tambah File</a>
                            </div>
                        </div>

                        <?php
                    elseif ($role == '5') : //button tambah berkas untuk client
                        if ($user->sstatus_id == '3' || $user->sstatus_id == '6') : //hanya dapat diakses ketika statusnya pengisian berkas atau revisi 
                        ?>
                            <div class="col-md">
                                <div class="text-right">
                                    <a href="<?php echo site_url() . 'files/form/0/' . $scons_id ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Tambah File</a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </div>

                <!-- <div class="row">
                    <div class="col-md">
                        <h4 class="card-title">Nama Pengguna :</h4>
                        <h4 class="card-title" id="nama"></h4>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md">
                        <h6 class="card-title">Nama Pengguna : <?php echo $user->uprof_full_name; ?> </h6>
                        <h6 class="card-title">Judul Pengajuan : <?php echo $user->scons_thesis_title; ?></h6>
                    </div>
                </div>

                <?php
                if (isset($files)) {
                ?>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th scope="col">Deskripsi Dokumen</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Kategori Dokumen</th>
                                    <th scope="col">Status Pengajuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($files as $row) :
                                    $delMessage = "Apakah anda yakin ingin menghapus File : " . $row->scfile_name . " ?";
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no; ?></td>
                                        <td> <?php echo $row->scfile_desc ?> </td>
                                        <td><?php echo $row->scfile_name; ?></td>
                                        <td><?php echo $row->fcategory_name; ?></td>
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
                                            <?php
                                            $role = $this->session->userdata("role");
                                            //button for access edit files
                                            if ($role == '2') : //button for role 2 (developer)
                                            ?>
                                                <a href="<?php echo site_url() . 'files/form/' . $row->scfile_id . '/' . $scons_id ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a> <br>
                                            <?php
                                            elseif ($role == '5') : //button for role 5 (client)
                                            ?>
                                                <?php if ($row->sstatus_id == '3' || $row->sstatus_id == '6') : ?>
                                                    <a href="<?php echo site_url() . 'files/form/' . $row->scfile_id . '/' . $scons_id ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a> <br>
                                                <?php endif ?>
                                            <?php endif ?>


                                            <!-- button for access delete files -->
                                            <?php
                                            if ($role == '2') : //button for role 2 (developer) only
                                            ?>
                                                <a href="<?php echo site_url() . 'files/delete/' . $row->scfile_id . '/' . $scons_id ?>" class="btn btn-danger btn-sm sa-delete-fl" data-toggle="tooltip" title="Hapus File">
                                                    <i class="fas fa-trash"></i>
                                                </a> <br>
                                            <?php
                                            elseif ($role == '5') : //button for role 5 (client)
                                            ?>
                                                <?php if ($row->sstatus_id == '3' || $row->sstatus_id == '6') : ?>
                                                    <a href="<?php echo site_url() . 'files/delete/' . $row->scfile_id . '/' . $scons_id ?>" class="btn btn-danger btn-sm sa-delete-fl" data-toggle="tooltip" title="Hapus File">
                                                        <i class="fas fa-trash"></i>
                                                    </a> <br>
                                                <?php endif ?>
                                            <?php endif ?>

                                            <!-- button for access download file, button for everyone -->
                                            <a href="<?php echo site_url() . 'files/download/' . $row->scfile_id . '/' . $scons_id ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Download">
                                                <i class="fa fa-arrow-down"></i>
                                            </a>
                                        </td>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md">
                        <div class="text-center">
                            <?php
                            if ($role == '5' || $role == '2') : //button for role 5 (client) and 2 (developer) 
                            ?>
                                <?php if ($row->sstatus_id == '3' || $row->sstatus_id == '6') : ?>
                                    <a href="<?php echo site_url() . 'files/email_files/' . $row->scfile_id . '/' . $scons_id ?>" class="btn waves-effect waves-light btn-success">Submit</a>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                <?php } ?>

                <!-- Modal add application -->
                <div id="add-application" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Aplikasi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>b_application/insert" method="post">
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <input class="form-control form-control-lg" type="text" required=" " placeholder="Nama Aplikasi" name="baseapp_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                            <input class="form-control form-control-lg" type="text" required=" " placeholder="Kode Aplikasi" name="baseapp_code">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect">Save</button>
                                    <button type="button" class="btn btn-dark waves-effect" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <!-- Modal Edit Application -->
                <div id="edit-application" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit untuk aplikasi <span id="modal-name-edit" style="color: red;"></span></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post">
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>Nama Aplikasi</label>
                                            <input id="modal-name" class="form-control form-control-lg" type="text" placeholder="Nama" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>Kode Aplikasi</label>
                                            <input id="modal-username" class="form-control form-control-lg" type="text" required=" " placeholder="Username" name="username" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Status Hapus Akun</label>
                                            <div class="m-2">
                                                <h6 class="card-subtitle">Hapus akun dengan menekan tombol. Disarankan untuk tidak menghapus akun karena berpotensi kehilangan data.</h6>
                                                <div id="button-edit-suspend" class="m-b-30">
                                                    <?php if ($this->session->userdata('role') == 2) : ?>
                                                        <!-- Cek apakah yang login memiliki role developer atau tidak -->
                                                        <button id="btn-delete-user" type="button" class="btn btn-danger" data-id="<?php echo $user->uacc_id; ?>" data-username="<?php echo $user->uacc_username; ?>" data-dismiss="modal" data-toggle="modal" data-target="#modal-delete">Hapus</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect">Save</button>
                                    <button type="button" class="btn btn-dark waves-effect" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <!-- Modal Confirm Delete User -->
                <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus Pengguna</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- generate text ada di js-->
                            </div>
                            <div class="modal-footer">
                                <a id="btn-confirm-delete" href="" class="btn btn-danger">Hapus</a>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>