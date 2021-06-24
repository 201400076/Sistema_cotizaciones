$('#ingresar').on('click', function(){
    usuario = $("#usuario").val();
    password = $("#password").val();  
    $.ajax({        
        url:"../controladores/ingresoSolicitante.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password},
        success: function(fila){                          
            if(fila!=null){  
                console.log(fila);
                console.log(!fila['estado_cotizador']);
                if(fila['estado_cotizador']){
                    redireccionA("../vista/registroCotizacion.php?usuario="+fila['id_solicitudes']+"&nombre="+fila['user_cotizador']);
                }else{
                    alert("La empresa ya registro su cotizacion");
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
    