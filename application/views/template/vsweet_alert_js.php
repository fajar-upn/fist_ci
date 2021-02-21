<script src="<?php echo base_url('includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/sweet-alert.init.js'); ?>"></script>

<script>
$(document).ready(function() {
    $('.sa-hapus').click(function (event){
        var link = $(this) .attr("href");
        event.preventDefault();

        swal({
            title: "Apakah anda yakin ingin menghapus?",
            text: "Data ini akan dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Tidak, batalkan!",
        }).then((result) => {
            if (result.value) {
                document.location.href = link;
            }
        });
    });
})
</script>

