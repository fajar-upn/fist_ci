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
                        <h2 class="card-title">Daftar Paket</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training_package/form_package/0' ?>"><i class="fas fa-plus mr-2"></i> Tambah Paket</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Tipe Paket</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($packages as $package) : ?>
                                <tr class="text-center">
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo $package->tpack_name ?></td>
                                    <td><?php echo $package->tptype_name ?></td>
                                    <td><?php echo $package->tptype_price ?></td>
                                    <td>
                                        <a href="<?php echo site_url() . 'Training_package/table_packresource/' . $package->tpack_id ?>" class="btn-sm waves-effect waves-light btn-primary" title="Daftar Resource" data-toggle="tooltip"><i class="far fa-list-alt"></i></i></a>
                                        <a href="<?php echo site_url() . 'Training_package/form_package/' . $package->tptype_id . '/' . $package->tpack_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="<?php echo site_url() . 'Training_package/deletePack/' . $package->tptype_id ?>" class="btn-sm waves-effect waves-light btn-danger delete" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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