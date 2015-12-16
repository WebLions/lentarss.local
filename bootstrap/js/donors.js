console.log('swag');
$( document ).ready(function() {

$("#add_donor").click(function () {

    console.log('swag');
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