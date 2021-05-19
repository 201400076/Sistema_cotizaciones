<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Document</title>
    <script src="funciones.js"></script>     
    <link rel="stylesheet" href="../librerias/sweet/dist/sweetalert2.min.css">

</head>
<body>    
<?php
    if(isset($_POST["ej"])){

        $prueba=empty("");
        echo "<script language='javascript'>
        Swal.fire('agrego un item');
        </script>";
        
    }
?>
<form action="" method="post">
    <input type="submit" name="ej" class="ej" id="ej">
</form>
<div class="botones">
    <button id="botonAceptar">Aceptar</button>
    <button id="botonRechazar">Rechazar</button>        
</div>

<script>
        $('#botonAceptar').on('click', function(){
            Swal.fire({
                title: 'Esta seguro de aceptar esta Solicitud?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'NO'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('SOLICITUD ACEPTADA!','','success')
                }else{
                    Swal.fire('AUTORIZACION CANCELADA!','Se cancelo la autorizacion de la Solicitud','info')
                }
            })
        })

        $('#botonRechazar').on('click', function(){
            Swal.fire({
                input: 'textarea',
                inputLabel: 'Justificacion de Rechazo de Solicitud',
                inputPlaceholder: 'Ingrese los motivos por el cual se rechazo la solicitud de Pedido...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('SOLICITUD RECHAZADA!','Se registro la justificacion para el rechazo de la solicitud','success')
                }else{
                    Swal.fire('RECHAZO DE SOLICITUD CANCELADA!','Se cancelo el rechazo de la Solicitud','info')
                }
            })

                if (text) {
                Swal.fire(text)
                }
        })   
    </script>
</body>
</html>