$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success cotizar' >COTIZAR</button></div></div>"  
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
    $(".modal-title").text("Nueva Persona");            
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
    

$(document).on("click", ".btnEnviar", function(){  
    $.ajax({        
        url:"../modelo/actualizarCotizacionEmpresa.php",
        type: "POST",
        dataType: "json",
        data: {id_solicitud:id_solicitud,nombre_usu:nombre_usu,id_empresa:id_empresa},
        success: function(fila){  
            console.log(fila);                        
            if(fila==null){                                
                alert("Error no puedo registrar la cotizacion");
            }else{                
                alert("Se agrego correctamente tu cotizacion");
                window.location.href = "../index.php";
            }
        }              
    });   
});



//botón cotizar
$(document).on("click", ".cotizar", function(){        
    $("#formPersonas").trigger("reset");
    id_item=parseInt($(this).closest("tr").find('td:eq(0)').text());
    $(".modal-title").text("COTIZACION DE ITEM "+parseInt($(this).closest("tr").find('td:eq(0)').text()));   
    $("#cantidad").val(parseInt($(this).closest("tr").find('td:eq(1)').text()));     
    console.log(parseInt($(this).closest("tr").find('td:eq(1)').text()));
    
    $.ajax({        
        url:"../modelo/actualizarPedido.php",
        type: "POST",
        dataType: "json",
        data: {id_item:id_item,id_empresa:id_empresa,id_solicitud:id_solicitud},
        success: function(fila){  
            console.log(fila);
            if(fila.length==0){
                console.log('null');
                $(".modal-header").css("background-color", "#28a745");
                $(".modal-header").css("color", "white");
                $("#modalCRUD").modal("show");  
            }else{
                marca=fila[0]['marca'];
                modelo=fila[0]['modelo'];
                descripcion=fila[0]['descripcion'];
                total=fila[0]['precio_parcial'];
                unit=fila[0]['precio_unitario'];
                cantidad=fila[0]['cantidad'];
                $("#formPersonas").trigger("reset");
                $(".modal-header").css("background-color", "#FF5733");
                $(".modal-header").css("color", "white");
                
                $("#marca").val(marca);
                $("#modelo").val(modelo);
                $("#descripcion").val(descripcion);
                $("#total").val(total);
                $("#unit").val(unit);
                $("#cantidad").val(cantidad);
                
                $("#modalCRUD").modal("show");              
            }
        }              
    });
    
    
});

$(document).on("click", ".cotizado", function(){    
    
    $("#formPersonas").trigger("reset");
    $(".modal-header1").css("background-color", "#17a2b8");
    $(".modal-header1").css("color", "white");
    $(".modal-title1").text("COTIZACION DE ITEM "+parseInt($(this).closest("tr").find('td:eq(0)').text()));   
    $(".modal-header1").css("text", "center");   
    id=parseInt($(this).closest("tr").find('td:eq(0)').text())      
    $("#modalCRUDJust"+id).modal("show");  

    cantidad = parseInt($(this).closest("tr").find('td:eq(0)').text()); 
    console.log(cantidad);
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
          console.log("El documento excede el tamaño máximo");
          $('#modal-title').text('¡Precaución!');
          $('#modal-msg').html("Se solicita un archivo no mayor a 5MB. Por favor verifica.");
          $("#modal-gral").modal();           
          $(this).val('');
        }else{    
            var miArchivo=$(this)[0].files[0]
            var datosForm=new FormData;
            datosForm.append("archivo",miArchivo);
            var destino="subir.php";
            console.log(miArchivo);

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
    marca = $.trim($("#marca").val());
    modelo = $.trim($("#modelo").val());    
    descripcion = $.trim($("#descripcion").val());      
    unit = $.trim($("#unit").val());      
    total = $.trim($("#total").val());         
    if(marca!='' && marca.length>=1 && marca.length<=20){
        if(modelo!='' && modelo.length<=50 && modelo.length>=1){
            if(unit!=''){
                $.ajax({        
                    url:"../modelo/cotizacionItem.php",
                    type: "POST",
                    dataType: "json",
                    data: {marca:marca,modelo:modelo,descripcion:descripcion,unit:unit,total:total,id_item:id_item,id_empresa:id_empresa,id_solicitud:id_solicitud},
                    success: function(fila){  
                        console.log(fila);                        
                        if(fila==null){                                
                            alert("No se pudo ingresar la cotizacion!");
                        }else{
                            alert("Se agrego una nueva cotizacion del item: "+fila[0]['id_items']);
                        }
                    }              
                });
                $("#modalCRUD").modal("hide");
                window.location.href="../vista/registroCotizacion.php?solicitud="+id_solicitud+"&empresa="+id_empresa+"&nombre="+nombre_usu+"&estado="+estado;
            }else{        
                alert("Debe ingresar un precio unitario");
            }
        }else{        
            alert("La Modelo debe ser un texto entre 1 y 50 caracteres");
        }
    }else{        
        alert("La marca debe ser un texto entre 1 y 20 caracteres");
    } 
});    
    
});