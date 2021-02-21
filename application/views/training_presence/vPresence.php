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
                <h3 class="card-title">Data Presensi Training</h3>
                <h5> Nama Tentor : <?php echo $data->tentor ?><br>
                     Kelas  : <?php echo $data->tclass_name ?></h5>
                <div class="row">
                    
                    <div class="col-md">
                        <div class="text-right">
                        <?php $id = 0;
                    if($data->tclass_status != 3 ){
                        if ($user_role == 2 || $user_role == 3){ ?>
                        <a href="<?php echo site_url() . 'Training_Presence/formschedules/'.$data->tclass_id.'/'.$id ?>" class="btn waves-effect waves-light btn-success">Tambah</a>
                  <?php  } } ?>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                            <th scope="">No.</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($schedule as $barang) : ?>
                                <tr class="text-center" id = "<?php $barang->tattd_id ?>">
                                <td><?php echo $no ?></td>
                                <td><?php echo $barang->mahasiswa ?></td>
                                <td><?php echo $barang->tattd_date ?></td>
                                <td><?php echo $barang->tattd_timestart ?></td>
                                <td><?php echo $barang->tattd_timefinish ?></td>
                                <td><?php echo $barang->tattd_status?></td>
                                <?php if($user_role ==2 || $user_role ==3) { ?>
                                <td>
                                    <a href="<?php echo site_url() . '/Training_Presence/formschedules/'.$data->tclass_id.'/'.$barang->tattd_id ?>" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?php echo site_url() . '/Training_Presence/deleteschedule/' .$data->tclass_id.'/'.$barang->tattd_id ?>" class="btn btn-danger remove">
                                        <i class="fas fa-trash"></i>
                                    </a>                                   
                                </td> <?php } ?>
                                    <?php $no++; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>