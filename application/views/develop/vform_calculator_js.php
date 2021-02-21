<script>
$(function() {
    var dificulties = JSON.parse('<?php echo json_encode($dificulties) ?>');
    var dataFitur= new Array();

    console.log(dificulties);

    $("#btn-tambah").unbind('click').on('click', function() {

        var fiturName = $('#nama-fitur').val();
        console.log(fiturName);
        var selectedVal = $("#kesulitan").val();
        console.log(selectedVal);

        if (selectedVal != null && fiturName != '') {
            var fitur = {
                dfeature_name: fiturName,
                dfeature_module_fk: selectedVal,
                dfeature_contract_fk: 0,
            };
            dataFitur.push(fitur);
            console.log(dataFitur);
            refreshTable();
        }       
    });


    $("#btn-hapus-semua-fitur").unbind('click').on('click', function() {
        $('#table-fitur').empty();
        dataFitur= new Array();
    });
    
    function refreshTable () {
        console.log('table refreshed');

        var number = 0;
        var lprice = 0;
        var hprice = 0;
        var sdur = 0;
        var ldur = 0;
        
        $('#table-fitur').empty();
        $.each(dataFitur, function(id, data){
            $.each(dificulties, function(key, value){
                if (value.dmodules_id == data.dfeature_module_fk) {
                    $('#table-fitur').append(
                        '<tr><td>'+ (number+1) +'</td><td>'
                        + data.dfeature_name +'</td><td>'+ value.dmodules_difficulties
                        +'</td><td>'+ value.dmodules_lowest_price
                        + ' - ' + value.dmodules_highest_price+' rupiah</td><td>'
                        + value.dmodules_shortestdur + ' - ' + value.dmodules_longestdur
                        +' bulan</td><td>'+ '<button type="submit" id="btn-delete-fitur" class="btn btn-sm btn-danger" data-index="'
                        + number +'"><i id="btn-delete-fitur" class="fa fa-trash" data-index="'
                        + number +'"></i></button>' +'</td></tr>'
                    );

                    lprice+=parseInt(value.dmodules_lowest_price);
                    hprice+=parseInt(value.dmodules_highest_price);
                    sdur+=parseInt(value.dmodules_shortestdur);
                    ldur+=parseInt(value.dmodules_longestdur);
                }
            });
            number++;
        });
        $('#table-fitur').append(
            '<tr><td colspan="3" style="text-align:center"><b>Total</b></td><td><b>'
            + lprice + ' - ' + hprice + ' rupiah</b></td><td><b>'
            + sdur + ' - ' + ldur + ' bulan</b></td><td></td></tr>'
        );
    }

    var myTable = document.getElementById('table-fitur');
    myTable.addEventListener('click', function (e) {
        var element = e.target;
        var elementId = element.id;
        if (elementId == 'btn-delete-fitur') {
            index = element.dataset.index;
            console.log(index);
            dataFitur.splice(index, 1);
            refreshTable();
        }
        
    }, false);


    $("#form-submit").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: '<?=base_url('dev_calculator/insert')?>',
            type: 'POST',
            data: formData,
            success: function (response) {
                $.each(dataFitur, function(id, data){
                    data.dfeature_contract_fk = response;
                });

                console.log(dataFitur);
                
                $.post('<?=base_url('dev_calculator/insertFitur')?>', {
                    data: dataFitur
                },function(response) {
                    console.log(response);
                }).done(function() {
                    window.location = '<?=base_url('dev_contract')?>';
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
</script>