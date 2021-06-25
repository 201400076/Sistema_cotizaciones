$('#ingresar').on('click', function(){    
    usuario = $("#usuario").val();
    password = $("#password").val();  
    $.ajax({        
        url:"controladores/ingresoSolicitante.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password},
        success: function(fila){                          
            if(fila!=null){  
                console.log(fila);
                console.log(!fila['estado_cotizador']);
                if(fila['id_unidad']!=null){                    
                    //redireccionA("vista/registroCotizacion.php?usuario="+fila['id_solicitudes']+"&nombre="+fila['user_cotizador']);
                    redireccionA("vista/vista_cotizaciones_aceptadas.php");                    
                }else if(fila['id_gasto']!=null){
                    redireccionA("vista/solicitudes_vista.php");                    
                }                              
            }else{
                alert("Se debe ingresar los datos que se le proporcionó en el correo electrónico");
            }
        }        
    });
}) 

function redireccionA(url){
    window.location.href=url;
}
    