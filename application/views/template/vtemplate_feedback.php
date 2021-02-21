<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="QUOTE - Request a quote for every type of companies">
    <meta name="author" content="Ansonika">
    <title>Fist Effect</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?= base_url() ?>includes/assets/images/img/lambang.1.png" type="image/x-icon">
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?= base_url(); ?>includes/dist/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>includes/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>includes/dist/css/stylefb.css" rel="stylesheet">
    <link href="<?= base_url(); ?>includes/dist/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>includes/dist/css/magnific-popup.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>includes/dist/css/skins/square/yellow.css" rel="stylesheet">

    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>includes/assets/libs/select2/dist/css/select2.min.css">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?= base_url(); ?>includes/dist/css/custom.css" rel="stylesheet">

</head>

<body>
    <?php
    $message = $this->session->flashdata('message');
    if ($message != NULL) {
        echo "<script>alert('" . $message . "');</script>";
    }
    ?>
    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div><!-- /Loader_form -->

    <header>
        <div id="logo_home">
            <h1><img src="<?= base_url() ?>includes/assets/images/img/Desain.1.png" height="100px" width="120px" </h1> </div> <a id="menu-button-mobile" class="cmn-toggle-switch cmn-toggle-switch__htx" href="javascript:void(0);"><span>Menu mobile</span></a>
                <nav class="main_nav">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab_1" data-toggle="tab">Feed Back</a></li>
                        <li><a href="#tab_2" data-toggle="tab">About</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Contact</a></li>
                    </ul>
                </nav>
    </header><!-- /header -->

    <div class="intro_txt animated fadeInUp">
        <h2>Selamat Datang</h2>
        <p>Fist Effect merupakan perusahaan yang bergerak dibidang pengembangan sumberdaya manusia dan pengembangan aplikasi. Fokus dari pengembangan umberdaya manusia di perusahaan kami berada dalam lingkup Teknologi Informasi.</p>
    </div><!-- /intro_txt -->
    <img src="<?= base_url() ?>includes/assets/images/img/HalamaDepan.png" height="625px" width="850px" align="right">

    <div class="layer"></div><!-- /mask -->

    <div id="main_container">

        <div id="header_in">
            <a href="#0" class="close_in "><i class="pe-7s-close-circle"></i></a>
        </div>

        <div class="wrapper_in">
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade" id="tab_1">
                        <div class="subheader" id="quote"></div>
                        <div class="row">
                            <!-- Content here-->
                            <?php
                            $this->load->view($content);
                            ?>
                        </div><!-- /row -->
                    </div><!-- /TAB 1:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

                    <div class="tab-pane fade" id="tab_2">
                        <div class="subheader" id="about"></div>
                        <div class="row">
                            <div class="col-lg-8">
                                <h2>Fist Effect</h2>
                                <p class="lead">Kami membantu peserta untuk mendalami lebih lanjut tentang materi-materi yang ingin dipelajari, termasuk materi-materi yang terfokus pada sebuah kasus atau project aplikasi yang sedang di kerjakan. Peserta kami datang dari berbagai kalangan siswa, mahasiswa, praktisi atau karyawan suatu perusahaan yang ingin meningkatkan kemampuannya dalam bidang Teknologi Informasi.
                                </p>
                                <p class="lead">FIST EFFECT menyediakan beberapa opsi dalam pengembangan aplikasi menyesuaikan dengan anggaran yang disediakan dan tahap-tahapan pengembangan aplikasi sesuai dengan permintaan. Tim yang dimiliki FIST EFFECT telah berpengalaman dalam pembuatan aplikasi keuangan, persewaan, penjualan, kasir, SIG (Sistem Informasi Geograis), tracking, web profil UMKM dan beberapa sistem lainnya.</p>

                                <h3> Product FistEffect </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box_feat" id="icon_1">
                                            <span></span>
                                            <h3>Pelatihan</h3>
                                            <p>FIST EFFECT mempunyai program - program pelatihan teknologi informasi yang di butuhkan di dunia kerja maupun dunia bisnis.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box_feat" id="icon_2">
                                            <span></span>
                                            <h3>Konsultasi</h3>
                                            <p>FIST EFFECT menyediakan jasa konsultasi dan atau pendampingan dalam pembuatan project atau migrasi sistem teknologi informasi agar tetap sesuai dengan kebutuhan dan rencana..</p>
                                        </div>
                                    </div>
                                </div><!-- /row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box_feat" id="icon_3">
                                            <!-- <img src="img/aplikasi.png" width="100" height="50" align="center"> -->
                                            <h3>Pengembangan Sistem dan Aplikasi</h3>
                                            <p>FIST EFFECT juga melayani jasa pengembangan sistem dan aplikasi yang disesuaikan dengan kebutuhan perusahaan atau personal..</p>
                                        </div>
                                    </div>
                                    <!-- A -->
                                </div><!-- /row -->

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="about_info">
                                            <i class="pe-7s-news-paper"></i>
                                            <h4>Visi</h4>
                                            <font color="orange">
                                                <p>FIST EFFECT sebagai katalis perkembangan teknologi dengan menghasilkan sumber daya manusia yang sanggup mengikuti perubahan teknologi yang berpengaruh pada perkembangan bisnis.</p>
                                            </font>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="about_info">
                                            <i class="pe-7s-light"></i>
                                            <h4>Misi</h4>
                                            <font color="orange">
                                                <p>Menjalankan pelatihan, konsultasi dan pengembangan sistem dan aplikasi dengan menyediakan tenaga trainer dan konsultan yang berpengalaman dan unggul dalam mengikuti perkembangan ilmu di bidang teknologi.</p>
                                            </font>
                                        </div>
                                    </div>
                                </div><!-- /row -->
                            </div><!-- /col -->

                            <aside class="col-lg-4">
                                <div class="more_padding_left">
                                    <div class="widget" id="review">
                                        <h4>Motto</h4>
                                        <div class="owl-carousel owl-theme add_bottom_30">
                                            <div class="item">
                                                <blockquote class="testimonial">
                                                    <h2> We Broaden Your Knowledges</h2>
                                                </blockquote>
                                                <div class="testimonial-arrow-down">
                                                </div>
                                            </div><!-- /item -->

                                        </div><!-- /carousel -->
                                    </div><!-- /reviews -->

                                    <div class="widget" id="follow">
                                        <h4>follow us</h4>
                                        <ul>
                                            <li><a href="https://www.instagram.com/fisteffect/?hl=id"><i class="icon-instagram"></i>Instagram</a></li>
                                        </ul>
                                    </div><!-- /follow -->
                                </div><!-- /more padding left -->
                            </aside>
                        </div><!-- /row -->
                    </div><!-- /TAB 2:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

                    <div class="tab-pane fade" id="tab_3">

                        <div id="map_contact"></div><!-- /map -->

                        <div id="contact_info">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-map-marker"></i>
                                        <h4>Alamat</h4>
                                        <p>Perum Cand Gebang Permai Blok E12, Jetis, Jetis, Wedomartani, Ngemplak, Sleman Regency, Special Region of Yogyakarta.</p>
                                        <p>08.00 AM - 16.00 PM</p>
                                        <a href="https://goo.gl/maps/S6dRBC7XfX1vbQqK8" class="btn_1" target="_blank">Get directions</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-mail-open-file"></i>
                                        <h4>Email dan website</h4>
                                        <p>
                                            <strong>Email:</strong> <a href="#0">fisteffect.official@gmail.com</a><br>
                                            <strong>Website:</strong> <a href="#0">www.quote.com</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box_contact">
                                        <i class="pe-7s-call"></i>
                                        <h4>Telepon</h4>
                                        <p>
                                            <strong>Tel/Wa:</strong> <a href="#0">085669877118</a><br>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- / row-->
                            <hr>
                        </div><!-- /TAB 3:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

                    </div><!-- /tab content -->
                </div><!-- /container-fluid -->
            </div><!-- /wrapper_in -->
        </div><!-- /main_container -->


        <!-- Modal terms -->
        <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terms and conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                        <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                        <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn_1" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- SCRIPTS -->
        <!-- Jquery-->
        <script src="<?= base_url(); ?>includes/dist/js/jquery-3.2.1.min.js"></script>
        <!-- Common script -->
        <script src="<?= base_url(); ?>includes/dist/js/common_scripts_min.js"></script>
        <!-- Theme script -->
        <script src="<?= base_url(); ?>includes/dist/js/functions.js"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.min.js"></script>
        <script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.full.min.js"></script>
        <script src="<?php echo base_url() ?>includes/dist/js/pages/forms/select2/select2.init.js"></script>
        <!-- Google map -->
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script src="<?= base_url(); ?>includes/dist/js/mapmarker.jquery.js"></script>
        <script src="<?= base_url(); ?>includes/dist/js/mapmarker_func.jquery.js"></script>

</body>

</html>