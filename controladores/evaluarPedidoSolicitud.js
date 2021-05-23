escuchar();

function escuchar(){
    $('#botonAceptar').on('click', function(){
        aceptar();
    }) 
    
    $('#botonRechazar').on('click', function(){
        rechazar();
    })
    
    $('#botonCancelar').on('click', function(){
        redireccionA("../vista/vista_solicitudes_nuevas.php");
    })
}

function aceptar() {
    fechaAccion = fecha();
    Swal.fire({
        title: 'Esta seguro de aceptar esta Solicitud? #'+id+'/'+montoSolicitud+'/'+montoUnidad,
        text: fechaAccion,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
        }).then((result) => {
            
            if (result.isConfirmed) {
                if(esPosibleAutorizar()){
                    mensajeConfirmacion(id,fechaAccion,1);
                }else{
                    mensajeAviso("Solicitud de pedido RECHAZADA!","El monto de la presente solicitud sobrepasa el limite establecido por la Institucion",'warning');
                }
            }else{
                redireccionA("../vista/vista_detalle.php");
            }
    })
}

function rechazar() {
    fechaAccion = fecha();
    Swal.fire({
    input: 'textarea',
    inputLabel: 'Justificacion de Rechazo de la Solicitud #:'+id,
    inputPlaceholder: 'Ingrese los motivos por el cual se rechazo la solicitud de Pedido...',
    inputAttributes: {'aria-label': 'Type your message here'},
    showCancelButton: true,
    confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            var det = Swal.getInput().value;
            var detalle = quitarEspacios(det);
            if(verificar(det) && verificarPatron(det, /^[a-zA-Z][a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s?\.?\,?]+/)){
                Swal.fire({
                    title: 'SOLICITUD RECHAZADA!',
                    text: 'La solicitud ha sido rechazada por los siguientes motivos:' + det,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) =>{
                    if(result.isConfirmed){
                        redireccionA("../controladores/actualizarPedidoSolicitud.php?detalle="+detalle+"&id="+id+"&fecha="+fechaAccion);
                    }
                })
            }else{
                mensajeError();
            }
        }else{
            redireccionA("../vista/vista_detalle.php");
        }
    })
}

function mensajeConfirmacion(id,fechaAccion,est){
    Swal.fire({
        title: 'SOLICITUD ACEPTADA!',
        text: 'La solicitud ha sido aceptada',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) =>{
        if(result.isConfirmed){
            redireccionA("../controladores/actualizarPedidoSolicitud.php?id="+id+"&fecha="+fechaAccion+"&e="+est);
        }
    })
}

function mensajeAviso(titulo,texto,icono) {
    Swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        confirmButtonText: 'OK'
    }).then((result) =>{
        if(result.isConfirmed){
            texto = quitarEspacios(texto);
            redireccionA("../controladores/actualizarPedidoSolicitud.php?id="+id+"&fecha="+fechaAccion+"&e=0&detalle="+texto);
        }
    })
}

function mensajeError(){
    Swal.fire({
        title: 'Ooppss...',
        text: 'Texto ingresado no valido, vuelva a intentarlo',
        icon: 'warning',
        confirmButtonText: 'OK'
    }).then((result) =>{
        if(result.isConfirmed){
            redireccionA("../vista/vista_detalle.php");
        }
    })
}

function verificar(texto) {
    res = false;
    if(texto.length > 0){
        res = true;
    }
    return res;
}

function verificarPatron(texto, patron) {
    res = false;
    if(patron.test(texto)){
        res = true;
    }
    return res;
}

function esPosibleAutorizar() {
    var res = false;
    if(montoSolicitud < 20000){
        res = true;
    }
    return res;
}

function redireccionA(url){
    window.location.href=url;
}

function quitarEspacios(texto){
    return res = texto.split(' ').join('_');
}

function fecha() {
    fecha = new Date();
    anio = fecha.getFullYear();
    mes = fecha.getMonth() + 1;
    dia = fecha.getDate();
    return anio + "-" + dosDigitos(mes) + "-" + dosDigitos(dia);
}

function dosDigitos(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}