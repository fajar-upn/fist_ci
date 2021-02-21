<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($this->session->userdata('typeNotif'))) : ?>
					<div id="alerttype" class="p-3 mb-2">
						<h5 id="alerttitle"></h5>
						<span id="alertmessage"></span>
						<i id="alerticon"></i>
					</div>
		<?php endif; ?>
                <h2 class="card-title">Daftar Pengajuan</h2>
                <div class="text-right">
                    <a href="<?php echo site_url() . 'consultation/registration/form/0' ?>" class="btn waves-effect waves-light btn-success">Tambah</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Status</th>
                            <th scope="col">Berkas</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $row) :

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row->uprof_full_name ?> </td>
                                <td><?php echo $row->scons_thesis_title ?></td>
                                <td><?php echo $row->scpack_code; ?></td>
                                <td><?php echo $row->sstatus_desc; ?></td>
                                <td>
                                    <a href="<?php echo site_url() . 'files/index/' . $row->scons_id ?>" class="btn btn-success">Detail</a>
                                </td>
                                <td></td>
                            </tr>
                        <?php
                            $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>