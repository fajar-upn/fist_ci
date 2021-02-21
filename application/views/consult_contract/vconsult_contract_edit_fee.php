<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                            <h4>Edit Biaya Tambahan</h4>
                                <form class="form" method="POST" action="<?=base_url('consult_contract/submitEditedAddFee/')?>">
                                    <div class="form-group">
                                            <input name="id" class="form-control" type="hidden" value="<?php echo $id;?>" id="example-text-input" >
                                      
                                    </div>
                                    <div class="form-group ">
                                        <label for="example-search-input" class="col-2 col-form-label">Jumlah Biaya</label>
                                       
                                                <input name="fee_amt" class="form-control" type="number" value="<?php echo $fee->scadd_fee_amt;?>">
                                           
                                    </div>
                                    <div class="form-group ">
                                        <label for="example-search-input" class="col-2 col-form-label">Deskripsi</label>
                                       
                                                <input name="desc" class="form-control" type="text" value="<?php echo $fee->scadd_fee_desc;?>">
                                           
                                    </div>
                                    <div class="form-group ">
                                        <label for="example-search-input" class="col-2 col-form-label">Jumlah Pertemuan</label>
                                        
                                                <input name="attd" class="form-control" type="number" value="<?php echo $fee->scadd_fee_add_attd;?>">
                                           
                                    </div>
                                    <div align="right">
                                        <input type="button" class="btn btn-outline-dark" onclick="history.back();" value="Batal" name="">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>   
                                    </div>
                                </form>

                            
                        </div>
                    </div>
                </div>