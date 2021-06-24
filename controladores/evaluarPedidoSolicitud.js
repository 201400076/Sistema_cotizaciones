document.getElementById("botonAceptar").onclick = function(){
    aceptar();
}

document.getElementById("botonRechazar").onclick = function(){
    rechazar();
}

document.getElementById("botonCancelar").onclick = function(){
    redireccionA('../ruta/rutas.php?ruta=mostrar&con=nueva')
}

function aceptar() {
    fechaAccion = fecha();
    Swal.fire({
        title: 'Esta seguro de aceptar la Solicitud de Pedido #'+id+'? ',
        text: "En fecha: "+fechaAccion,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO',
        allowOutsideClick: false,
        closeOnClickOutside: false,
        allowEnterKey: true
        }).then((result) => {
            
            if (result.isConfirmed) {
                //mensajeConfirmacion(id,fechaAccion,1);
                registrarFecha(fechaAccion);
                
                /*if(esPosibleAutorizar()){
                    mensajeConfirmacion(id,fechaAccion,1);
                }else{
                    mensajeAviso("Solicitud de pedido RECHAZADA!","El monto de la presente solicitud sobrepasa el limite establecido por la Institucion",'warning');
                }*/
            }else{
                redireccionA("../vista/vista_detalle.php?id_solicitud="+id+"&id_pedido="+id_pedido+"&id_usuario="+id_usuario);
            }
    })
}

function rechazar() {
    fechaAccion = fecha();
    Swal.fire({
    input: 'textarea',
    inputLabel: 'Justificacion de Rechazo de la Solicitud #'+id,
    inputPlaceholder: 'Ingrese aqui el justificativo...',
    inputAttributes: {'aria-label': 'Type your message here'},
    showCancelButton: true,
    confirmButtonText: 'GUARDAR',
    cancelButtonText: 'CANCELAR',
    allowOutsideClick: false,
    closeOnClickOutside: false,
    allowEnterKey: true
    }).then((result) => {
        if (result.isConfirmed) {
            var det = Swal.getInput().value;
            var detalle = quitarEspacios(det);
            if(verificar(det) && verificarPatron(det, /^[a-zA-Z][a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s?\.?\,?]+/)){
                Swal.fire({
                    title: 'SOLICITUD RECHAZADA!',
                    text: 'La solicitud #'+id+' ha sido rechazada',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    allowEnterKey: true
                }).then((result) =>{
                    if(result.isConfirmed){
                        redireccionA("../controladores/actualizarPedidoSolicitud.php?detalle="+detalle+"&id="+id+"&fecha="+fechaAccion+"&e=0");
                    }
                })
            }else{
                mensajeError();
            }
        }else{
            redireccionA("../vista/vista_detalle.php?id_solicitud="+id+"&id_pedido="+id_pedido+"&id_usuario="+id_usuario);
        }
    })
}

function registrarFecha(fech){
    var fechaSumada = '789';
    (async () => {

        const ipAPI = '//api.ipify.org?format=json'
        
        //const inputValue = fetch(ipAPI)
        //  .then(response => response.json())
        //  .then(data => data.ip)
        
        const { value: fechaFin } = await Swal.fire({
            title: 'Establecer periodo de Cotizacion',
            input: 'number',
            inputLabel: "Ingrese el numero de dias para enviar y recepcionar cotizaciones\n min: 1 - max: 30",
            //inputValue: inputValue,
            showCancelButton: true,
            allowOutsideClick: false,
            closeOnClickOutside: false,
            allowEnterKey: true,
            inputValidator: (value) => {
            if (!value || value==0 || value>30) {
                return 'Debes ingresar un numero dentro del rango!'
            }
          }
        })
        if (fechaFin) {
            Swal.fire({
                title: 'SOLICITUD ACEPTADA!',
                text: 'Fecha de Licitacion de Cotizaciones: '+fech+"\n"+`Periodo de Cotizacion: ${fechaFin} dias.`,
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                closeOnClickOutside: false,
                allowEnterKey: true
            }).then((result) =>{
                if(result.isConfirmed){
                    redireccionA("../controladores/actualizarPedidoSolicitud.php?id="+id+"&fecha="+fech+"&e="+fechaFin+"&detalle=0");
                }
            })
            
            //Swal.fire('Fecha Inicio : '+fech+`\nPeriodo de Cotizacion: ${fechaFin} dias`)
        }
        
    })()
}

function sumarDias(fecha, dias){
    fecha.setDate(fecha.getDate() + dias);
    return fecha;
  }

function mensajeAviso(titulo,texto,icono) {
    Swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        closeOnClickOutside: false,
        allowEnterKey: true
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
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        closeOnClickOutside: false,
        allowEnterKey: true
    }).then((result) =>{
        if(result.isConfirmed){
            redireccionA("../vista/vista_detalle.php?id_solicitud="+id+"&id_pedido="+id_pedido+"&id_usuario="+id_usuario);
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