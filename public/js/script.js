$(document).ready(function(){
    $('#alert').hide();
    $(".btn-delete").click(function(e){
        e.preventDefault();
        if (!confirm("¿Está seguro de eliminar?")) {
            return false;
        }
        var row     = $(this).parents('tr');
        var form    = $(this).parents('form');
        var url     = form.attr('action');

        $('#alert').show();
        $.post(url, form.serialize(), function(result){
            row.fadeOut();
        }).fail(function(){
            $('#alert').html("algo salió mal");
        });
    });
});
