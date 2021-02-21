<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                            <h4>Tambahan Biaya</h4>
                                <form class="form" method="POST" action="<?=base_url('consult_contract/submitaddFee/')?>">
                                    <div class="form-group">
                                      
                                            <input name="contract_id" class="form-control" type="hidden" value="<?php echo $id;?>" id="example-text-input" >
                                        </div>
                                   
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-2 col-form-label">Jumlah Pertemuan</label>
                                        
                                           
                                                <input name="add_attd" class="form-control" type="number" placeholder="Tambahan Pertemuan">
                                           
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-2 col-form-label">Deskripsi</label>
                                        
                                           
                                                <input name="desc" class="form-control" type="text" placeholder="Tambahan Metode">
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-2 col-form-label">Biaya</label>
                                       
                                                <input name="fee" class="form-control" type="number" placeholder="Jumlah Biaya">
                                   
                                    </div>
                                    <div align="right">
                                        <input type="button" class="btn btn-secondary" onclick="history.back();" value="Batal" name="">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Simpan</button>
                                        
                                    </div>
                                </form>

                            
                        </div>
                    </div>
                </div>