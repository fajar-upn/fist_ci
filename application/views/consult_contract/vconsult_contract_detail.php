<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Kontrak</h4>

                <form class="form">
                    <div class="form-group mt-5 row">
                       
                            <input class="form-control" type="hidden" value="<?php echo $id;?>" id="example-text-input" >
                  
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-2 col-form-label">Kode Peserta</label>
                      
                           <input class="form-control" readonly value="<?php echo $contract->user_code;?>" id="example-text-input">
                 
                   </div>
                   <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Nama Peserta</label>
                   
                        <input class="form-control" readonly value="<?php echo $contract->user_fullname;?>" id="example-text-input">
               
                </div>
                <div class="form-group row">
                    <label for="example-url-input" class="col-2 col-form-label">Judul Skripsi</label>
                   
                     <input class="form-control" readonly value="<?php echo $contract->thesis_title;?>" id="example-text-input">
               
             </div>
             <div class="form-group row">
                <label for="example-tel-input" class="col-2 col-form-label">Resource</label>
              
                 <input class="form-control" readonly value="<?php echo $contract->resource_name;?>" id="example-text-input">
         
         </div>  
         <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Basis Aplikasi</label>
            
             <input class="form-control" readonly value="<?php echo $contract->application_name;?>" id="example-text-input">
         
     </div> 
     <div class="form-group row">
        <label for="example-tel-input" class="col-2 col-form-label">Paket</label>
        
         <input class="form-control" readonly value="<?php echo $contract->package_code;?>" id="example-text-input">
   
 </div>
 <div class="form-group row">
    <label for="example-tel-input" class="col-2 col-form-label">Harga Paket</label>
    
     <input class="form-control" readonly value="<?php echo $contract->package_price;?>" id="example-text-input">

</div>
<div class="form-group row">
    <label for="example-tel-input" class="col-2 col-form-label">Diskon</label>
  
     <input class="form-control" readonly value="<?php echo $contract->contract_discount;?>" id="example-text-input">

</div>
<div align="right">
    <a href="<?=base_url('consult_contract') ?>" class="btn btn-secondary">Kembali</a> 
    <a href="<?=base_url('consult_contract/edit/') . $contract->contract_id?>" class="btn btn-warning">Edit</a> 
    <a href="<?=base_url('consult_contract/batalKontrak/') . $contract->contract_id?>" class="btn btn-danger">Batalkan Kontrak</a> 
    
</div>
</form>
</div>
</div>
</div>
</div>
<div class="row">  
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Biaya Tambahan</h4>                                
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th width="390">Tambahan Pertemuan</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $i = 1;

                        foreach($fee as $row) {  

                            ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row->scadd_fee_add_attd;?></td>
                                <td><?php echo $row->scadd_fee_desc;?></td>
                                <td>
                                    <?php echo "Rp"; echo number_format($row->scadd_fee_amt, 0,',', '.'); ?>
                                <td>
                                    <a href="<?php echo base_url('consult_contract/editFee/'). $row->scadd_fee_id;?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?php echo base_url('consult_contract/deleteFee/'). $row->scadd_fee_id;?>" class="btn btn-danger btn-sm" title="Hapus" data-toggle="tooltip" alt="alert" id="sa-params">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            $i++;
                        } 
                        ?>

                    </tbody>

                </table>
                <div align="right">
                    <a class="btn btn-success" href="<?=base_url('consult_contract/addFee/') . $contract->contract_id?>"><i class="fa fa-plus"></i> Biaya</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
