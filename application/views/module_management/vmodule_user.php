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
                <h4 class="card-title">Daftar Module</h4>
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
                                <td><?php echo $row->tmodules_author; ?></td>
                                <td>
                                    <a  href="<?php echo base_url('uploads/modules/').$row->tmodules_files; ?>"
                                        class="btn btn-sm waves-effect waves-light btn-info"
                                        data-toogle="tooltip" 
                                        title="Unduh" >
                                        <i class="fas fa-arrow-circle-down"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $no++; 
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>