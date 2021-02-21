<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
                    <div id="alerttype" class="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <h3 id="alerttitle"><i id="alerticon" class="mx-1"></i></h3>
                        <span id="alertmessage"></span>
                    </div>
                <?php endif; ?>
                <?php echo $this->session->flashdata('pesan');?>
                <div class="row">
                    <h4 class="col card-title">Daftar Module</h4>
                    <button type="button" class="col-md-2 btn btn-success mt-10 mb-2 float-left" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus mr-2"></i>Tambah Module</button>
                </div>

                <hr>
                
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th>Nomor</th>
                            <th>Nama Module</th>
                            
                            <th>Penulis</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($modules as $row) : ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $row->tmodules_name; ?></td>
                                <!-- <td><?php echo $row->tmodules_files; ?></td>  -->
                                <td><?php echo $row->tmodules_author; ?></td>
                                <td class="text-center">
                                    <a      href="<?php echo base_url('uploads/modules/').$row->tmodules_files; ?>" 
                                            class="btn btn-sm waves-effect waves-light btn-info"
                                            data-toogle="tooltip" 
                                            title="Unduh" >
                                            <i class="fas fa-arrow-circle-down"></i></a>
                                    <button id="btn-edit-module"
                                            type="button"
                                            data-target="#modal-edit"
                                            data-toggle="modal"
                                            data-toggle="tooltip" 
                                            title="Ubah" 
                                            class="btn btn-sm waves-effect waves-light btn-warning"
                                            data-id="<?php echo $row->tmodules_id; ?>"
                                            data-name="<?php echo $row->tmodules_name; ?>"
                                            
                                            data-author="<?php echo $row->tmodules_author; ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <!-- <button id="btn-delete-module" type="button" class="btn btn-danger sa-hapus"
                                            data-id="<?php echo $row->tmodules_id; ?>"
                                            data-name="<?php echo $row->tmodules_name; ?>"
                                            data-toggle="modal"
                                            data-target="#modal-delete"><i class="fa fa-trash"></i></button> -->
                                    <a      href="<?php echo site_url() . 'Module_management/delete_module/' . $row->tmodules_id; ?>"
                                            class="btn btn-sm waves-effect waves-light btn-danger sa-hapus"
                                            data-toogle="tooltip" 
                                            title="Hapus" >
                                            <i class="fa fa-trash"></i>
                                    </a>

                                    <!-- <a href="#" class="btn btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"> <i class="fas fa-pencil-alt"></i> </a> -->
                                </td>
                            </tr>
                            <?php
                            $no++; 
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>


    <!-- Modal add Module -->
                <div id="modal-add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Module</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <?php echo form_open_multipart('module_management/insert_module');?>
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>Nama Module</label>
                                            <input class="form-control form-control-lg" type="text" required=" " placeholder="Nama Module" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>File ( pdf/doc, max-size 3mb )</label>
                                            <input class="form-control form-control-lg" type="file" name="file">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                            <label>Penulis</label>
                                            <input class="form-control form-control-lg" type="text" required=" " placeholder="Penulis" name="penulis">
                                        </div>
                                    </div>
                                        <div class="row d-flex">
                                            <div class="ml-auto mr-2">
                                                <input type="hidden" name="id" id="modal-id">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                                                Batal
                                                </button>

                                                <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i> 
                                                Simpan
                                                </button>
                                            </div>
                                        </div>
                                <?php echo form_close();?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <!-- Modal Edit Module -->
                <div id="modal-edit" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Module</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form id="form-modal-edit" class="form-horizontal m-t-20" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>Nama Module</label>
                                            <input id="modal-nama" class="form-control form-control-lg" type="text" required=" " placeholder="Nama Module" name="nama" value="<?php echo $row->tmodules_files;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>File ( pdf/doc, max-size 3mb )</label>
                                            <input id="modal-file" class="form-control form-control-lg" type="file" placeholder="File" name="file" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-12 ">
                                            <label>Penulis</label>
                                            <input id="modal-penulis" class="form-control form-control-lg" type="text" required=" " placeholder="Penulis" name="penulis" value="">
                                        </div>
                                    </div>
                                        <div class="row d-flex">
                                            <div class="ml-auto mr-2">
                                                <input type="hidden" name="id" id="modal-id">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success waves-effect"><i class="fa fa-check"></i>Simpan</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <!-- Modal Confirm Delete User -->
                
            </div>
        </div>
    </div>
</div>