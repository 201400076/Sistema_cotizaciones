<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
    <?php
        $marcado = $_GET['marcado'];
    ?>

    <script>
        var id = '<?php echo($marcado);?>';
        if(id == 0){
            Swal.fire({
            title: 'Ooppss...',
            text: 'Texto ingresado no valido, vuelva a intentarlo',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then((result) =>{
            if(result.isConfirmed){
            window.location.href="../vista/formularioEnviarCotizaciones.php";
            }
            })
        }else{
            Swal.fire({
            title: 'CORREOS ENVIADOS',
            text: 'Los correos fueron enviados exitosamente!',
            icon: 'success',
            confirmButtonText: 'OK'
            }).then((result) =>{
            if(result.isConfirmed){
            window.location.href="../vista/formularioEnviarCotizaciones.php";
            }
            })
        }

    </script>
</body>
</html>

<?php

?>