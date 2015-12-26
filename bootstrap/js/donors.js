$( document ).ready(function() {

    $("#add_donor").click(function () {

        $('#donors').append(
            '<tr>' +
            '<td><input type="text" name="donors[]" class="form-control" placeholder=""></td>' +
            '<td><button class="delete icon_close_alt2 btn btn-danger"></button></td>'+
            '</tr>'
        );
    });

    $('#donors').on('click', '.delete', function (e) {
        e.preventDefault();
        $(this).closest( 'tr' ).remove();
        return false;
    });
});

$( document ).ready(function() {

    $("#add_donor_spec").click(function () {

        $('#donors_spec').append(
            '<tr>'+
            '<td>'+
            '<select name="id_rss" class="form-control m-bot15">'+
                '<?php foreach ($rss as $rs) {?>'+
                '<option value="<?=$rs[\'id\']?>"><?=$rs[\'title\']?></option>'+
                '<?php } ?>'+
            '</select>'+
            '</td>'+
            '<td>'+
            '<button class="delete icon_close_alt2 btn btn-danger"></button>'+
            '</td'+
            '</tr>'
        );
    });

    $('#donors_spec').on('click', '.delete', function (e) {
        e.preventDefault();
        $(this).closest( 'tr' ).remove();
        return false;
    });
});