$( document ).ready(function() {


    $('#datetimepicker').datetimepicker({
        format: 'YYYY-M-D HH:mm:ss'
    });

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

        $.post('/ajax/getRss', $('#donors_spec').find('select').serialize() , function(data){
            $('#donors_spec').append(
                '<tr>'+
                '<td>'+
                '<select name="id_rss[]" class="form-control m-bot15">'+
                data +
                '</select>'+
                '</td>'+
                '<td>'+
                '<button class="delete icon_close_alt2 btn btn-danger"></button>'+
                '</td>'+
                '</tr>'
            );
        });

    });

    $('#donors_spec').on('click', '.delete', function (e) {
        e.preventDefault();
        $(this).closest( 'tr' ).remove();
        return false;
    });

    $('#check').click(function(){
        var link = $('#link').val();
        $.post('/ajax/checkRss', {link: link}, function(data){
           $("#check_item").html(data);

        });
    });
});


$( document ).ready(function() {
    $("#icon_tags_alt").click(function () {
        var result = confirm("Удалить новость?");
        alert(result);
        return result;
    });

});