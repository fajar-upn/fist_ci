<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Laporan Kelas Konsultasi yang akan Berjalan jalan</h4>
                <br>
            </div>
            <?php
            $no = 1;

            foreach ($jumlah_bulan as $p) {

                $part = explode('-', $p['tsched_date']);
                $b = array(
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                );
                $bulann = $b[$part[1]];


            ?>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><?php echo $bulann ?> </label>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th id="output" scope="col-3">Nama Tentor</th>
                                <th scope="col">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($report as $p) {
                                    $part = explode('-', $p['tsched_date']);
                                    $b = array(
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember',
                                    );
                                    $bulan = $b[$part[1]];
                                    if ($bulann == $bulan) {
                                ?>
                            <tr>
                                <td><?php echo $p['uprof_full_name'] //$barang->tentor 
                                    ?></td>
                                <td><?php echo $p['kelas'] //$barang->nominal 
                                    ?></td>
                            </tr>
                    <?php
                                        $no++;
                                    }
                                }
                    ?>
                    </tr>
                        </tbody>
                    </table>
                </div>
            <?php

                $no++;
            }
            ?>
        </div>
    </div>
</div>