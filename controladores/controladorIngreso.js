$('#ingresar').on('click', function() {
    usuario = $("#usuario").val();
    password = $("#password").val();
    $.ajax({
        url: "controladores/ingresoSolicitante.php",
        type: "POST",
        dataType: "json",
        data: { usuario: usuario, password: password },
        success: function(fila) {
            console.log(fila);
            if (fila != null) {
                switch (fila['rolAsignado']) {
                    case 'Unidad Administrativa':
                        rol =fila['rolAsignado'];
                        nombre=fila['nombres']+" "+fila['apellidos'];
                        unidad=fila['nombre_unidad'];
                        Swal.fire({
                            title: 'Bienvenido '+ nombre,
                            text: "Ustede esta ingresando con la unidad administrativa\n"+unidad,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                          }).then((result) => {
                            if (result.isConfirmed) {
                                redireccionA("./ruta/rutas.php?ruta=mostrar&con=nueva");
                            }
                          })
                        break;            
                        case 'Unidad de Gasto':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombres']+" "+fila['apellidos'];
                            unidad=fila['nombre_gasto'];
                            id_gasto=fila['id_gasto'];
                            Swal.fire({
                                title: 'Bienvenido '+ nombre,
                                text: "Ustede esta ingresando con la unidad de Gasto\n"+unidad,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                              }).then((result) => {
                                if (result.isConfirmed) {
                                    redireccionA("./vista/solicitudes_vista.php");                                  
                                }
                              })
                        break;            
                        case 'Empresa':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombre_empresa'];
                            id_empresa=fila['id_empresa'];
                            estado='empresa'
                            if(fila['estado_cotizador']==1){
                                Swal.fire("Esta cotizacion ya fue registrada");
                            }else{    
                                Swal.fire({
                                    title: 'Bienvenido '+ nombre,
                                    text: "Puede proceder a registrar su cotizacion",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        redireccionA("./vista/registroCotizacion.php?solicitud="+fila['id_solicitudes']+"&empresa="+fila['id_empresa']+"&nombre="+fila['user_cotizador']+"&estado="+estado);
                                    }
                                  })                            

                            }
                        break;  
                        case 'Administrador':
                            rol =fila['rolAsignado'];
                            nombre=fila['nombres']+" "+fila['apellidos'];
                            Swal.fire({
                                title: 'Bienvenido Administrador',
                                text: "Ustede esta ingresando como administrador",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                              }).then((result) => {
                                if (result.isConfirmed) {
                                    redireccionA("./vista/home.php");
                                }
                              })
                        break;           
                }                
            } else { 
                Swal.fire("“Error!! Usuario y Password incorrectos!!!”");
            }
        }
    });
})

function redireccionA(url) {
    window.location.href = url;
}