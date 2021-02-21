<!-- javascript auto complete -->
<script src="<?php echo base_url() . 'includes/assets/libs/typeahead.js/dist/typeahead.jquery.min.js' ?>"></script>
<script src="<?php echo base_url() . 'includes/assets/libs/typeahead.js/dist/bloodhound.min.js' ?>"></script>
<script src="<?php echo base_url() . 'includes/dist/js/pages/forms/typeahead/typeahead.init.js' ?>"></script>
<script src="<?php echo base_url() . 'includes/assets/libs/select2/dist/js/select2.full.min.js' ?>"></script>
<script src="<?php echo base_url() . 'includes/assets/libs/select2/dist/js/select2.min.js' ?> "></script>
<script src="<?php echo base_url() . 'includes/dist/js/pages/forms/select2/select2.init.js' ?>"></script>

<!-- javascript data table -->
<?php $this->load->view('template/vdatatable_js.php') ?>
<?php $this->load->view('template/vtemplate_notif') ?>

<!-- Custom script Sweetalert -->
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('includes/assets/libs/sweetalert2/sweet-alert.init.js'); ?>"></script>

<script>
    $(document).ready(function() {

        $('.sa-delete-fl').click(function(event) {
            var link = $(this).attr("href");
            event.preventDefault();

            swal({
                title: "Apakah Anda yakin ingin menghapus berkas?",
                text: "Anda tidak akan bisa mengembalikan data ini jika belum didownload",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Tidak, batalkan!",
            }).then((result) => {
                if (result.value) {
                    document.location.href = link;
                }
            });
        });
    })
</script>