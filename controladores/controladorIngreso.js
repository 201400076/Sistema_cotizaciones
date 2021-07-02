$('#ingresar').on('click', function(){    
    let rol=document.getElementById('unidades').value;        
    usuario = $("#usuario").val();
    password = $("#password").val();  
    $.ajax({        
        url:"controladores/ingresoSolicitante.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password,rol:rol},
        success: function(fila){                          
            if(fila!=null){
                rol=fila['rolAsignado'];
                switch (rol) {
                    case 'Unidad Administrativa':
                        redireccionA("ruta/rutas.php?ruta=mostrar&con=nueva");
                        break;
                    case 'Unidad de Gasto':
                        redireccionA("vista/solicitudes_vista.php");
                        break;
                        case 'Empresa':
                            solicitud=fila['id_solicitudes'];
                            empresa=fila['id_empresa'];
                            nombre=fila['user_cotizador'];                
                            estado='empresa';
                            redireccionA("vista/registroCotizacion.php?solicitud="+solicitud+"&empresa="+empresa+"&nombre="+nombre+"&estado="+estado);          
                        break;                           
                }
            }else{
                alert("el usuario y contraseña son incorrectos");
            }            
        }        
    });
}) 

function redireccionA(url){
    window.location.href=url;
}
    