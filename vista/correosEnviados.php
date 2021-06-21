<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
    <?php
        $active = "";
        include_once("layouts/navegacion.php");
        $marcado = $_GET['marcado'];
    ?>

    <script>
        var id = '<?php echo($marcado);?>';
        if(id == 0){
            Swal.fire({
            title: 'Ooppss...',
            text: 'Tienes que seleccionar al menos una empresa',
            icon: 'warning',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            closeOnClickOutside: false,
            allowEnterKey: true
            }).then((result) =>{
                if(result.isConfirmed){
                    window.history.back();
                }
            })
        }else{
            Swal.fire({
            title: 'CORREOS ENVIADOS',
            text: 'Los correos fueron enviados exitosamente!',
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            closeOnClickOutside: false,
            allowEnterKey: true
            }).then((result) =>{
                if(result.isConfirmed){
                    window.location.href="../ruta/rutas.php?ruta=mostrar&con=cotizando";
                }
            })
        }
    </script>
</body>
</html>

<?php
include_once("../vista/layouts/footer.php");
?>