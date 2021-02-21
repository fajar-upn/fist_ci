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
                <h2 class="card-title">Data Penggajian</h2>
                <?php if ($this->session->flashdata('notif')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data presensi <strong>berhasil</strong> <?= $this->session->flashdata('notif') ;?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <br>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control col-3">
                         <?php foreach($tahun as $t) :                 
                    $part = explode('-',$t['tattd_date']);
                    ?>
                        <option <?=$tahun_dipilih== $part[0]?'selected':NULL?>  value="<?php echo base_url().'/training_penggajian/cari_tahun/'.$part[0]; ?>">
                            <?php echo $part[0]?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="table-responsive mt-4">
                    <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="">No.</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Nama Tentor</th>
                            <th scope="col">Durasi (menit)</th>
                            <th scope="col">Nominal (rupiah)</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                        <tbody>
                        <tr>
                        <?php
                            $no = 1;
                            foreach ($penggajian as $p) {
                                $part = explode('-',$p['tattd_date']);
                                    $b= array(
                    '00'=>'',
                    '01'=>'Januari',
                    '02'=>'Februari',
                    '03'=>'Maret',
                    '04'=>'April',
                    '05'=>'Mei',
                    '06'=>'Juni',
                    '07'=>'Juli',
                    '08'=>'Agustus',
                    '09'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember',
                );
        $bulan=$b[$part[1]];    
                ?>
                            <tr>
                            <td><?php echo $no ?></td> 
                                <td><?php echo $bulan //$barang->bulan ?></td>
                                <td><?php echo $p['uprof_full_name']//$barang->tentor ?></td>
                                <td><?php echo round($p['durasi']/$p['jpm'], 2)//$barang->nominal ?></td>
                                <?php $gaji = round($p['durasi']/60*$p['gaji'], 2); ?>
                                <td><?php echo number_format($gaji, 2, ",", ".") //$barang->nominal ?></td>
                                
                                <td>
                                    <a href="<?php echo site_url() . '/training_payroll/detail/'.$p['uacc_id'].'/'.$part[1].'/'.$part[0].'/'.$bulan.'/'.$p['gaji'] ?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Detil" data-toggle="tooltip"> <i class="fas fa-eye"></i> </a>
                                </td>
                            </tr>
                            <?php
                            $no++; 
                        }
                        ?>                
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>









<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Penggajian</h4>
                <br>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control col-3">
                         <?php foreach($tahun as $t) :                 
                    $part = explode('-',$t['tattd_date']);
                    ?>
                        <option <?=$tahun_dipilih== $part[0]?'selected':NULL?>  value="<?php echo base_url().'/training_penggajian/cari_tahun/'.$part[0]; ?>">
                            <?php echo $part[0]?>
                        </option>
                    <?php endforeach; ?>
                    </select>
            </div>
            <div  class="table-responsive mt-4">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Bulan</th>
                            <th id="output">Nama Tentor</th>
                            <th scope="col">Durasi (menit)</th>
                            <th scope="col">Nominal (rupiah)</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($penggajian as $p) {
                                $part = explode('-',$p['tattd_date']);
                                    $b= array(
                    '00'=>'',
                    '01'=>'Januari',
                    '02'=>'Februari',
                    '03'=>'Maret',
                    '04'=>'April',
                    '05'=>'Mei',
                    '06'=>'Juni',
                    '07'=>'Juli',
                    '08'=>'Agustus',
                    '09'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember',
                );
        $bulan=$b[$part[1]];    
                ?>
                            <tr>
                            <td><?php echo $no ?></td> 
                                <td><?php echo $bulan //$barang->bulan ?></td>
                                <td><?php echo $p['uprof_full_name']//$barang->tentor ?></td>
                                <td><?php echo round($p['durasi']/$p['jpm'], 2)//$barang->nominal ?></td>
                                <?php $gaji = round($p['durasi']/60*$p['gaji'], 2); ?>
                                <td><?php echo number_format($gaji, 2, ",", ".") //$barang->nominal ?></td>
                                
                                <td>
                                    <a href="<?php echo site_url() . '/training_payroll/detail/'.$p['uacc_id'].'/'.$part[1].'/'.$part[0].'/'.$bulan.'/'.$p['gaji'] ?>" class="btn btn-sm waves-effect waves-light btn-primary" title="Detil" data-toggle="tooltip"> <i class="fas fa-eye"></i> </a>
                                </td>
                            </tr>
                            <?php
                            $no++; 
                        }
                        ?>           
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div> -->