$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: '../php/cargar_uadmin.php'
    })
    .done(function(listas_uadmin){
        $('#uadmin').html(listas_uadmin)
    })
    .fail(function(){
        alert('Hubo un errror al cargar las listas_rep')
    })


    $('#uadmin').on('change', function(){
        var id = $('#uadmin').val()
        $.ajax({
            type: 'POST',
            url: '../php/cargar_ugasto.php',
            data: {'id': id}
        })
        .done(function(listas_uadmin){
            $('#ugasto').html(listas_uadmin)
        })
        .fail(function(){
            alert('Hubo un errror al cargar las ugasto')
        })
    })
})