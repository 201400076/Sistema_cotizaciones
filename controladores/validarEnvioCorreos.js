obtenerValores();

function obtenerValores(){
    const $formulario = document.querySelector("#formulario"),
            $asunto = document.querySelector("#asunto"),
            $descripcion = document.querySelector("#descripcion");

        $formulario.onsubmit = evento => {
            evento.preventDefault();
            const asunto = $asunto.value,descripcion = $descripcion.value;
            aux = 0;
            if(esVacio(asunto) || !(verificarPatron(asunto,/^[a-zA-Z][a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s?]+$/))){
                aux++;
                Swal.fire('Asunto','Datos ingresados no validos','warning');
                $("#asunto").val("");
                $("#descripcion").val(descripcion); 
            }
            if(esVacio(descripcion) || !(verificarPatron(descripcion,/^[a-zA-Z][a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s?\.?\,?]+$/))){
                aux++;
                Swal.fire('Descripcion','Datos ingresados no validos','warning');
                $("#asunto").val(asunto);
                $("#descripcion").val(""); 
            }
            if(aux==0){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'ENVIANDO Correos... Por favor espere unos segundos'
                })
                $formulario.submit();
            }
        }
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