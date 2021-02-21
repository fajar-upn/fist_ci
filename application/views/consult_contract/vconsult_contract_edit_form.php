<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Kontrak</h4>
                                
                                <form class="form" action="<?=base_url('consult_contract/insert/')?>" method="POST">
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-2 col-form-label">Paket Tersedia</label>
                                            <select name="package" class="form-control">
                                            <?php foreach($pack as $row) :
                                            if($form->package_id == $row->package_id) { ?>
                                                 <option value="<?php echo $row->package_id; ?>" selected>
                                                 <?php echo $row->package_code . ' (' . $row->package_period . ')'; ?>
                                                 </option> <?php  }
                                            else { ?>
                                                 <option value="<?php echo $row->package_id; ?>" >
                                                 <?php echo $row->package_code . ' (' . $row->package_period . ')'; ?>
                                                 </option>
                                             <?php } endforeach ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email-input" class="col-2 col-form-label">Resource</label>
                                        <select name="resource" class="form-control">
                                            <?php foreach($res as $row) :  
                                            if($form->resource_id == $row->res_id) {?>
                                             <option value="<?php echo $row->res_id; ?>" selected>
                                             <?php echo $row->res_name; ?>
                                             </option> <?php }
                                             else { ?>
                                                <option value="<?php echo $row->res_id; ?>">
                                                <?php echo $row->res_name; ?>
                                                </option>
                                                <?php } endforeach ?>

                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-url-input" class="col-2 col-form-label">Base App</label>
                                       <select name="base_app" class="form-control">
                                            <?php foreach($base_app as $row) : 
                                            if($form->baseapp_id == $row->baseapp_id) { ?>
                                             <option selected value="<?php echo $row->baseapp_id; ?>">
                                                <?php echo $row->baseapp_name; ?>
                                             </option>
                                             <?php } else { ?>
                                            <option value="<?php echo $row->baseapp_id; ?>">
                                                <?php echo $row->baseapp_name; ?>
                                             </option>
                                             <?php } endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-2 col-form-label">Diskon</label>
                                        <input name="discount" class="form-control" type="number" value="<?php echo $discount->sccontr_discount?>">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <div align="right">
                                       <!--  <input type="button" class="btn btn-outline-dark" onclick="history.back();" value="Batal" name=""> -->
                                       <a href="<?=base_url('consult_contract/detail/') . $id?>" class="btn btn-secondary">Batal</a> 
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Simpan</button>
                                    </div>
                                </form>
                    </div>
                </div>
                </div>
                </div>