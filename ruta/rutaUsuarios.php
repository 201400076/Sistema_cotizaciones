<?php
    $tipo=$_GET['tipo'];
    $id_unidad=$_GET['id_unidad'];

    switch ($tipo) {
        case 'gasto':
            session_start();
            $_SESSION["unidad"]=$id_unidad;
            header("Location:../vista/solicitudes_vista.php");
        break;               
        case 'administracion':
            session_start();
            $_SESSION["unidad"]=$id_unidad;
            header("Location:../ruta/rutas.php?ruta=mostrar&con=nueva");
        break;               
    }
    echo $tipo;
    echo $id_unidad;
?>