<div class="row">
                    <div class="col-sm-12">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Kontrak</h4>
                                <table>
                                    <tr>
                                        <td>Kode Peserta</td>
                                        <td>:</td>
                                        <td><?php echo $consult->user_code;?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Peserta</td>
                                        <td>:</td>
                                        <td><?php echo $consult->user_fullname;?></td>
                                    </tr>
                                     <tr>
                                        <td>Judul Skripsi</td>
                                        <td>:</td>
                                        <td><?php echo $consult->thesis_title;?></td>
                                    </tr>
                                </table> <br> <br>
                                <form class="form" method="POST" action="<?=base_url('consult_contract/contract/'). $id?>" enctype="multipart/form-data">
                                    <div class="form-group>
                                            <input class="form-control" type="hidden" value="<?php echo $id;?>" id="example-text-input" >
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-2 col-form-label">Paket Tersedia</label>
                                        <select name="package" class="form-control">
                                            <?php foreach($pack as $pack) :  ?>
                                                 <option value="<?php echo $pack->package_id; ?>">
                                                 <?php echo $pack->package_code . ' (' . $pack->package_period . ')'; ?>
                                                 </option> <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email-input" class="col-2 col-form-label">Resource</label>
                                        <select name="resource" class="form-control">
                                            <?php foreach($res as $res) :  ?>
                                             <option value="<?php echo $res->res_id; ?>">
                                             <?php echo $res->res_name; ?>
                                             </option> <?php endforeach ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-url-input" class="col-2 col-form-label">Base App</label>
                                        <select name="base_app" class="form-control">
                                            <?php foreach($base_app as $base_app) :  ?>
                                             <option value="<?php echo $base_app->baseapp_id; ?>">
                                             <?php echo $base_app->baseapp_name; ?>
                                             </option> <?php endforeach ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-2 col-form-label">Diskon</label>
                                        <input name="diskon" class="form-control" type="number" placeholder="Jumlah Diskon">
                                    </div>
                                    <div>
                                        <input type="hidden" name="categories" value="3">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-2 col-form-label">Upload File KTM</label>
                                        <div class="col-10">
                                            <div class="input-group mb-3">
                                                <div class="">
                                                    <input type="file" class="custome file-input" name="scfile_name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table align="right">
                                        <tr>
                                            <td>
                                                <div align="right">
                                                    <input type="button" class="btn btn-secondary" onclick="history.back();" value="Batal" name="">
                                                    <!-- <input type="submit" class="btn btn-success" value="Simpan"> <i class="fa fa-check"></i> -->
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                        </div>
                    </div>
                    </div>
                </div>