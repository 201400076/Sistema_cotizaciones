$('#ingresar').on('click', function() {
    usuario = $("#usuario").val();
    password = $("#password").val();
    $.ajax({
        url: "controladores/ingresoSolicitante.php",
        type: "POST",
        dataType: "json",
        data: { usuario: usuario, password: password },
        success: function(fila) {
            if (fila != null) {
                console.log(fila);
                switch (fila['rolAsignado']) {
                    case 'Unidad Administrativa':
                        rol =fila['rolAsignado'];
                        nombre=fila['nombres']+" "+fila['apellidos'];
                        unidad=fila['nombre_unidad'];
                        alert("Bienvenido "+nombre+"\nIngreso con la Unidad Administrativa: "+unidad);
                        redireccionA("./ruta/rutas.php?ruta=mostrar&con=nueva");
                        break;            
                        case 'Unidad de Gasto':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombres']+" "+fila['apellidos'];
                            unidad=fila['nombre_gasto'];
                            id_gasto=fila['id_gasto'];
                            alert("Bienvenido "+nombre+"\nIngreso con la Unidad de Gasto: "+unidad);
                            redireccionA("./vista/solicitudes_vista.php");
                        break;            
                        case 'Empresa':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombre_empresa'];
                            id_empresa=fila['id_empresa'];
                            estado='empresa'
                            if(fila['estado_cotizador']==1){
                                alert("Esta cotizacion ya fue registrada");
                            }else{                                
                                alert("Bienvenido empresa: "+nombre);
                                redireccionA("./vista/registroCotizacion.php?solicitud="+fila['id_solicitudes']+"&empresa="+fila['id_empresa']+"&nombre="+fila['user_cotizador']+"&estado="+estado);
                            }
                        break;            
                }                
            } else { 
                alert("“Error!! Usuario y Password incorrectos!!!”");
            }
        }
    });
})

function redireccionA(url) {
    window.location.href = url;
}