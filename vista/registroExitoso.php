<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
<?php
    $active = "active";
    include_once("../vista/layouts/navegacion.php");
    include_once("../vista/layouts/footer.php");
?>
<script>
    Swal.fire({
        title: 'USUARIO REGISTRADO!',
        text: 'El usuario ha sido registrado con exito',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) =>{
        if(result.isConfirmed){
            window.location.href="../vista/home.php";
        }
    })
</script>
</body>
</html>