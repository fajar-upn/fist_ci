<div class="row">
    <div class="col-sm-12 align-self-center">
        <h4 class="page-title">Feedback <?= $titlebreadcrumb ?></h4>
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                    <?php if ($titlebreadcrumb == "Workshop & Seminar") { ?>
                        <?php if (!empty($management)) { ?>
                            <li class="breadcrumb-item"><a href="">Daftar Kegiatan <?= $titlebreadcrumb ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manajemen Feedback <?= $titlebreadcrumb ?></li>
                        <?php } else { ?>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Kegiatan <?= $titlebreadcrumb ?></li>
                        <?php }
                    } else { ?>
                        <li class="breadcrumb-item active" aria-current="page">Manajemen Feedback <?= $titlebreadcrumb ?></li>
                    <?php } ?>
                </ol>
            </nav>
        </div>
    </div>
</div>