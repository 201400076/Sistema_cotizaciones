obtenerValores();

function obtenerValores(){
    const $formulario = document.querySelector("#formulario"),
            $remitente = document.querySelector("#remitente"),
            $asunto = document.querySelector("#asunto"),
            $descripcion = document.querySelector("#descripcion"),
            $marcar = document.querySelector("#marcar[]");

        $formulario.onsubmit = evento => {
            evento.preventDefault();
            const remitente = $remitente.value,
                asunto = $asunto.value,
                descripcion = $descripcion.value,
                marcar = $marcar.value;
                alert(marcar[0]);

            aux = 0;
            if(esVacio(remitente) || !(verificarPatron(remitente,/^[a-zA-Z][a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s?]+$/))){
                aux++;
                Swal.fire('remitente','Datos ingresados no validos','warning');
                $("#remitente").val("");
                $("#asunto").val(asunto);
                $("#descripcion").val(descripcion);    
            }
            if(esVacio(asunto) || !(verificarPatron(asunto,/^[a-zA-Z][a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s?]+$/))){
                aux++;
                Swal.fire('asunto','Datos ingresados no validos','warning');
                $("#remitente").val(remitente);
                $("#asunto").val("");
                $("#descripcion").val(descripcion); 
            }
            if(esVacio(descripcion) || !(verificarPatron(descripcion,/^[a-zA-Z][a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s?\.?\,?]+$/))){
                aux++;
                Swal.fire('descripcion','Datos ingresados no validos','warning');
                $("#remitente").val(remitente);
                $("#asunto").val(asunto);
                $("#descripcion").val(""); 
            }
            if(aux==0){
                console.log(remitente);
                console.log(asunto);
                console.log(descripcion);
                //$formulario.submit();
            }
        }
        //console.log("se envio");
}

function esVacio(texto) {
    res = false;
    if(texto == null || texto == "" || texto == " "){
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