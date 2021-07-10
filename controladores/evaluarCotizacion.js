document.getElementById("botonAceptar").onclick = function(){
    aceptar();    
}

document.getElementById("botonRechazar").onclick = function(){
    rechazar();
}

document.getElementById("botonCancelar").onclick = function(){
    redireccionA('../ruta/rutas.php?ruta=mostrar&con=cotizando')
}

function aceptar() {
    var combo = document.getElementById("empresasCotizadoras");
    var selected = combo.options[combo.selectedIndex].text;
    var idEmpresa = document.getElementById("empresasCotizadoras").value;
    fechaAccion = fecha();
    if(numCotizaciones>=3){
        
        Swal.fire({
            title: "Autorizar Cotizacion con:\n "+selected+"? ",
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
                    mensajeConfirmacion(id,fechaAccion,idEmpresa);
                }else{
                    redireccionA("../vista/vista_tablasComparativas.php?id_solicitud="+id);
                }
        })
    }else{
        insuficientes();
    }
}

function insuficientes(){
    Swal.fire({
        title: 'EMPRESAS INSUFICIENTES',
        text: 'Para ACEPTAR la licitacion de una cotizacion se debe tener al menos 3 empresas participantes',
        icon: 'warning',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        closeOnClickOutside: false,
        allowEnterKey: true
    }).then((result) =>{
        if(result.isConfirmed){
            redireccionA("../ruta/rutas.php?ruta=mostrar&con=cotizando");
        }
    })
}

function rechazar() {
    fechaAccion = fecha();
    Swal.fire({
    input: 'textarea',
    inputLabel: 'Justificacion Rechazo Solicitud de Cotizacion #'+id,
    inputPlaceholder: 'Ingrese aqui las razones de rechazo...',
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
                    title: 'COTIZACION RECHAZADA!',
                    text: 'La solicitud de Cotizacion #'+id+' ha sido rechazada',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    allowEnterKey: true
                }).then((result) =>{
                    if(result.isConfirmed){
                        redireccionA("../controladores/actualizarCotizacion.php?detalle="+detalle+"&id="+id+"&fecha="+fechaAccion+"&e=0");
                    }
                })
            }else{
                mensajeError();
            }
        }else{
            redireccionA("../vista/vista_tablasComparativas.php?id_solicitud="+id);
        }
    })
}

function mensajeConfirmacion(id,fechaAccion,est){
    Swal.fire({
        title: 'COTIZACION ACEPTADA!',
        text: 'La solicitud de cotizacion ha sido autorizada',
        icon: 'success',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        closeOnClickOutside: false,
        allowEnterKey: true
    }).then((result) =>{
        if(result.isConfirmed){
            redireccionA("../controladores/actualizarCotizacion.php?id="+id+"&fecha="+fechaAccion+"&detalle=no&e="+est);
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
            redireccionA("../vista/vista_tablasComparativas.php?id_solicitud="+id);
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