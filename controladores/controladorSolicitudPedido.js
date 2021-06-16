$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
        "destroy":true,
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar' >BORRAR</button></div></div>"  
       }],
        
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
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("NUEVO ITEM");            
    $("#modalCRUD").modal("show");        
    id_pendientes=null;
    opcion = 1; //alta
    archivo='';
    ruta='';
});   
//boton enviar pedido
$("#btnPedido").click(function(){   
    console.log("hola");
    console.log(id_usu);    
    $.ajax({        
        url:"../controladores/tablaVacia.php",
        type: "POST",
        dataType: "json",
        data: {id_usu:id_usu},
        success: function(fila){                          
            if(fila!=null){  
                if(!fila){
                    $("#formPersonas").trigger("reset");
                    $(".modal-header").css("background-color", "#28a745");
                    $(".modal-header").css("color", "white");
                    $(".modal-title").text("Nueva Persona");            
                    $("#modalCRUDJust").modal("show");       
                    opcion=4; 
                    justificacion='';                    
                }else{
                    alert("Debe ingresar almenos 1 item antes de enviar");                
                }                              
            }else{                
            }
        }        
    });   
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
                cache:false,
                dataType: "json",
                data: {opcion:opcion, justificacion:justificacion},
                success: function(data){                         
                }        
            });
            $("#modalCRUDJust").modal("hide");  
            window.location.href="../vista/solicitudes_vista.php";             
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
        window.location.href="../vista/solicitudes_vista.php";                     
    }
});


var fila; //capturar la fila para editar o borrar el registro    

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id_pendientes = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Esta seguro de eliminar el item?");
    if(respuesta){
        $.ajax({
            url: "../modelo/solicitudes_modelo.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_pendientes:id_pendientes},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

//botón Enviar pedido


$('input[type="file"]').on('change', function(){
    
    var ext = $( this ).val().split('.').pop();
    archivo=$(this)[0].files[0].name;    
    //ruta0=$(this).val();    
    
    ruta=document.getElementById('archivo').value;;
    
    if ($( this ).val() != '') {
      if(ext == "pdf"){
        //alert("La extensión es: " + ext);
        if($(this)[0].files[0].size > 5242880){          
          $('#modal-title').text('¡Precaución!');
          $('#modal-msg').html("Se solicita un archivo no mayor a 5MB. Por favor verifica.");
          $("#modal-gral").modal();           
          $(this).val('');
        }else{    
            var miArchivo=$(this)[0].files[0]
            var datosForm=new FormData;
            datosForm.append("archivo",miArchivo);
            var destino="subir.php";            

            $.ajax({
                type:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data:datosForm,
                url:"../controladores/subir.php"
            }).done(function(data){
                ruta=data;                
            }).fail(function(data){
                alert("error al subir el archivo, vuelva a seleccionar otro archivo");
            });
          $("#modal-gral").hide();
        }
      }
      else
      {
        $( this ).val('');
        alert("Solo se puede agregar archivos .pdf");
      }
    }
  });

$("#formPersonas").submit(function(e){
    e.preventDefault();    
    cantidad = $.trim($("#cantidad").val());
    unidad = $.trim($("#unidad").val());    
    detalle = $.trim($("#detalle").val());      
    if(cantidad!='' && cantidad>=1 && cantidad<=1000000){
        if(unidad!='' && unidad.length>=1 && unidad.length<=10){
            if(archivo!=0 || detalle!=0){
                if(detalle.length<=200){
                    $.ajax({
                        url: "../modelo/solicitudes_modelo.php",
                        type: "POST",
                        dataType: "json",
                        data: {cantidad:cantidad, unidad:unidad, detalle:detalle, id_pendientes:id_pendientes, opcion:opcion,ruta:ruta, archivo:archivo},
                        success: function(data){                          
                            id_pendientes = data[0].id_pendientes;            
                            cantidad = data[0].cantidad;
                            unidad = data[0].unidad;
                            detalle = data[0].detalle;
                            archivo = data[0].archivo;
                            if(opcion == 1){
                                tablaPersonas.row.add([id_pendientes,cantidad,unidad,detalle,archivo]).draw();
                            }
                            else{
                                tablaPersonas.row(fila).data([id_pendientes,cantidad,unidad,detalle,archivo]).draw();
                            }            
                        }        
                    });
                    $("#modalCRUD").modal("hide");    
                }else{
                    alert("Error!!\nDebe introducir detelle maximo de 200 caracteres");
                }                                        
            }else{
                alert("Error!!\nDebe introducir el detalle o un archivo");
            }
        }else{
            alert("Error!!\nDebe introducir una unidad entre 1 y 10 caracteres");
        }
    }else{
        alert("Error!!\nDebe introducir una cantidad entre 1 y 1000000");
    }
});    
    
});