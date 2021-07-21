$(document).on("click", ".imprimir", function() {
    id_solicitud = parseInt($(this).closest("tr").find('td:eq(1)').text());
    Swal.fire({
        title: 'Esta seguro de generar una nueva solicitud de cotizacion?',
        text: "Se generara un documento pdf para el registro manual de una cotizacion",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Genera cotizacion'
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxGenerarPDF(id_solicitud);
        }
    })
});



$(document).on("click", ".btnGuardarJust", function() {
    id_solicitud = parseInt($(this).closest("tr").find('td:eq(1)').text());

    Swal.fire({
            input: 'text',
            inputLabel: 'Ingrese la clave de la solicitud  # ' + id_solicitud + " que se le asigno a la empresa",
            inputPlaceholder: 'Clave de solicitud...',
            inputAttributes: { 'aria-label': 'Type your message here' },
            showCancelButton: true,
            confirmButtonText: 'INGRESAR',
            cancelButtonText: 'CANCELAR',
            allowOutsideClick: false,
            closeOnClickOutside: false,
            allowEnterKey: true
        }).then((result) => {
            if (result.isConfirmed) {
                var codigo = Swal.getInput().value;
                console.log(codigo);
                console.log(id_solicitud);
                $.ajax({
                    url: "../controladores/cotizacionManual.php",
                    type: "POST",
                    cache: false,
                    dataType: "json",
                    data: { codigo: codigo, id_solicitud: id_solicitud },
                    success: function(data) {
                        console.log(data);
                        if (data.length != 0) {
                            if (data[0]['estado_cotizador'] == 0) {
                                id_solicitud = data[0]['id_solicitudes'];
                                id_empresa = data[0]['id_empresa'];
                                nombre_usu = data[0]['user_cotizador'];
                                estado = 'administracion';
                                window.location.href = "../vista/registroCotizacion.php?solicitud=" + id_solicitud + "&empresa=" + id_empresa + "&nombre=" + nombre_usu + "&estado=" + estado;
                            } else {
                                alert("La empresa ya registro su cotizacion");
                            }
                        } else {
                            alert('clave incorrecta');
                        }
                    }
                });
                $("#modalCRUDJust").modal("hide");
            } else {

            }
        })
        /*
        Swal.fire({
            title: 'Registro de solicitud de cotizacion # '+id_solicitud,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `empresa existente`,
            denyButtonText: `empresa nueva`,
          }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    input: 'text',
                    inputLabel: 'Ingrese la clave de la solicitud  # ' + id_solicitud+" que se le asigno a la empresa",
                    inputPlaceholder: 'Clave de solicitud...',
                    inputAttributes: { 'aria-label': 'Type your message here' },
                    showCancelButton: true,
                    confirmButtonText: 'INGRESAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    allowEnterKey: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var codigo = Swal.getInput().value;
                        console.log(codigo);
                        $.ajax({
                            url: "../controladores/cotizacionManual.php",
                            type: "POST",
                            cache:false,
                            dataType: "json",
                            data: {codigo:codigo, id_solicitud:id_solicitud},
                            success: function(data){ 
                                console.log(data);
                                if(data.length!=0){
                                    if(data[0]['estado_cotizador']==0){
                                        id_solicitud=data[0]['id_solicitudes'];
                                        id_empresa=data[0]['id_empresa'];
                                        nombre_usu=data[0]['user_cotizador'];
                                        estado='administracion';
                                        window.location.href="../vista/registroCotizacion.php?solicitud="+id_solicitud+"&empresa="+id_empresa+"&nombre="+nombre_usu+"&estado="+estado;
                                    }else{
                                        alert("La empresa ya registro su cotizacion");
                                    }
                                }else{
                                    alert('clave incorrecta');
                                }
                            }        
                        });
                        $("#modalCRUDJust").modal("hide");  
                    } else {
                       
                    }
                })
            } else if (result.isDenied) { 
                $("#modalRegistro").modal("show");  
                //window.location.href="../vista/formularioREM.php?es="+id_solicitud;
            }
        })  */
});

$(document).on("click", ".registrarEmpresa", function() {
    nombre = $.trim($("#nombre").val());
    correo = $.trim($("#correo").val());
    nit = $.trim($("#nit").val());
    telefono = $.trim($("#telefono").val());
    direccion = $.trim($("#direccion").val());
    rubro = $.trim($("#ru").val());
    if (nombre.length >= 6) {
        if (validarEmail(correo)) {
            // ajaxRegistro(nombre,correo,telefono,direccion,rubro,id_solicitud);
        } else {
            Swal.fire("Error!!\ncorreo electronico invalido");
        }
    } else {
        Swal.fire("Error!!\nEl nombre de la empresa debe contener minimo 6 caracteres");
    }

});

function redireccionA(url) {
    window.location.href = url;
}

function ajaxRegistro(nombre, correo, telefono, direccion, rubro, id_solicitud) {
    $.ajax({
        url: "../controladores/registrarEmpresa.php",
        type: "POST",
        cache: false,
        dataType: "json",
        data: { nombre: nombre, correo: correo, nit: nit, telefono: telefono, direccion: direccion, rubro: rubro, id_solicitud: id_solicitud },
        success: function(data) {
            console.log(data);
            estado = 'administracion';
            alert('El usuario temporal para esta cotizacion es:\nUser:' + data[0]['user_cotizador'] + "\nPassword" + data[0]['password_cotizador']);
            redireccionA("../vista/registroCotizacion.php?solicitud=" + data[0]['id_solicitudes'] + "&empresa=" + data[0]['id_empresa'] + "&nombre=" + data[0]['user_cotizador'] + "&estado=" + estado);
        }
    });
}

function ajaxCotizador(codigo, id_solicitud) {
    $.ajax({
        url: "../controladores/cotizacionManual.php",
        type: "POST",
        cache: false,
        dataType: "json",
        data: { codigo: codigo, id_solicitud: id_solicitud },
        success: function(data) {
            console.log(data);
            if (data.length != 0) {
                if (data[0]['estado_cotizador'] == 0) {
                    id_solicitud = data[0]['id_solicitudes'];
                    id_empresa = data[0]['id_empresa'];
                    nombre_usu = data[0]['user_cotizador'];
                    estado = 'administracion';
                    window.location.href = "../vista/registroCotizacion.php?solicitud=" + id_solicitud + "&empresa=" + id_empresa + "&nombre=" + nombre_usu + "&estado=" + estado;
                } else {
                    alert("La empresa ya registro su cotizacion");
                }
            } else {
                alert('clave incorrecta');
            }
        }
    });
}

function ajaxGenerarPDF(id_solicitud) {
    $.ajax({
        url: "../controladores/generarPDF.php",
        type: "POST",
        cache: false,
        dataType: "json",
        data: { id_solicitud: id_solicitud },
        success: function(data) {
            usuer = data[0]['user_cotizador'];
            codigo = usuer;
            password = data[0]['password_cotizador'];
            Swal.fire('Se genero la solicitud de cotizacion:\n' + usuer)
            window.open("/Sistema_cotizaciones/archivos/cotizacionesEnviadas/" + usuer + ".pdf", usuer, "width=1200,height=500,scrollbars=NO")

        }
    });
}

function validarEmail(valor) {
    re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if (!re.exec(valor)) {
        return true;
    } else {
        return false;
    }
}