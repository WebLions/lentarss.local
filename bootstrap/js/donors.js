$( document ).ready(function() {


    $('#datetimepicker').datetimepicker({
        format: 'YYYY-M-D HH:mm:ss'
    });

    $("#add_donor").click(function () {

        $('#donors').append(
            '<tr>' +
            '<td><input type="text" name="donors[]" class="form-control" placeholder=""></td>' +
            '<td><input type="text" name="donors_mobile[]" class="form-control" placeholder=" префикс моб.версии, если есть"></td>' +
            '<td><button class="delete icon_close_alt2 btn btn-danger"></button></td>'+
            '</tr>'
        );
    });
    $("#add_category").click(function () {

        $.post('/ajax/getCategory', $('#category_block').find('select').serialize() , function(data) {
            if(data.length != 0)
                $('#category_block').append(
                    '<tr>' +
                    '<td><label for="period">Категория</label></td>' +
                    '<td><select id="category" name="category[]">'+ data +'</select></td>' +
                    '<td><button class="delete icon_close_alt2 btn btn-danger"></button></td>' +
                    '</tr>'
                );
        });
        return false;
    });

    $('#donors').on('click', '.delete', function (e) {
        e.preventDefault();
        $(this).closest( 'tr' ).remove();
        return false;
    });
    $('#category_block').on('click', '.delete', function (e) {
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
        var mobile = $('#mobile').val();
        $.post('/ajax/checkRss', {link: link, mobile: mobile}, function(data){
           $("#check_item").html(data);

        });
    });
    $('input.state').click(function(){
        var id = $(this).val();
        if( $(this).is(':checked') ){
            $.post('/ajax/checkNews', {id: id}, function(data){

            });
        }else{
            $.post('/ajax/oncheckNews', {id: id}, function(data){

            });
        }
    });
});


$( document ).ready(function() {
    $("#clear").click(function (e) {
        if(confirm("Удалить все новости?")===false){
            e.preventDefault();
            return false;
        }
    });
    $("#delete").click(function (e) {
        if(confirm("Удалить ленту?")===false){
            e.preventDefault();
            return false;
        }
    });

});