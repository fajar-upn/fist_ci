<div class="row">
    
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">Fist Effect</b></h3>
                                            <p class="text-muted m-l-5">Perum Candi Gebang Permai
                                                <br/> no E12, Jetis, Jetis, Wedomartani,
                                                <br/> Ngemplak, Sleman, Yogyakarta
                                                <br/> 55584</p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold">
                                                <?php foreach($tentor as $t) : 
                                                 echo $t['tentor'];
                                                endforeach; ?>
                                            </h4>
                                            <p class="text-muted m-l-30">
                                            <?php foreach($tentor as $t) : 
                                                 echo $t['uprof_address'];
                                                endforeach; ?>
                                            </p>
                                        </address>
                                            <p class="m-t-30"> <i class="fa fa-calendar"></i> 
                                            <?php echo $bulan; ?> <?php echo $tahun; ?>
                                            </p>
                                            
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th class="text-right">Durasi Pertemuan</th>
                                                    <th class="text-right">Honor per Jam</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=1;
                                                $total=0;
                                                foreach($penggajian as $p) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++ ?></td>
                                                    <td><?= $p['mahasiswa'] ?> </td>
                                                    <td class="text-right"><?= $p['durasi'] ?> menit</td>
                                                    <td class="text-right"> Rp <?= $salary ?></td>
                                                    <?php $gaji=$p['durasi']/60*$salary ?>
                                                    <td class="text-right"> <?= number_format($gaji, 2, ",", ".") ?> </td>
                                                </tr>
                                                  <?php
                                                    $total=$total+($p['durasi']/60*$salary);
                                                    endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        
                                        <hr>
                                        <h3><b>Total :</b> Rp. <?= number_format($total, 2, ",", ".") ?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
  
                </div>

    