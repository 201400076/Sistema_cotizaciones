$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({              
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1d2124");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Justificacion");            
    $("#modalCRUD").modal("show");        
    id_pendientes=null;
    opcion = 1; //alta
    archivo='';
    ruta='';
});   
//boton enviar pedido
$("#btnPedido").click(function(){
    console.log(99);
    opcion=5;
    nro=54;
    $.ajax({
        url: "../modelo/solicitudes_modelo.php",
        type: "POST",
        dataType: "json",
        data: {opcion:opcion},
        success: function(nro){                         
            console(nro );
        }        
    });
    console.log(nro);
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUDJust").modal("show");       
    opcion=4; 
    justificacion='';
});  
    

$(document).on("click", ".btnGuardarJust", function(){  
    console.log(justificacion);
    justificacion = $.trim($("#Justificacion").val());
    if(justificacion==''){
        var respuesta = confirm("¿Está seguro que desea agregar el pedido si ninguna justificacion?");
        if(respuesta){           
            $.ajax({
                url: "../modelo/solicitudes_modelo.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, justificacion:justificacion},
                success: function(data){                         
                }        
            });
            $("#modalCRUDJust").modal("hide");    
        }
    }else{
        $.ajax({
            url: "../modelo/solicitudes_modelo.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, justificacion:justificacion},
            success: function(data){                       
            }        
        });
        $("#modalCRUDJust").modal("hide");            
    }
});


var fila; //capturar la fila para editar o borrar el registro    


//botón Enviar pedido



});