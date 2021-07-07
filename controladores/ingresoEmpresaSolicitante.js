$('#ingresar').on('click', function(){                
    usuario = $("#usuario").val();
    password = $("#password").val();  
    $.ajax({        
        url:"../controladores/ingresoEmpresaSolicitante.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password},
        success: function(fila){                          
            if(fila!=null){
                solicitud=fila['id_solicitudes'];
                empresa=fila['id_empresa'];
                nombre=fila['user_cotizador'];     
                estado='administrador';
                redireccionA("../vista/registroCotizacion.php?solicitud="+solicitud+"&empresa="+empresa+"&nombre="+nombre+"&estado="+estado);     
            }else{
                alert("el usuario y contraseña son incorrectos");
            }            
        }        
    });
}) 

function redireccionA(url){
    window.location.href=url;
}
    