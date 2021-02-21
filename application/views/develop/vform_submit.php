<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Submit Berkas</h4>
                                
                            </div>
                            <hr>
                            <form method="post" action="<?php echo base_url('index.php/Submit_Berkas/insert_data') ?>" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Data Personal</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="uprof_full_name" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="uacc_email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">No HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="uprof_phone" placeholder="No HP">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h4 class="card-title">Berkas</h4>
                                    <div class="form-group row">
                                        <label for="com1" class="col-sm-3 text-right control-label col-form-label">Nama Perusahaan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="com1" placeholder="Nama Perusahaan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Pilihan</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Choose Your Option</option>
                                                <option>PHP</option>
                                                <option>CSS</option>
                                                <option>Videography</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Biaya</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Pilih</option>
                                                <option>Rp. 250000</option>
                                                <option>Rp. 500000</option>
                                                <option>Rp. 750000</option>
                                                <option>Rp. 1000000</option>
                                                <option>Rp. 2500000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Pilih File</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">File dalam bentuk zip</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="abpro" class="col-sm-3 text-right control-label col-form-label">Deskripsi Aplikasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="abpro" placeholder="Deskripsi Aplikasi">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group m-b-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>