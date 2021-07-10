$(document).on("click", ".btnGuardarJust", function(){    
    id_solicitud = parseInt($(this).closest("tr").find('td:eq(1)').text());
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
                confirmButtonText: 'GUARDAR',
                cancelButtonText: 'CANCELAR',
                allowOutsideClick: false,
                closeOnClickOutside: false,
                allowEnterKey: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var codigo = Swal.getInput().value;
                    $.ajax({
                        url: "../controladores/cotizacionManual.php",
                        type: "POST",
                        cache:false,
                        dataType: "json",
                        data: {codigo:codigo, id_solicitud:id_solicitud},
                        success: function(data){ 
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
            window.location.href="../vista/formularioRE.php";
        }
    })        
});
