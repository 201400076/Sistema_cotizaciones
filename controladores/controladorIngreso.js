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
                        redireccionA("ruta/rutas.php?ruta=mostrar&con=nueva");
                        break;            
                        case 'Unidad de Gasto':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombres']+" "+fila['apellidos'];
                            unidad=fila['nombre_gasto'];
                            id_gasto=fila['id_gasto'];
                            alert("Bienvenido "+nombre+"\nIngreso con la Unidad de Gasto: "+unidad);
                            redireccionA("vista/solicitudes_vista.php?id_unidad="+fila['id_gasto']);
                        break;            
                        case 'Empresa':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombre_empresa'];
                            alert("Bienvenido empresa: "+nombre);
                            //redireccionA("vista/registroCotizacion.php?usuario="+fila['id_solicitudes']+"&nombre="+fila['user_cotizador']);
                        break;            
                }
                if (fila['id_unidad'] != null) {
                    //redireccionA("ruta/rutas.php?ruta=mostrar&con=nueva");
                } else if (fila['id_gasto'] != null) {
                }
            } else { 
                alert("Se debe ingresar los datos que se le proporcionó en el correo electrónico");
            }
        }
    });
})

function redireccionA(url) {
    window.location.href = url;
}