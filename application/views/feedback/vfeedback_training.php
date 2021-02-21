<aside class="col-xl-3 col-lg-4">
    <h2 class="card-title">Feed Back Pelatihan</h2>
</aside><!-- /aside -->
<div class="col-xl-9 col-lg-8">
    <div id="wizard_container">
        <div id="top-wizard">
            <strong>Progress</strong>
            <div id="progressbar"></div>
        </div><!-- /top-wizard -->

        <form name="insert_mhs" method="POST" action="<?= base_url('feedback/training') ?>">
            <input id="website" name="website" type="text" value="">
            <!-- Leave for security protection, read docs for details -->
            <div id="middle-wizard">
                <?php $amt = count($questions);
                $amount_question = $amt_question->amount;
                $j = 1; // $j untuk menyimpan angka angka pertanyaan dari 1 - jumlah pertanyaan
                // Perulangan tampilan pertanyaan
                for ($i = 1; $i <= $amt; $i++) { ?>
                    <!-- Memberi id pada setiap class step berdasarkan nilai pertanyaan-->
                    <div class="step" id="step_<?= $j ?>">
                        <?php $que_id = $questions[$i - 1]->tfque_id; // Untuk menyimpan id pertanyaan dipakai sebagai kondisi while
                        ?>
                        <!-- Tampilan Pertanyaan -->
                        <h3 class="main_question"><strong><?= $j . "/" . $amount_question ?></strong><?= $questions[$i - 1]->tfque_question ?></h3>
                        <input type="hidden" name=id_<?= $j ?> value="<?= $questions[$i - 1]->tfque_id ?>"><!-- Menyimpan id pertnyaan -->
                        <!-- Kondisi jika tipenya radio -->
                        <?php if ($questions[$i - 1]->tfque_type == "radio") {   ?>
                            <?php while ((isset($questions[$i - 1])) && ($questions[$i - 1]->tfque_id == $que_id)) { ?>
                                <div class="form-group radio_questions">
                                    <label><?= $questions[$i - 1]->tfselect_selection ?>
                                        <input name="ans_<?= $j ?>" type="radio" value="<?= $questions[$i - 1]->tfselect_selection ?>" class="icheck required">
                                    </label>
                                </div>
                            <?php $i++;
                            }
                            $i--;
                        } else {
                            // Kondisi jika tipenya dropdown
                            if ($questions[$i - 1]->tfque_type == "dropdown") { ?>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="styled-select">
                                            <select class="required" name="ans_<?= $j ?>" id="penjurusan">
                                                <option value="" selected>Pilih</option>
                                                <?php while ((isset($questions[$i - 1])) && ($questions[$i - 1]->tfque_id == $que_id)) { ?>
                                                    <option value="<?= $questions[$i - 1]->tfselect_selection ?>" name="ans_<?= $j ?>" id="penjurusan"><?= $questions[$i - 1]->tfselect_selection ?></option>
                                                <?php $i++;
                                                }
                                                $i--; ?>
                                                <option value="Other">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- /row-->
                                <?php } else { // Kondisi jika tipenya checkbox
                                if ($questions[$i - 1]->tfque_type == "checkbox") { ?>
                                    <div class="row">
                                        <input type="hidden" name=id_check_<?= $j ?> value="checkbox">
                                        <?php while ((isset($questions[$i - 1])) && ($questions[$i - 1]->tfque_id == $que_id)) { ?>
                                            <div class="col-sm-6">
                                                <?php $z = 1;
                                                while ((isset($questions[$i - 1])) && ($questions[$i - 1]->tfque_id == $que_id) && ($z != 5)) { ?>
                                                    <div class="form-group checkbox_questions">
                                                        <label>
                                                            <input name="ans_<?= $j ?>[]" type="checkbox" value="<?= $questions[$i - 1]->tfselect_selection ?>" class="icheck required"><?= $questions[$i - 1]->tfselect_selection ?>
                                                        </label>
                                                    </div>
                                            <?php $i++;
                                                    $z++;
                                                }
                                            }
                                            $i--; ?>
                                            </div><!-- /col-->
                                    </div><!-- /row-->
                                    <div class="form-group">
                                        <label>Lainnya</label>
                                        <input type="text" name="ans_<?= $j ?>[]" class="form-control">
                                    </div>
                                    <?php } else { //Kondisi untuk type textarea
                                    if ($questions[$i - 1]->tfque_type == "textarea") { ?>
                                        <div>
                                            <label class="textarea">
                                                <textarea rows="5" name="ans_<?= $j ?>" style="resize:none;width:700px;height:100px;" class="form-control"></textarea>
                                            </label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <input type="<?= $questions[$i - 1]->tfque_type ?>" name="ans_<?= $j ?>" class="required form-control" placeholder="<?= $questions[$i - 1]->tfque_question ?>" id="nama" min="0">
                                        </div>
                        <?php }
                                }
                            }
                        }
                        // Kondisi untuk menambah class submit untuk pertanyaan terakhir agar ada tombol sumbit
                        if (($i) == $amt) {
                            echo "<script>document.getElementById('step_$amount_question').className += ' submit';</script>";
                        }
                        ?>
                    </div><!-- close step -->
                <?php $j++;
                } ?>
                <input type="hidden" name=amt value="<?= $amount_question ?>"><!-- Untuk menyimpan jumlah pertanyaan -->
            </div><!-- /middle-wizard -->
            <div id="bottom-wizard">
                <button type="button" name="backward" class="backward">Kembali </button>
                <button type="button" name="forward" class="forward">Selanjutnya</button>
                <button type="submit" name="process" value="process" class="submit">Submit</button>
            </div><!-- /bottom-wizard -->
        </form>
    </div><!-- /Wizard container -->
</div><!-- /col -->