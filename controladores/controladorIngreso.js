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
                redireccionA("../vista/registroCotizacion.php?usuario="+fila['id_solicitudes']);
            }else{
                alert("Usuario y contraseña incorrectos!!");
            }
        }        
    });
}) 

function redireccionA(url){
    window.location.href=url;
}
    