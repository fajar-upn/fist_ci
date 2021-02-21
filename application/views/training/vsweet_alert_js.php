<!--Custom JavaScript sweetalert-->
<script src="<?php echo base_url('includes/dist/js/custom.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/sweet-alert.init.js'); ?>"></script>
<script>
    $('.delete').on('click', function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        Swal({
            title: "Apakah anda yakin ?",
            text: "Data anda akan dihapus !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: 'Batal',
            closeOnConfirm: false
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });

    $('.delete-disable').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal({
            title: "Gagal",
            text: "Maaf, kelas tidak bisa dihapus",
            type: "error"
        }).then((result) => {
            // if (result.value) {
            //     document.location.href = href;
            // }
        })
    });

    $('.edit-disable').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal({
            title: "Gagal",
            text: "Maaf, kelas tidak bisa diubah",
            type: "error"
        }).then((result) => {
            // if (result.value) {
            //     document.location.href = href;
            // }
        })
    });

    $('.sched-disable').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal({
            title: "Gagal",
            text: "Maaf, jadwal kelas tidak bisa diubah",
            type: "error"
        }).then((result) => {
            // if (result.value) {
            //     document.location.href = href;
            // }
        })
    });
</script>