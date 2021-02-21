<div class="row">
    <div class="col-sm-12 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <h4 class="card-title">Periode Paket</h4>
                        <form method="POST" action="<?php echo site_url() ?>package/form_active">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <select class="form-control" id="select2-with-placeholder" name="period" aria-placeholder="Pilih Periode" style="width: 100%; height:36px;">
                                        <option value="">Pilih Periode</option>
                                        <?php foreach ($Pperiod as $row) :
                                            if ($period == $row->scperiod_id) { ?>
                                                <option value="<?php echo $row->scperiod_id; ?>" selected><?php echo $row->scperiod_desc . ' ' . $row->scperiod_year; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row->scperiod_id; ?>"><?php echo $row->scperiod_desc . ' ' . $row->scperiod_year; ?> </option>
                                        <?php }
                                        endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <input type="text" hidden id="submitActive" name="submitActive" value="submitActive">
                                <div class="form-group m-b-0 text-left">
                                    <button type="submit" class="btn btn-primary mt-3">Aktifkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-9">
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
                        <h2 class="card-title">Daftar Paket Tersedia</h2>
                    </div>
                    <div class="col-md">
                        <div class="text-right">
                            <a href="<?php echo site_url() . 'package/index_periode' ?>" class="btn waves-effect waves-light btn-danger"><i class="fas fa-plus mr-2"></i> Periode</a>
                            <a href="<?php echo site_url() . 'package/index_package' ?>" class="btn waves-effect waves-light btn-warning"><i class="fas fa-plus mr-2"></i> Pilihan</a>
                            <a href="<?php echo site_url() . 'package/form' ?>" class="btn waves-effect waves-light btn-success"><i class="fas fa-plus mr-2"></i> Ketersediaan</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="">No.</th>
                                <th scope="col">Kode Paket</th>
                                <th scope="col">Nama paket</th>
                                <th scope="col">Nama deskripsi</th>
                                <th scope="col">Periode</th>
                                <th scope="col">harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($Apackage as $row) :
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row->package_code; ?></td>
                                    <td><?php echo $row->package_name; ?></td>
                                    <td><?php echo $row->package_desc; ?></td>
                                    <td><?php echo $row->package_period . ' ' . $row->package_year; ?></td>
                                    <td><?php echo $row->package_price; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url() . 'package/form/' . $row->package_id; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?php echo site_url() . 'package/delete/' . $row->package_id; ?>" title="Hapus" data-toogle="tooltip" class="btn btn-danger btn-sm mt-2 sa-hapus">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>