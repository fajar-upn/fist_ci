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
                        <h2 class="card-title">Daftar Resource Training</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <a class="btn waves-effect waves-light btn-success" href="<?php echo site_url() . 'training_resource/form_resource' ?>"><i class="fas fa-plus mr-2"></i> Tambah Resource</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Resource</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($resources as $resource) : ?>
                                <tr class="text-center">
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td><?php echo $resource->tres_name ?></td>
                                    <td>
                                        <a href="<?php echo site_url() . 'Training_resource/form_resource/' . $resource->tres_id ?>" class="btn-sm waves-effect waves-light btn-warning" title="Ubah" data-toggle="tooltip"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="<?php echo site_url() . 'Training_resource/delete/' . $resource->tres_id ?>" class="btn-sm waves-effect waves-light btn-danger delete" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <?php $no++; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>