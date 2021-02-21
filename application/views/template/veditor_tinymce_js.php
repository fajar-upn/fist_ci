<script src="<?php echo base_url('includes/assets/libs/tinymce/tinymce.min.js'); ?>"></script>
<script>
	$(document).ready(function() {

		if ($("#mymce").length > 0) {
			tinymce.init({
				selector: "textarea#mymce",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
	});
</script>
